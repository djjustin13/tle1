<template>
    <div class="question">
        <div v-if="error" class="alert alert-light" role="alert">
            {{ error }}
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4 text-center">
                <p>Rook je</p>
                <input type="text" v-model="answer">
                <button @click="nextSlide()">Next</button>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        name: 'question-four',
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
                    this.$router.push('overview')
                    // $(".slider").slick('slickNext');
                }else{
                    this.error = "Je moet iets invullen"
                }        
            }
        }
    }
</script>

<style lang="scss" scoped>
    .question{
        background-color: #98C6AF;
    }
</style>
