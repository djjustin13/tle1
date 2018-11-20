<template>
    <div class="question">
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
            </div>

            <a @click="reset()" href="#">Clear storage & restart</a>

            <div class="row justify-content-md-center">
                <div class="col-md-4 text-center">

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
                        <input class="form-control" type="number" v-model="cigaretteAmount">
                        <label> {{cigaretteAmount}} sigaretten</label>
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
                cigaretteAmount: null,
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
</style>
