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
                    <div class="house">
                        <img class="house-img" src="/img/house.png" alt="house" usemap="#image-map">
                        <span class="icon icon-car" @click="$router.push('challengecar')"></span>
                        <span class="icon icon-smoke" @click="$router.push('challengesmoking')"></span>
                        <span class="icon icon-meat" @click="$router.push('challengemeat')"></span>
                        <span class="icon icon-shower" @click="$router.push('challengeshower')"></span>
                    </div>
                    <map name="image-map">
                        <area target="" alt="Garage" title="Auto gebruik" @click="$router.push('challengecar')" coords="20,253,55,258,54,316,20,307" shape="poly">
                        <area target="" alt="Smoke" title="Roken" @click="$router.push('challengesmoking')" coords="177,178,269,190,270,239,177,239" shape="poly">
                        <area target="" alt="Meat" title="Vlees eten" @click="$router.push('challengemeat')" coords="177,253,269,249,272,326,179,349" shape="poly">
                        <area target="" alt="Shower" title="Douchen" @click="$router.push('challengeshower')" coords="273,249,325,246,325,309,273,327" shape="poly">
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
                userData: {},
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
                    this.userData = response.data
                    console.log('Total score: '+this.totalScore)
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
        computed: {
            totalScore: function () {
            let total = 0

            if(this.userData.car.usrAnnualDischarge != undefined){
                console.log('car')
                total + this.userData.car.usrAnnualDischarge
            } 
            if(this.userData.meat.usrAnnualDischarge != undefined){
                console.log('meat')
                total + this.userData.meat.usrAnnualDischarge
            } 
            if(this.userData.shower.usrAnnualDischarge != undefined){
                console.log('shower')
                total + this.userData.shower.usrAnnualDischarge
            } 
            if(this.userData.smoking.usrAnnualDischarge != undefined){
                console.log('smoking')
                total + this.userData.smoking.usrAnnualDischarge

            } 
            return total
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

    .house{
        position: relative; 
        width: 345px;
        margin: 0 auto;

        .icon{
            cursor: pointer;
            height: 40px;
            width: 40px;
            border-radius: 50%;
            display: inline-block;
            position: absolute;
            transition: all 0.2s ease-out;

            &.icon-meat{
                top: 273px;
                left: 200px;
                background-color: #5A5C84;
                &:after{
                    content: '';
                    position: absolute;
                    left: 5px;
                    top: 4px;
                    width: 30px;
                    height: 30px;
                    background-image: url(/img/icons/meat.png);
                    background-size: contain;
                    background-position: center;
                    background-repeat: no-repeat;
                }
            }

            &.icon-smoke{
                top: 193px;
                left: 200px;
                background-color: #6E7FA9;
                &:after{
                    content: '';
                    position: absolute;
                    left: 5px;
                    width: 30px;
                    height: 30px;
                    background-image: url(/img/icons/smoking.png);
                    background-size: contain;
                    background-position: center;
                    background-repeat: no-repeat;
                }
            }

            &.icon-car{
                top: 264px;
                left: 16px;
                background-color: #5A979D;
                &:after{
                    content: '';
                    position: absolute;
                    left: 3px;
                    width: 35px;
                    height: 35px;
                    background-image: url(/img/icons/car.png);
                    background-size: contain;
                    background-position: center;
                    background-repeat: no-repeat;
                }
            }

            &.icon-shower{
                top: 262px;
                left: 278px;
                background-color: #79AA83;
                &:after{
                    content: '';
                    position: absolute;
                    left: 3px;
                    width: 35px;
                    height: 35px;
                    background-image: url(/img/icons/shower.png);
                    background-size: contain;
                    background-position: center;
                    background-repeat: no-repeat;
                }
            }

            &:hover{
                transform: scale(1.2,1.2);
            }
        }
    }

    

</style>


