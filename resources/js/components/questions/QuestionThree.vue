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

                        <div class="v-select">
                            <v-select id="shower" v-model="weekAnswer" :options="dayArray"></v-select>
                        </div>

                        <div class="py-4">
                            <button class="btn btn-light question-btn px-4" @click="saveWeekAnswer()">Volgende</button>
                        </div>
                    </div>

                    <div v-if="weekAnswerSet">
                        <h1 class="py-2">Hoelang douche je gemiddeld per dag?</h1>
                        <img class="card-img" src="/img/shower.png" alt="meat">
                        <br>
                        <br>
                        <v-numberInput controls :min=1 :max=60 placeholder="vul in" v-model="minuteAnswer"></v-numberInput>
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
                weekAnswer: {label: '7 keer', value: 7},
                weekAnswerSet: false,
                minuteAnswer: 5,
                answer: {},
                error: null,
                dayArray: []
            }
        },
        methods: {
            reset:function(){
                localStorage.clear()
                this.answers = null;
                this.$router.push('/')
                location.reload()
            },
            setDayArray: function () {
                for (let i = 7; i > 0; i--) {
                    this.dayArray.push({label: i + ' keer', value: i + 1})
                }
            },
            saveWeekAnswer:function(){
                this.weekAnswerSet = true
                this.answer['days'] = this.weekAnswer.value
            },
            saveMinuteAnswer:function(){
                this.answer['minutes'] = this.minuteAnswer
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
        },

        mounted: function(){
            this.setDayArray()
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


