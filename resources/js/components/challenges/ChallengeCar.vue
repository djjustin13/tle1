<template>

    <div class="challenge">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <div v-if="error" class="alert alert-light" role="alert">
                        {{ error }}
                    </div>

                    <h2>Je hebt een {{ carType }}. Daarmee rij je nu {{ car.km }} kilometer per week</h2>
                    <img class="card-img" src="/img/car.png" alt="meat">

                    <h2>Bespaar veel Co2 door minder te rijden. Pak de fiets, of neem wat vaker het openbaar vervoer.</h2>

                    <p>vul in hoeveel kilometer je vanaf nu wilt gaan rijden</p>

                    <input class="form-control-range" type="range" name="km" min="1" :max="car.km" v-model="km">
                    <p>{{km}} Kilometer</p>
                    <p>{{co2km}} Kilometer</p>

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
                km: null,
                co2km: null,
            }
        },methods:{
            parseJson:function() {
                let data = localStorage.getItem('answers');
                if (data){
                    let object = JSON.parse(data);
                    this.car = object.car;
                    this.km = this.car.km;
                }
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
                this.car['km'] = this.km;
                this.nextSlide()
            }
        },

        mounted: function(){

            this.parseJson();
            this.checkCar();

        }
    }
</script>

<style>
    .challenge{
        background-color: #5A5C84;
    }
</style>