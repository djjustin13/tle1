
<template>
<div class="background">
    <div class="question">
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <h1 class="py-2 home-title">Awareness 010</h1>
                    <h2>Verlaag stap voor stap jouw ecologische voetafdruk!</h2>
                    <img class="card-img" src="/img/sun_panel_500x500.png" alt="sun">

                    <div class="py-4">
                        <button class="btn btn-light question-btn px-3" @click="nextSlide()">Start de vragen!</button>
                    </div>

                    <div class="ula-container">
                        <p>Wil je weten wat we met jouw data doen? lees <router-link :to=" '/privacy' " class="btn btn-link">Privacy Statement</router-link></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

  promptForPwa() {
    let today = today;
    let appleUsers =  ['iPhone', 'iPad', 'iPod'].includes(navigator.platform);
  };

    export default {
        name: 'homepage',
        data() {
            return {
                error: null,
            }
        },
        methods: {
            nextSlide: function () {
                $(".slider").slick('slickNext');
            },
        }
    }
</script>

<style lang="scss" scoped>
    
    .question-btn{
        color: #54c0eb;
        width: 70%;
    }

    .background {
        // background: linear-gradient(-100deg,#23A6D5, #23D5AB) !important;
	    // background-size: 400% 400%;
        // animation: Gradient 15s ease infinite;
        background-color:#54c0eb;
    }
</style>


