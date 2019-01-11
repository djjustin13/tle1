<template>
    <div class="challenge shower-challenge">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <div v-if="error" class="alert alert-light" role="alert">
                        {{ error }}
                    </div>

                    <h2>Je douchet {{shower.days}} {{dayDays(shower.days)}} per week en {{shower.minutes}} minuten per dag. Hiermee stoot je <span class="grey">{{weeklyCo2}} kilo CO₂</span> uit</h2>
                    <div id = "image-container">
                        <img id="image" class="card-img" src="/img/shower.png" alt="car image">
                    </div>
                    <p class="challenge-question">Vul in hoevaak je vanaf nu wilt gaan douchen</p>
                    <v-numberInput controls :min=1 :max=shower.days placeholder="vul in" v-model="targetDays"></v-numberInput><span>{{dayDays(targetDays)}}</span>
                    <v-numberInput controls :min=1 :max=shower.minutes placeholder="vul in" v-model="targetMinutes"></v-numberInput><span>{{minuteMinutes(targetMinutes)}}</span>

                    <p class="challenge-response">Dit bespaart je weekelijks <br /> <span class="orange challenge-response-data">{{co2.toFixed(2)}} <br /></span>Kilo CO₂</p>

                    <div class="py-4 challenge-btn-container">
                        <button class="btn btn-light question-btn px-4" @click="saveShower()">save</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        name: "challenge-shower",
        data() {
            return {
                error: null,
                shower: {},
                co2PerDay: null,
                weeklyCo2: null,
                avgDischargeMin: null,
                targetMinutes: null,
                targetDays: null,
                showerChallenge: {},
            }
        },
        methods: {
            parseJson: function () {
                let data = localStorage.getItem('answers');
                if (data) {
                    let object = JSON.parse(data);
                    this.shower = object.shower;
                    console.log(this.shower)
                }
            },

            getData: function () {
                axios.post('api/compare/shower', {
                    input: this.shower,
                }).then((response) => {
                    console.log(response)
                    this.co2PerDay = response.data.usrDischargePerDay
                    this.avgDischargeMin = response.data.avgDischargeMin
                    this.weeklyCo2 = (this.co2PerDay * this.shower.days)/1000
                }).catch(function (error) {
                    console.log(error.response);
                })
            },

            checkChallenge: function () {
                let data = localStorage.getItem('showerChallenge');
                if(data){
                    let object = JSON.parse(data);
                    this.targetMinutes = object.newMinutes
                    this.targetDays = object.newDays
                }
                else{
                    this.targetMinutes = 5
                    this.targetDays = 7
                }
            },

            dayDays:function(input) {
                if(input == 1){
                    return 'dag'
                }else{
                    return 'dagen'
                }
            },

            minuteMinutes:function(input) {
                if(input == 1){
                    return 'minuut'
                }else{
                    return 'minuten'
                }
            },
            //Saves all data. Values are per week.
            saveShower:function(){
                this.shower.minutes = this.targetMinutes
                this.shower.days = this.targetDays
                axios.post('api/compare/shower', {
                    input: this.shower,
                }).then((response) => {
                    
                    this.showerChallenge["newDays"] = this.targetDays
                    this.showerChallenge["newMinutes"] = this.targetMinutes
                    this.showerChallenge["newCo2"] = response.data.usrDischargePerYear
                    this.showerChallenge["newUsrBelowAverage"] = response.data.usrBelowAverage
                    localStorage.setItem('showerChallenge', JSON.stringify(this.showerChallenge));
                    this.$router.push('overview')
                }).catch(function (error) {
                    console.log(error.response);
                })
                
                
                
            }

        },
        mounted: function(){

            this.parseJson();
            this.getData();
            this.checkChallenge();

            // this.dayChallenge = this.shower.days

        },

        computed: {
            co2 : function() {
                return this.weeklyCo2 - ((this.targetDays * this.targetMinutes * this.avgDischargeMin) / 1000)

            }

        }
    }
</script>

<style scoped>

    .question-btn{
        color: #6AAD80;
        width: 70%;
    }

    .challenge{
        background-color: #6AAD80;
    }
    .grey{
        color: rgb(80, 76, 89)
    }
</style>