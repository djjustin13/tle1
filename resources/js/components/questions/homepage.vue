<template>
<div class="background">
    <div class="question">
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <h1 class="py-2">Awareness010</h1>
                    <h2>Verlaag stap voor stap jouw ecologische voetafdruk!</h2>
                    <img class="card-img" src="/img/sun.png" alt="meat">

                    <div class="py-4">
                        <button class="btn btn-light question-btn px-3" @click="nextSlide()">Start de vragen!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
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
        color: #5A5C84;
        width: 70%;
    }

    h1, h2 {
        font-family: Helvetica, Arial, sans-serif;
    }

    h1 {
        color:black;
    }

    .background {
        background: linear-gradient(-100deg,#23A6D5, #23D5AB) !important;
	    background-size: 400% 400%;
        animation: Gradient 15s ease infinite;
    }
</style>


