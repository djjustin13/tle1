<template>
     <div class="challenge">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <div v-if="error" class="alert alert-light" role="alert">
                        {{ error }}
                    </div>

                    <h2>Je rookt nu {{ this.weeklyCigarette }} sigaretten per week. Daarmee stoot je {{ this.weeklyCo2 }} gram CO2 uit.</h2>
                    <div id = "image-container">
                        <img id="image" class="card-img" src="/img/cigarette.png" alt="car image">
                    </div>
                    <p class="challenge-question">Vul in hoevaal sigaretten je vanaf nu wilt gaan roken per dag</p>
                    <v-numberInput controls :min=0 :max=cigarettesPerDay placeholder="vul in" v-model="targetCigarettesDays"></v-numberInput>
                    <p class="challenge-response">Dit bespaart je weekelijks <br /> <span class="orange challenge-response-data">{{co2.toFixed(2)}}</span> <br />gram CO₂</p>

                    <div class="py-4">
                        <button class="btn btn-light question-btn px-4" @click="saveSmoke()">save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "challenge-smoking",
        data(){
            return{
                error: null,
                cigarettesPerDay: null,
                weeklyCigarette: null,
                weeklyCo2: null,
                targetCigarettesDays: 0,
                smokeChallenge: {},

            }
        },methods:{
            parseJson:function() {
                let data = localStorage.getItem('answers');
                if (data){
                    let object = JSON.parse(data);
                    console.log(object)
                    this.cigarettesPerDay = object.smoke;
                    if(this.smoke == false){
                        this.$router.push('/overview')
                    }
                }
            },
            getData:function() {
                axios.post('api/compare/smoking', {
                    input: this.cigarettesPerDay,
                }).then((response)  =>  {
                    console.log(response)
                    this.weeklyCigarette = response.data.usrWeeklyCig
                    this.dischargePerCigarette = response.data.avgDischargeCig
                    this.weeklyCo2 = response.data.usrDischargePerWeek
                }).catch(function (error) {
                    console.log(error.response);
                })
            },
            saveSmoke:function(){
                this.smokeChallenge["oldAmount"] = this.cigarettesPerDay
                this.smokeChallenge["newAmount"] = this.targetCigarettesDays
                this.smokeChallenge["oldCo2"] = this.weeklyCo2
                this.smokeChallenge["newCo2"] = (this.weeklyCo2 - this.co2)
                localStorage.setItem('smokeChallenge', JSON.stringify(this.smokeChallenge));
                this.$router.push('overview')
            },
        },
        mounted: function(){
            this.parseJson();
            this.getData();
        },

        computed: {
            
            co2 : function() {
                return (this.weeklyCigarette - this.targetCigarettesDays * 7) * this.dischargePerCigarette
            }

        }
    }
</script>

<style scoped>

    .number-input .number-input__input {
        color: #6A7FAD !important;
    }

    .question-btn{
        color: #6A7FAD;
        width: 70%;
    }

    .challenge {
        background-color: #6A7FAD
    }
</style>