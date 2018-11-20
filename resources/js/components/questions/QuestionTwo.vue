<template>

    <div class="question">
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
            </div>

            <a @click="reset()" href="#">Clear storage & restart</a>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">


                    <div v-if="hasCar === null">
                        <h1 class="py-2">Heb je een auto?</h1>
                        <img class="card-img" src="/img/car.png" alt="meat">
                        <div class="py-4">
                            <button class="btn btn-light yes-no-btn mx-1" @click="yes()">Ja</button>
                            <button class="btn btn-light yes-no-btn mx-1" @click="no()">Nee</button>
                        </div>
                    </div>


                    <div v-if="hasCar && carTypeSet === false">
                        <h1>Wat voor auto?</h1>
                        <img class="card-img" src="/img/car.png" alt="meat">
                        <select  class="custom-select custom-select-sm question-select" name="car" v-model="carType">
                            <option value="benzine">Benzine</option>
                            <option value="diesel">Diesel</option>
                            <option value="elektrisch">Elektrisch</option>
                            <option value="hybride">Hybride</option>
                        </select>
                        <div class="py-4">
                            <button class="btn btn-light question-btn px-4" @click="saveCarType()">Volgende</button>
                        </div>
                    </div>

                    <div v-if="carTypeSet">
                        <h1>Hoeveel kilometer rij je per week?</h1>
                        <img class="card-img" src="/img/car.png" alt="meat">

                        <input class="form-control-range" type="range" name="km" min="1" max="500" v-model="km">
                            <p>{{km}} Kilometer</p>
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
                carType: "benzine",
                carTypeSet: false,
                km: 250,
                answer: [],
                error: null,
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
                this.answer.push(this.hasCar);
                this.nextSlide()
            },
            saveCarType:function(){
                this.carTypeSet = true
                this.answer.push({ type: this.carType});
            },
            saveKm:function(){
                this.answer.push({ km: this.km});
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

</style>


