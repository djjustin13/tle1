<template>

    <div class="challenge">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <div v-if="error" class="alert alert-light" role="alert">
                        {{ error }}
                    </div>

                    <h2>Je hebt een {{ carType }}. Daarmee rij je nu {{ car.km }} km per week. Hiermee stoot je <span class="grey">{{weeklyCo2}} kilo CO2</span> uit</h2>
                    <div id = "image-container">
                        <img id="image" class="card-img" src="/img/car.png" alt="car image">
                    </div>

                    <v-slider
                            v-model="targetKm"
                            :min= 1
                            :max='car.km'
                            :interval= 1
                            formatter='{value} kilometer'
                            :dot-size= 30
                    />
                    <small>Vul in hoeveel kilometer je minder wilt gaan rijden</small>
                    <p class="challenge-response">Hiermee bespaar je weekelijks <br /> <span class="orange challenge-response-data">{{co2.toFixed(2)}} </span><br />Kilo CO2</p>

                    <div class="py-4 challenge-btn-container">
                        <button class="btn btn-light question-btn px-4" @click="saveCar()">save</button>
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
                    console.log(response)
                    this.co2PerKm = response.data.avgDischargeKM
                    this.avgDischargeYear = response.data.avgDischargeYear
                    this.weeklyCo2 = response.data.usrDischargePerWeek / 1000
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
            //Saves all data. Values are per year.
            saveCar:function(){
                this.car.km = (this.car.km - this.targetKm)
                this.newCo2 = (this.weeklyCo2 - this.co2)
                axios.post('api/compare/'+ this.car.type, {
                    input: this.car,
                }).then((response)  =>  {
                    console.log(response)

                    this.carChallenge["newKm"] = this.car.km
                    this.carChallenge["newCo2"] = this.newCo2
                    this.carChallenge["newUsrBelowAverage"] = response.data.usrBelowAverage
                    
                    // let elem = document.getElementById("image");
                    // let pos = 0;
                    // let id = setInterval(frame, 1);
                    // let that = this
                    // function frame() {
                    //     if (pos >= 900) {
                    //         clearInterval(id);
                    //         localStorage.setItem('carChallenge', JSON.stringify(that.carChallenge));
                    //         that.$router.push('overview')
                    //     } else {
                    //         pos+=3;
                    //         elem.style.left = pos + "px";
                    //         document.getElementById("image").style.WebkitTransform = "rotate(340deg)";
                    //     }
                    // }
                    localStorage.setItem('carChallenge', JSON.stringify(this.carChallenge))
                    this.$router.push('overview')
                    
                }).catch(function (error) {
                        console.log(error.response);
                })

                

     
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
            }
        }
    }
</script>

<style>
    .question-btn{
        color: #44999E;
        width: 70%;
    }

    .challenge{
        background-color: #44999E;
    }

    .orange{
        color: rgb(233, 149, 110)
    }

    .grey{
        color: rgb(80, 76, 89)
    }

    #image{
        position: relative;

    }
</style>