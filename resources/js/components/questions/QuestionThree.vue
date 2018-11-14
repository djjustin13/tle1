<template>
    <div class="question">
        <div v-if="error" class="alert alert-light" role="alert">
            {{ error }}
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4 text-center">
                <p>Hoe vaak eet je vlees</p>
                <input type="number" v-model="answer">
                <br><br>
                <button @click="nextSlide()">Next</button>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        name: 'question-three',
        data(){
            return{
                answer: null,
                error: null,
            }
        },
        methods: {
            nextSlide:function(){
                if(this.answer != null){
                    this.$emit('save', [3, this.answer])
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
        background-color: rgb(27, 165, 0);
    }
</style>


