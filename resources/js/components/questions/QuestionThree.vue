<template>
    <div class="question">
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
            </div>

            <a @click="reset()" href="#">Clear storage & restart</a>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">

                    <div v-if="weekAnswerSet === false">
                        <h1 class="py-2">Hoevaak per week douche je?</h1>
                        <img class="card-img" src="/img/shower.png" alt="meat">
                        <br>
                        <br>
                        <select class="custom-select custom-select-sm question-select" name="shower" v-model="weekAnswer">
                            <option value="1">1 keer</option>
                            <option value="2">2 keer</option>
                            <option value="3">3 keer</option>
                            <option value="4">4 keer</option>
                            <option value="5">5 keer</option>
                            <option value="6">6 keer</option>
                            <option value="7">7 keer</option>
                        </select>
                        <div class="py-4">
                            <button class="btn btn-light question-btn px-4" @click="saveWeekAnswer()">Volgende</button>
                        </div>
                    </div>

                    <div v-if="weekAnswerSet">
                        <h1 class="py-2">Hoelang douche je gemiddeld?</h1>
                        <img class="card-img" src="/img/shower.png" alt="meat">
                        <br>
                        <br>
                        <input class="form-control" type="number" v-model="minuteAnswer">
                        <label> {{minuteAnswer}} minuten</label>
                        <div class="py-4">
                            <button class="btn btn-light question-btn px-4" @click="saveMinuteAnswer()">Volgende</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'question-three',
        data(){
            return{
                weekAnswer: "7",
                weekAnswerSet: false,
                minuteAnswer: "5",
                answer: [],
                error: null,
            }
        },
        methods: {
            reset:function(){
                localStorage.clear()
                this.answers = null;
                this.$router.push('/')
                location.reload()
            },
            saveWeekAnswer:function(){
                this.weekAnswerSet = true
                this.answer.push(this.weekAnswer)
            },
            saveMinuteAnswer:function(){
                this.answer.push(this.minuteAnswer)
                this.nextSlide()
            },
            nextSlide:function(){
                if(this.answer != null){
                    this.$emit('save', ["shower", this.answer])
                    $(".slider").slick('slickNext')
                }else{
                     this.error = "Je moet iets invullen"
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .question{
        background-color: #6AAD80;
    }

    .question-btn{
        color: #6AAD80;
    }
</style>


