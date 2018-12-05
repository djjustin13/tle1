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

                    <p>Vul in hoeveel extra dagen je vleesvrij wilt gaan eten:</p>

                    <div class="v-select">
                        <v-select v-model="targetDays" :options="maxTargetDays">
                        </v-select>
                    </div>

                    <p>Door {{targetDays.value}} extra {{dayDays(targetDays.value)}} per week geen vlees te eten, bespaar je weekelijks {{co2}} kilo Co2</p>

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
                    this.weeklyCo2 = response.data.usrWeeklyDischarge / 1000
                    this.dailyCo2 = response.data.avgDischargePerKG / 10
                    //console.log(response)
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

            saveKm:function(){
                this.car['km'] = this.kms;
                this.nextSlide()
            },

        },

        mounted: function(){

            this.parseJson();
            this.getData();
            this.calculateTargetDays();
        },

        computed: {
            co2 : function(){
                return (this.targetDays * this.dailyCo2) /1000
            },
        }
    }
</script>

<style scoped>

    .challenge{
        background-color: #5A5C84;
    }

    .v-select{

    }

</style>