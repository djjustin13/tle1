<template>

    <div class="question background">
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
            </div>

            <a @click="reset()" href="#">Clear storage & restart</a>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">

                    <div v-if="doesSmoke === null">
                        <h1 class="py-2">Rook je?</h1>
                        <img class="card-img" src="/img/cigarette.png" alt="meat">
                        <div class="py-4">
                            <button class="btn btn-light question-btn yes-no-btn mx-1" @click="yes()">Ja</button>
                            <button class="btn btn-light question-btn yes-no-btn mx-1" @click="no()">Nee</button>
                        </div>
                    </div>

                    <div v-if="doesSmoke === true">
                        <h1 class="py-2">Hoeveel sigaretten rook je gemiddeld per dag?</h1>
                        <img class="card-img" src="/img/cigarette.png" alt="meat">
                        <v-numberInput controls :min=1 :max=60 placeholder="vul in" v-model="cigaretteAmount" :searchable=false></v-numberInput>
                        <label> {{cigaretteAmount}} {{sigaretSigatetten(cigaretteAmount)}}</label>
                        <div class="py-4">
                            <button class="btn btn-light question-btn px-4" @click="saveCigaretteAmount()">Volgende</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        name: 'question-four',
        data(){
            return{
                doesSmoke: null,
                cigaretteAmount: 10,
                answer: null,
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
                this.doesSmoke = true;
            },
            no:function(){
                this.doesSmoke = false
                this.answer = this.doesSmoke
                this.nextSlide()
            },
            sigaretSigatetten:function(input){
                if(input == 1){
                    return 'sigaret'
                }else{
                    return 'sigaretten'
                }
            },
            saveCigaretteAmount:function(){
                this.answer = this.cigaretteAmount
                this.nextSlide()
            },
            nextSlide:function(){
                if(this.answer != null){
                    this.$emit('save', ["smoke", this.answer])
                    this.$router.push('overview')
                }else{
                    this.error = "Je moet iets invullen"
                }        
            }
        }
    }
</script>

<style lang="scss" scoped>
    .question{
        background-color: #6A7FAD;
    }

    .question-btn{
        color: #6A7FAD;
    }

    .yes-no-btn{
        color: #6A7FAD;
    }

    .background {
        // background: linear-gradient(-100deg,#23D5AB, #58B4D5) !important;
        // background-size: 400% 400%;
        // animation: Gradient 15s ease infinite;
        background-color:#6A7FAD;
    }
</style>
