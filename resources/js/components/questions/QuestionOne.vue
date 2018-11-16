<template>
    <div class="question">
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <h1 class="py-2">Hoevaak per week eet je vlees?</h1>
                    <img class="card-img" src="/img/meat.png" alt="meat">
                    <select class="custom-select custom-select-sm question-select" name="meat" v-model="answer">
                        <option value="iedere dag">Iedere dag</option>
                        <option value="4-6">4 tot 6 dagen</option>
                        <option value="1-3">1 tot 3 dagen</option>
                        <option value="niet">Helemaal niet</option>
                    </select>
                    <div class="py-4">
                        <button class="btn btn-light btn-question px-4" @click="nextSlide()">Volgende</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        name: 'question-one',
        data(){
            return{
                answer: "iedere dag",
                error: null,
            }
        },
        methods: {
            nextSlide:function(){
                if(this.answer != null){
                    this.$emit('save', [1, this.answer])
                    $(".slider").slick('slickNext');
                }else{
                    this.error = "Je moet iets invullen"
                } 
            }
        }
    }
</script>

<style lang="scss" scoped>
    .question{
        //background-color: #70BEE7;
        background-color: #5A5C84;
    }

    .btn-question{
        color: #5A5C84;
    }
</style>


