<template>

    <div class="question background">
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
            </div>

            <a @click="reset()" href="#">Clear storage & restart</a>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">

                    <div v-if="hasCar === null">
                        <h1 class="py-2">Rijd je wel eens auto?</h1>
                        <img class="card-img" src="/img/car.png" alt="meat">
                        <div class="py-4">
                            <button class="btn btn-light yes-no-btn mx-1" @click="yes()">Ja</button>
                            <button class="btn btn-light yes-no-btn mx-1" @click="no()">Nee</button>
                        </div>
                    </div>

                    <div v-if="hasCar && carTypeSet === false">
                        <h1>Wat voor auto?</h1>
                        <img class="card-img" src="/img/car.png" alt="meat">

                        <div class="v-select">
                            <v-select id="car" v-model="carType" :options="car" :searchable=false></v-select>
                        </div>

                        <div class="py-4">
                            <button class="btn btn-light question-btn px-4" @click="saveCarType()">Volgende</button>
                        </div>
                    </div>

                    <div v-if="carTypeSet">
                        <h1>Hoeveel kilometer rij je per week?</h1>
                        <img class="card-img" src="/img/car.png" alt="meat">

                        <v-slider
                                v-model="km"
                                :min='1'
                                :max='500'
                                :interval="1"
                                formatter='{value} kilometer'
                                :dot-size="30"
                                :searchable=false
                        />

                        <div class="py-4">
                            <button class="btn btn-light question-btn px-4" @click="saveKm()">Volgende</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {



        name: 'question-two',
        data(){
            return{
                hasCar: null,
                carType: {label:'Benzine', value:'benzin_car'},
                carTypeSet: false,
                km: 250,
                answer: {},
                error: null,
                car: [
                    {label:'Benzine', value:'benzin_car'},
                    {label:'Diesel', value:'diesel_car'},
                    {label:'Elektrisch', value:'electric_car'},
                    {label:'Hybride', value:'hybrid_car'}
                ]
            }
        },
        methods: {
            reset:function(){
                localStorage.clear();
                this.answers = null;
                this.$router.push('/')
                location.reload()
            },
            yes:function(){
                this.hasCar = true;
            },
            no:function(){
                this.hasCar = false
                this.answer = this.hasCar;
                this.nextSlide()
            },
            saveCarType:function(){
                this.carTypeSet = true
                this.answer['type'] = this.carType.value;
            },
            saveKm:function(){
                this.answer['km'] = this.km;
                this.nextSlide()
            },
            nextSlide:function(){
                if(this.answer != null){
                    this.$emit('save', ['car', this.answer])
                    $(".slider").slick('slickNext');
                }else{
                    this.error = "Je moet iets invullen"
                }
            },
        }
    }
</script>

<style lang="scss" scoped>
    .question{
        //background-color: #70BEE7;
        background-color: #44999E;
    }

    .question-btn{
        color: #44999E;
    }

    .yes-no-btn{
        color: #44999E;
    }

    .background {
        // background: linear-gradient(-100deg,#23A6D5, #23D5AB) !important;
	    // background-size: 400% 400%;
        // animation: Gradient 15s ease infinite;
        background-color:#44999E;
    }

</style>


