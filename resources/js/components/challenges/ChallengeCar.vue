<template>

    <div class="challenge">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <div v-if="error" class="alert alert-light" role="alert">
                        {{ error }}
                    </div>

                    <h3>Je hebt een {{ carType }}. Daarmee rij je nu {{ car.km }} km per week. Hiermee stoot je <span class="grey">{{weeklyCo2}} kilo CO₂</span> uit</h3>
                    <img id="image" class="card-img" src="/img/car.png" alt="car image">

                    <v-slider
                            v-model="targetKm"
                            :min= 1
                            :max='car.km'
                            :interval= 1
                            formatter='{value} kilometer'
                            :dot-size= 30
                    />
                    <small>Vul in hoeveel kilometer je minder wilt gaan rijden</small>
                    <p>Hiermee bespaar je weekelijks <span class="orange">{{co2}} Kilo CO₂</span></p>

                    <div class="py-4">
                        <button class="btn btn-light question-btn px-4" @click="saveKm()">save</button>
                    </div>

                    <small>nieuwe auto? klik hier om je type te veranderen.</small>

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
                avgDischargeYear: null,
                weeklyCo2: null,
                targetKm: 1,
                carChallenge: {},
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
                    this.avgDischargeYear = response.data.avgDischargeYear
                    this.weeklyCo2 = response.data.usrWeeklyDischarge / 1000
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
            //Saves all data. Values are per week.
            saveKm:function(){
                this.carChallenge["oldKm"] = this.car.km
                this.carChallenge["newKm"] = (this.car.km - this.targetKm)
                this.carChallenge["oldCo2"] = this.weeklyCo2
                this.carChallenge["newCo2"] = (this.weeklyCo2 - this.co2)
                this.carChallenge["avgCo2"] = ((this.avgDischargeYear / 365)* 7)

                //document.getElementById("image").style.WebkitTransform = "rotate(20deg)";

                let elem = document.getElementById("image");
                let pos = 0;
                let id = setInterval(frame, 5);
                function frame() {
                    if (pos == 360) {
                        clearInterval(id);
                    } else {
                        pos++;
                        elem.style.WebkitTransform = "rotate(" + pos + "deg)"
                    }
                }

                localStorage.setItem('carChallenge', JSON.stringify(this.carChallenge));


                setTimeout(() => this.$router.push('overview'), 2000);



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

    .orange{
        color: rgb(233, 149, 110)
    }

    .grey{
        color: rgb(80, 76, 89)
    }
</style>