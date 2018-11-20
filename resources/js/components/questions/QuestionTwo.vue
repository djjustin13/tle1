<template>

    <div class="question">
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">


                    <div v-if="hasCar === null">
                        <h1 class="py-2">Heb je een auto?</h1>
                        <img class="card-img" src="/img/meat.png" alt="meat">
                        <div class="py-4">
                            <button @click="yes()">Ja</button>
                            <button @click="no()">Nee</button>
                        </div>
                    </div>


                    <div v-if="hasCar && carTypeSet === false">
                        <h1>Wat voor auto?</h1>
                        <img class="card-img" src="/img/meat.png" alt="meat">
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
                        <img class="card-img" src="/img/meat.png" alt="meat">
                        <select  class="custom-select custom-select-sm question-select" name="car" v-model="km">
                            <option value="0-10">0-10</option>
                            <option value="10-20">10-30</option>
                            <option value="20-30">20-30</option>
                            <option value="30-40">30-40</option>
                        </select>
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
                carType: null,
                carTypeSet: false,
                km: null,
                answer: [],
                error: null,
            }
        },
        methods: {
            yes:function(){
                this.hasCar = true;
            },
            no:function(){
                this.hasCar = false;
                this.answer = 'no';
                this.saveCar()
                this.nextSlide()
            },
            saveCarType:function(){
                this.carTypeSet = true
                this.answer.push(this.carType);
            },
            saveKm:function(){
                this.answer.push(this.km);
                this.nextSlide()
            },
            nextSlide:function(){
                this.$emit('save', [2, this.answer])
                $(".slider").slick('slickNext');
            },
        }
    }
</script>

<style lang="scss" scoped>
    .question{
        background-color: #70BEE7;
    }

    .question-btn{
        color: #70BEE7;
        width: 50%;
    }

    .button-box {
        text-align: center;
    }
</style>


