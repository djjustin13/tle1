<template>
    <div class="overview">
        <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
        </div>
        <div class="row justify-content-center top-text">      
            <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                <p>Jouw levensstijl staat op dit moment gelijk aan 2 zonnepanelen.</p>
            </div>
        </div>
        <img class="sun asset" src="/img/sun.png" alt="Sun">
        <img class="cloud1 asset" src="/img/cloud_lg.png" alt="Cloud">
        <img class="cloud2 asset" src="/img/cloud_lg.png" alt="Cloud">
        <div class="container-fluid">
            <div class="row justify-content-center">      
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <img class="house-img" src="/img/house.png" alt="house" usemap="#image-map">
                    <map name="image-map">
                        <area target="" alt="Shower" title="Douchen" @click="$router.push('challengeshower')" coords="178,79,281,94,280,148,178,149" shape="poly">
                        <area target="" alt="Smoke" title="Roken" @click="$router.push('challengesmoking')" coords="286,95,342,105,341,148,285,149" shape="poly">
                        <area target="" alt="Meat" title="Vlees eten" @click="$router.push('challengemeat')" coords="178,162,281,161,281,243,178,271" shape="poly">
                        <area target="" alt="Room 4" title="Room 4" href="#room4" coords="285,161,342,157,343,225,285,241" shape="poly">
                        <area target="" alt="Garage" title="Auto gebruik" @click="$router.push('challengecar')" coords="0,156,47,156,48,238,0,221" shape="poly">
                        <area target="" alt="Solar panel" title="Solar panel" href="#roof" coords="100,16,290,53,344,100,176,76" shape="poly">
                    </map>
                   
                    <!-- <a @click="reset()" href="#">Clear storage & restart</a> -->
                </div>
            </div>
        </div>
        <div class="row justify-content-center bottom-text">      
            <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                <p>Klik op de iconen in je huis om te kijken wat je kunt veranderen om je leven duurzamer te maken!</p>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'overview',
        components:{
        },
        data(){
            return{
                error: null,
                answers: null,
                carChallenge: null,
                meatChallenge: null,
            }
        },methods:{
            reset:function(){
                localStorage.clear();
                this.answers = null;
                this.$router.push('/')
            },
            sendData:function(){
                axios.post('api/calculate', this.answers)
                .then((response)  =>  {
                    console.log(response.data)
                })
                .catch(function (error) {
                    console.log(error.response)
                })
            },
            getAnswers:function() {
                let data = localStorage.getItem('answers')
                if (data){
                    this.answers = JSON.parse(data)
                }
            },
            getCarChallenge:function() {
                let data = localStorage.getItem('carChallenge')
                console.log(data)
                if (data){
                    this.carChallenge =  JSON.parse(data)
                    console.log(this.carChallenge)
                }
            },
            getMeatChallenge:function() {
                let data = localStorage.getItem('meatChallenge')
                if (data){
                    this.meatChallenge = JSON.parse(data)
                    console.log(this.meatChallenge)
                }
            }
        },
        mounted: function() {
            this.getAnswers();
            this.getCarChallenge();
            this.getMeatChallenge();
            this.sendData();
        }
    }
</script>

<style lang="scss" scoped>
    .alert{
        position: absolute;
        top: 0;
        width: 100%;
    }

    .top-text{
        position: absolute;
        margin: 0;
        top: 6%;
        width: 100%;
        z-index: 5;
    }

    .bottom-text{
        position: absolute;
        margin: 0;
        bottom: 4%;
        width: 100%;
        z-index: 5;
        color: #ffffff;
    }

    .overview{
        background: linear-gradient(0deg, #79AA83 45%, #70BEE7 45%);
        height: 100vh;
        display: flex;
        align-items: center;
    }

    .asset{
        position: absolute;
        transform: scale(1.4, 1.4);

        &.sun{
           top: 10%;
           left: 45%;
        }
        &.cloud1{
           top: 14%;
           left: 60%;
        }
        &.cloud2{
           top: 9%;
           left: 30%;
        }
    }

</style>


