<template>
    <div class="overview">
        <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
        </div>
        <div class="row justify-content-center top-text">    
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Wat kan beter?
            </button>  
            <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                <!-- <p>Jouw levensstijl staat op dit moment gelijk aan 2 zonnepanelen.</p> -->
                <p v-if="totalScore">Jij gooit {{ originalScore }} Kilo's aan CO2 in de lucht!</p>
            </div>
        </div>
        
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Wat kan beter?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" v-if="this.answers">
                    Auto Rijden:
                    <div v-if="answers.car == false" class="text-success">Je hebt geen auto 👍</div>
                    <div v-else-if="carBelowAverage" class="text-success">Je rijdt minder dan de gemiddelde Nederlander 👍</div>
                    <div v-else class="text-danger">Je rijdt meer dan de gemiddelde Nederlander</div>
                    Vlees eten: <br>
                    <div v-if="meatBelowAverage" class="text-success">Je eet minder vlees dan de gemiddelde Nederlander 👍</div>
                    <div class="text-danger" v-else>Je eet meer vlees dan de gemiddelde Nederlander</div>
                    Douchen: <br>
                    <div v-if="showerBelowAverage" class="text-success">Je doucht korter dan de gemiddelede Nederlander 👍</div>
                    <div class="text-danger" v-else>Je doucht langer dan de gemiddelde Nederlander</div>
                    Roken:
                    <div v-if="answers.smoke == false" class="text-success">Je rookt niet 👍</div>
                    <div v-else-if="smokeBelowAverage" class="text-success">Je rookt minder dan de gemiddelde Nederlander 👍</div>
                    <div class="text-danger" v-else>Je rookt meer dan de gemiddelde Nederlander</div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
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
                answers: {},
                answers: null,
                globalScore: 0,
                userData: {},
                carChallenge: null,
                meatChallenge: null,
                smokeChallenge: null,
                showerChallenge: null,
                carBelowAverage: null,
                meatBelowAverage: null,
                smokeBelowAverage: null,
                showerBelowAverage: null
            }
        },methods:{
            reset:function(){
                localStorage.clear();
                this.answers = null;
                this.$router.push('/')
            },
            getAnswers:function() {
                let data = localStorage.getItem('answers')
                if (data){
                    this.answers = JSON.parse(data)
                    console.log(this.answers)
                }     
            },
            sendData:function(){
                axios.post('api/calculate', this.answers)
                .then((response)  =>  {
                    console.log(response)
                    this.userData = response.data
                    this.getCarChallenge()
                    this.getMeatChallenge()
                    this.getSmokeChallenge()
                    this.getShowerChallenge()
                })
                .catch(function (error) {
                    console.log(error.response)
                })
            },
            getCarChallenge:function() {
                let data = localStorage.getItem('carChallenge')
                if (data){
                    this.carChallenge =  JSON.parse(data)
                    this.carBelowAverage = this.carChallenge.newUsrBelowAverage
                    console.log("wel car challenge " + this.carBelowAverage)
                }else{
                    this.carBelowAverage = this.userData.car.usrBelowAverage
                    console.log("geen car challenge " + this.carBelowAverage)
                }
                
            },
            getMeatChallenge:function() {
                let data = localStorage.getItem('meatChallenge')
                if (data){
                    this.meatChallenge = JSON.parse(data)
                    this.meatBelowAverage = this.meatChallenge.newUsrBelowAverage
                    console.log("wel meat challenge " + this.meatBelowAverage)
                }else{
                    this.meatBelowAverage = this.userData.meat.usrBelowAverage
                    console.log("geen meat challenge " + this.meatBelowAverage)
                }
            },
            getSmokeChallenge:function() {
                let data = localStorage.getItem('smokeChallenge')
                if (data){
                    this.smokeChallenge = JSON.parse(data)
                    this.smokeBelowAverage = this.smokeChallenge.newUsrBelowAverage
                    console.log("wel smoke challenge " + this.smokeBelowAverage)
                }else{
                    this.smokeBelowAverage = this.userData.smoking.usrBelowAverage
                    console.log("geen smoke challenge " + this.smokeBelowAverage)
                }   
            },
            getShowerChallenge:function() {
                let data = localStorage.getItem('showerChallenge')
                if (data){
                    this.showerChallenge = JSON.parse(data)
                    this.showerBelowAverage = this.showerChallenge.newUsrBelowAverage
                    console.log("wel shower challenge " + this.showerBelowAverage)
                }else{
                    this.showerBelowAverage = this.userData.shower.usrBelowAverage
                    console.log("geen shower challenge " + this.showerBelowAverage)
                } 
            },
            updateOverview: function (){

                if(this.globalScore >= 3000){
                    console.log('Slecht')
                }else if (this.globalScore < 3000 && this.globalScore <= 2000){
                    console.log('Gemiddeld')
                }else if(this.globalScore < 2000 && this.globalScore >= 3000){
                    console.log('Goed')
                }else if(this.globalScore < 2000){
                    console.log('Supergoed')
                }
            }
        },
        computed: {
            originalScore: function () {
            let total = 0

            if (Object.keys(this.userData).length != 0){
                if(this.userData.car != false){
                    total += this.userData.car.usrDischargePerYear
                } 
                if(this.userData.meat != false){
                    total += this.userData.meat.usrDischargePerYear
                } 
                if(this.userData.shower != false){
                    total += this.userData.shower.usrDischargePerYear
                } 
                if(this.userData.smoking != false){
                    total += this.userData.smoking.usrDischargePerYear
                } 
            }
            
            return Math.round( total * 100 ) / 100
            },
            totalScore: function () {
            let total = 0

            if (Object.keys(this.userData).length != 0){
                if(this.carChallenge){
                    total += this.carChallenge.newCo2
                }else if(this.userData.car != false){
                    total += this.userData.car.usrDischargePerYear
                }
                if(this.meatChallenge){
                    total += this.meatChallenge.newCo2
                }else if(this.userData.meat != false){
                    total += this.userData.meat.usrDischargePerYear
                } 
                if(this.showerChallenge){
                    total += this.showerChallenge.newCo2
                }else if(this.userData.shower != false){
                    total += this.userData.shower.usrDischargePerYear
                } 
                if(this.smokeChallenge){
                    total += this.smokeChallenge.newCo2
                }else if(this.userData.smoking != false){
                    total += this.userData.smoking.usrDischargePerYear
                } 
            }
            console.log("new " + total + "--- original "+ this.originalScore)
            this.globalScore = Math.round( total * 100 ) / 100
            this.updateOverview()
            return Math.round( total * 100 ) / 100
            }
        },
        mounted: function() {
            this.getAnswers()
            this.sendData()
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


