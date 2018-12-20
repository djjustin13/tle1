<template>
    <div class="challenge">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <div v-if="error" class="alert alert-light" role="alert">
                        {{ error }}
                    </div>

                    <h3>Je douchet {{shower.days}} {{dayDays(shower.days)}} per week en {{shower.minutes}} minuten per dag. Hiermee stoot je <span class="grey">{{co2}} kilo CO₂</span> uit</h3>
                    <div id = "image-container">
                        <img id="image" class="card-img" src="/img/shower.png" alt="car image">
                    </div>
                    <p>Vul in hoevaak je vanaf nu wilt gaan douchen</p>
                    <v-numberInput controls :min=1 :max=shower.days placeholder="vul in" v-model="dayChallenge"></v-numberInput><span>dagen</span>
                    <v-numberInput controls :min=1 :max=shower.minutes placeholder="vul in" v-model="minuteChallenge"></v-numberInput><span>minuten</span>

                    <p>Dit bespaart je weekelijks <span class="orange">{{calculateSave}} Kilo CO₂</span></p>

                    <div class="py-4">
                        <button class="btn btn-light question-btn px-4" @click="">save</button>
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
                avgDischargeMin: null,
                minuteChallenge: 5,
                dayChallenge: null
            }
        },
        methods: {
            parseJson: function () {
                let data = localStorage.getItem('answers');
                if (data) {
                    let object = JSON.parse(data);
                    this.shower = object.shower;
                }
            },

            getData: function () {
                axios.post('api/compare/shower', {
                    input: this.shower,
                }).then((response) => {
                    console.log(response)
                    this.co2PerDay = response.data.usrDischargePerDay
                    this.avgDischargeMin = response.data.avgDischargeMin
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

        },
        mounted: function(){

            this.parseJson();
            this.getData();

            this.dayChallenge = this.shower.days

        },

        computed: {
            co2 : function() {
                return (this.co2PerDay * this.shower.days)/1000
            },

            calculateSave : function() {
                return this.co2 - ((this.dayChallenge * this.minuteChallenge * this.avgDischargeMin) / 1000)

            }

        }
    }
</script>

<style scoped>
    .challenge{
        background-color: #6AAD80;
    }
    .grey{
        color: rgb(80, 76, 89)
    }
</style>