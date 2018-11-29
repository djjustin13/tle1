<template>

    <div class="challenge">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <div v-if="error" class="alert alert-light" role="alert">
                        {{ error }}
                    </div>

                    <h2>Je hebt een {{ carType }}. Daarmee rij je nu {{ car.km }} kilometer per week. Hiermee stoot je {{weeklyCo2}} kg co2 uit</h2>
                    <img class="card-img" src="/img/car.png" alt="car image">

                    <p>Vul in hoeveel kilometer je minder wilt gaan rijden</p>

                    <input class="form-control-range" type="range" name="km" min="0" :max="car.km" v-model="targetKm">
                    <p>{{targetKm}} Kilometer. </p>
                    <p>Hiermee bespaar je weekelijks {{co2}} Kilo Co2</p>

                    <div class="py-4">
                        <button class="btn btn-light question-btn px-4" @click="saveKm()">Wat bespaar ik hiermee?</button>
                    </div>

                    <p>nieuwe auto? klik hier om je type te veranderen.</p>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "challenge-car",
        data(){
            return{
                error: null,
                car: {},
                carType: null,
                co2PerKm: null,
                weeklyCo2: null,
                targetKm: 0,
            }
        },methods:{
            parseJson:function() {
                let data = localStorage.getItem('answers');
                if (data){
                    let object = JSON.parse(data);
                    this.car = object.car;
                }
            },

            getData:function() {
                axios.post('api/compare/'+ this.car.type, {
                    input: this.car,
                }).then((response)  =>  {
                    this.co2PerKm = response.data.avgDischargeKM
                    this.weeklyCo2 = response.data.usrWeeklyDischarge / 1000
                    console.log(response)
                }).catch(function (error) {
                        console.log(error.response);
                    })
            },

            checkCar: function(){
                switch(this.car.type) {
                    case 'benzin_car':
                        this.carType = "benzine auto"
                        break
                    case 'diesel_car':
                        this.carType = "diesel auto"
                        break
                    case 'electric_car':
                        this.carType = "elektrische auto"
                        break
                    case 'hybrid_car':
                        this.carType = "hybride auto"
                        break
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
            this.checkCar();

        },

        computed: {
            co2 : function(){
                return (this.targetKm * this.co2PerKm)/1000
            },

        }

    }
</script>

<style>
    .challenge{
        background-color: #44999E;
    }
</style>