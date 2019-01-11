<template>

    <div class="challenge">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <div v-if="error" class="alert alert-light" role="alert">
                        {{ error }}
                    </div>

                    <h2>Je eet nu {{meatDays}} {{dayDays(meatDays)}} per week vlees. Hiermee stoot je {{weeklyCo2}} kg Co2 uit.</h2>

                    <img class="card-img" src="/img/meat.png" alt="meat image">

                    <p class="challenge-question">Vul in hoeveel extra dagen je vleesvrij wilt gaan eten:</p>

                    <div class="v-select">
                        <v-select id="meat" v-model="targetDays" :options="maxTargetDays">
                        </v-select>
                    </div>

                    <p class="challenge-response">Door {{targetDays.value}} extra {{dayDays(targetDays.value)}} per week geen vlees te eten, bespaar je wekelijks <span class="orange challenge-response-data"><br /> {{co2.toFixed(2)}} <br /></span> kilo Co2</p>

                    <div class="py-4">
                        <button class="btn btn-light question-btn px-4" @click="saveMeat()">save</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>



    export default {
        name: "challenge-meat",
        data(){
            return{
                error: null,
                meatDays: null,
                dailyCo2: null,
                weeklyCo2: null,
                targetDays: {label: '1 dag', value: 1},
                maxTargetDays: [],
                day1: '',
                meatChallenge: {},

            }
        },methods:{

            parseJson:function() {
                let data = localStorage.getItem('answers');
                if (data){
                    let object = JSON.parse(data);
                    this.meatDays = object.meat;
                }
            },

            getData:function() {
                axios.post('api/compare/flesheaters', {
                    input: this.meatDays,
                }).then((response)  =>  {
                    console.log(response)
                    this.weeklyCo2 = response.data.usrDischargePerWeek / 1000
                    this.dailyCo2 = response.data.avgDischargePerKG / 10
                }).catch(function (error) {
                    console.log(error.response);
                })
            },

            dayDays:function(input) {
                if(input == 1){
                    return 'dag'
                }else{
                    return 'dagen'
                }
            },

            calculateTargetDays:function() {
                for(let i = 0; i < this.meatDays; i++) {
                    this.maxTargetDays.push({label: i+1+ ' '+ this.dayDays(i+1) , value:  i+1})
                }
            },

            saveMeat:function(){
                this.meatDays = (this.meatDays - this.targetDays.value)
                axios.post('api/compare/flesheaters', {
                    input: this.meatDays
                }).then((response)  =>  {
                    this.meatChallenge["newDays"] = this.meatDays
                    this.meatChallenge["newCo2"] = (this.weeklyCo2 - this.co2)
                    this.meatChallenge["newUsrBelowAverage"] = response.data.usrBelowAverage
                    localStorage.setItem('meatChallenge', JSON.stringify(this.meatChallenge));
                    this.$router.push('overview')
                }).catch(function (error) {
                    console.log(error.response);
                })

                
                
            },

        },

        mounted: function(){

            this.parseJson()
            this.getData()
            this.calculateTargetDays()
        },

        computed: {
            co2 : function(){
                return (this.targetDays.value * this.dailyCo2) /1000
            },
        }
    }
</script>

<style scoped>

    .question-btn{
        color: #5A5C84;
        width: 70%;
    }

    .challenge{
        background-color: #5A5C84;
    }

    .v-select{

    }

</style>