<template>
    <div class="question">
        <div v-if="error" class="alert alert-light" role="alert">
            {{ error }}
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4 text-center">
                <p>Hoevaak douche je?</p>
                <input type="number" v-model="answer">
                <br><br>
                <button @click="nextSlide()">Next</button>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        name: 'question-two',
        data(){
            return{
                answer: null,
                error: null,
            }
        },
        methods: {
            nextSlide:function(){
                if(this.answer != null){
                    this.$emit('save', [2, this.answer])
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
        background-color: #79AA83;
    }
</style>


