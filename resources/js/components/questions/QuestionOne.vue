<template>
    <div class="question">
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <h1 class="py-2">Hoeveel dagen per week eet je vlees?</h1>
                    <img class="card-img" src="/img/meat.png" alt="meat">

                    <div class="v-select">
                        <v-select id="meat" v-model="answer" :options="dayArray"></v-select>
                    </div>

                    <div class="py-4">
                        <button class="btn btn-light question-btn px-4" @click="nextSlide()">Volgende</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        name: 'question-one',
        data() {
            return {
                answer: {label: '7 dagen', value: 7},
                error: null,
                dayArray: []
            }
        },
        methods: {
            nextSlide: function () {
                if (this.answer != null) {
                    this.$emit('save', ["meat", this.answer.value])
                    $(".slider").slick('slickNext');
                } else {
                    this.error = "Je moet iets invullen"
                }
            },

            setDayArray: function () {
                for (let i = 7; i > -1; i--) {
                    this.dayArray.push({label: i  + ' ' + this.dayDays(i), value: i + 1})
                }
            },

            dayDays: function (input) {
                if (input == 1) {
                    return 'dag'
                } else {
                    return 'dagen'
                }

            }
        },

        mounted: function () {

            this.setDayArray();
        }
    }
</script>

<style lang="scss" scoped>
    .question{
        background-color: #5A5C84;
    }

    .question-btn{
        color: #5A5C84;
        width: 70%;
    }

</style>


