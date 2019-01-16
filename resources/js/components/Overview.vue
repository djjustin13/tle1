<template>
    <div class="overview">
        <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
        </div>
        
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Wat kan beter?</h5>
                    </div>
                    <div class="modal-body accordion p-0" id="accordion"> 
                        <!-- car -->
                        <div class="card">
                            <div class="card-header row  d-flex justify-content-between m-0"> 
                                <div class="accordion-content">
                                    Auto rijden:
                                    <div v-if="answers.car == false" class="text-success"> Je hebt geen auto 👍</div>
                                    <div v-else-if="carBelowAverage" class="text-success">Je rijdt zuiniger dan de gemiddelde Nederlander 👍</div>
                                    <div v-else class="text-danger">Je rijdt meer dan de gemiddelde Nederlander</div>
                                </div>
                                <button 
                                    v-if="leftArrow.car" 
                                    @click="leftArrow.car = false, leftArrow.meat = true, leftArrow.shower = true, leftArrow.smoke = true"
                                    class="btn btn-success col-auto" 
                                    data-toggle="collapse" 
                                    data-target="#car">
                                        <i class="fas fa-chevron-down"></i>
                                </button>
                                <button
                                    v-if="leftArrow.car == false"
                                    @click="leftArrow.car = true, leftArrow.meat = true, leftArrow.shower = true, leftArrow.smoke = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#car">
                                        <i class="fas fa-chevron-up"></i>
                                </button>
                            </div>
                            <div id="car" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    De gemiddelde Nederlander stoot per jaar ongeveer {{avgDischargeYear.car}} kilo CO2 uit met auto rijden.
                                    Jij stoot hiermee {{dischargeYear.car}} kilo CO2 uit per jaar.
                                </div>
                            </div>
                        </div>

                        <!-- meat -->
                        <div class="card">
                            <div class="card-header row  d-flex justify-content-between m-0">  
                                <div class="accordion-content">
                                    Vlees eten:
                                    <div v-if="answers.meat < 7" class="text-success">Je eet minder vlees dan de gemiddelde Nederlander 👍</div>
                                    <div class="text-danger" v-else>Je eet meer vlees dan de gemiddelde Nederlander</div>
                                </div>
                                <button
                                    v-if="leftArrow.meat"
                                    @click="leftArrow.meat = false, leftArrow.car = true, leftArrow.shower = true, leftArrow.smoke = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#meat">
                                        <i class="fas fa-chevron-down"></i>
                                </button>
                                <button
                                    v-if="leftArrow.meat == false"
                                    @click="leftArrow.meat = true, leftArrow.car = true, leftArrow.shower = true, leftArrow.smoke = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#meat">
                                        <i class="fas fa-chevron-up"></i>
                                </button>
                            </div>
                            <div id="meat" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    De gemiddelde Nederlander stoot per jaar ongeveer {{avgDischargeYear.meat}} kilo CO2 uit door vlees te eten.
                                    Jij stoot hiermee {{dischargeYear.meat}} kilo CO2 uit per jaar.
                                   
                                </div>
                            </div>
                        </div>
                        <!-- shower -->
                        <div class="card">
                            <div class="card-header row  d-flex justify-content-between m-0"> 
                                <div class="accordion-content">    
                                    Douchen:
                                    <div v-if="showerBelowAverage" class="text-success">Je doucht korter dan de gemiddelede Nederlander 👍</div>
                                    <div class="text-danger" v-else>Je doucht langer dan de gemiddelde Nederlander</div>
                                </div>
                                <button
                                    v-if="leftArrow.shower"
                                    @click="leftArrow.shower = false, leftArrow.car = true, leftArrow.meat = true, leftArrow.smoke = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#shower">
                                        <i class="fas fa-chevron-down"></i>
                                </button>
                                <button
                                    v-if="leftArrow.shower == false"
                                    @click="leftArrow.shower = true, leftArrow.car = true, leftArrow.meat = true, leftArrow.smoke = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#shower">
                                        <i class="fas fa-chevron-up"></i>
                                </button>
                            </div>
                            <div id="shower" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    De gemiddelde Nederlander stoot per jaar ongeveer {{avgDischargeYear.shower}} kilo CO2 uit door te douchen.
                                    Jij stoot hiermee {{dischargeYear.shower}} kilo CO2 uit per jaar.
                                </div>
                            </div>
                        </div>    
                        <!-- smoke -->
                        <div class="card">
                            <div class="card-header row  d-flex justify-content-between m-0">   
                                <div class="accordion-content">
                                    Roken:
                                    <div v-if="answers.smoke == false" class="text-success">Je rookt niet 👍</div>
                                    <div v-else-if="smokeBelowAverage" class="text-success">Je rookt minder dan de gemiddelde Nederlander 👍</div>
                                    <div class="text-danger" v-else>Je rookt meer dan de gemiddelde Nederlander</div>
                                </div>    
                                <button
                                    v-if="leftArrow.smoke"
                                    @click="leftArrow.smoke = false, leftArrow.car = true, leftArrow.meat = true, leftArrow.shower = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#smoke">
                                        <i id="#smokeArrow" class="fas fa-chevron-down"></i>
                                </button>
                                <button
                                    v-if="leftArrow.smoke == false"
                                    @click="leftArrow.smoke = true, leftArrow.car = true, leftArrow.meat = true, leftArrow.shower = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#smoke">
                                        <i class="fas fa-chevron-up"></i>
                                </button>
                            </div>
                            <div id="smoke" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    De gemiddelde Nederlander stoot per jaar ongeveer {{avgDischargeYear.smoke}} kilo CO2 uit door te roken.
                                    Jij stoot hiermee {{dischargeYear.smoke}} kilo CO2 uit per jaar.
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="accordion-content">
                                Tik op de iconen op jouw huis om een challenge aan te gaan!
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <img class="sun asset" src="/img/sun.png" alt="Sun">
        <img class="cloud1 asset" src="/img/cloud_lg.png" alt="Cloud">
        <img class="cloud2 asset" src="/img/cloud_lg.png" alt="Cloud">
        <img v-if="userState == 0" class="background" src="/img/factories.png" alt="">
        <img v-if="userState > 2" class="asset good_2" src="/img/good_2_tree.png" alt="">
        <div class="container-fluid">
            <div class="row justify-content-center">    
                <!-- Button trigger modal -->
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center modal-button">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                    Wat kan beter?
                    </button> 
                </div>
            </div>
            <div class="row justify-content-center">      
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <div class="house">
                        <img class="house-img" src="/img/house.png" alt="house" usemap="#image-map">
                        
                        <span v-if="answers.car" class="icon icon-car" @click="$router.push('challengecar')"></span>
                        <span v-if="answers.smoke" class="icon icon-smoke" @click="$router.push('challengesmoking')"></span>
                        <span class="icon icon-meat" @click="$router.push('challengemeat')"></span>
                        <span class="icon icon-shower" @click="$router.push('challengeshower')"></span>
                    </div>
                    <map name="image-map">
                        <area v-if="answers.car" target="" alt="Garage" title="Auto gebruik" @click="$router.push('challengecar')" coords="20,253,55,258,54,316,20,307" shape="poly">
                        <area v-if="answers.smoke" target="" alt="Smoke" title="Roken" @click="$router.push('challengesmoking')" coords="177,178,269,190,270,239,177,239" shape="poly">
                        <area target="" alt="Meat" title="Vlees eten" @click="$router.push('challengemeat')" coords="177,253,269,249,272,326,179,349" shape="poly">
                        <area target="" alt="Shower" title="Douchen" @click="$router.push('challengeshower')" coords="273,249,325,246,325,309,273,327" shape="poly">
                    </map>
                   
                    <!-- <a @click="reset()" href="#">Clear storage & restart</a> -->
                </div>
            </div>
            <img v-if="userState > 1" class="good_1 asset" src="/img/good_2_bush.png" alt="">
        </div>
        <div class="row justify-content-center bottom-text">      
            <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                <p v-if="totalScore">Jouw jaarlijkse uitstoot op dit moment: {{ globalScore }} KG CO2</p>
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
                globalScore: 0,
                userState: 1,
                userData: {},
                carChallenge: null,
                meatChallenge: null,
                smokeChallenge: null,
                showerChallenge: null,
                carBelowAverage: null,
                meatBelowAverage: null,
                smokeBelowAverage: null,
                showerBelowAverage: null,
                dischargeYear: {},
                avgDischargeYear: {},
                leftArrow: {
                    car: true,
                    meat: true,
                    shower: true,
                    smoke: true
                },
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
            calculateData:function(){
                axios.post('api/calculate', this.answers)
                .then((response)  =>  {
                    console.log(response)
                    this.userData = response.data
                    this.checkCarChallenge()
                    this.checkMeatChallenge()
                    this.checkSmokeChallenge()
                    this.checkShowerChallenge()
                })
                .catch(function (error) {
                    console.log(error.response)
                })
            },
            checkCarChallenge:function() {
                let data = localStorage.getItem('carChallenge')
                this.avgDischargeYear.car = this.userData.car.avgDischargeYear
                if (data){
                    this.carChallenge =  JSON.parse(data)
                    this.carBelowAverage = this.carChallenge.newUsrBelowAverage
                    this.dischargeYear.car = ((this.carChallenge.newCo2 / 7) * 365).toFixed(2)
                    console.log("wel car challenge " + this.carBelowAverage)
                }else{
                    this.carBelowAverage = this.userData.car.usrBelowAverage
                    this.dischargeYear.car = this.userData.car.usrDischargePerYear.toFixed(2)
                    console.log("geen car challenge " + this.carBelowAverage)
                }
                
            },
            checkMeatChallenge:function() {
                let data = localStorage.getItem('meatChallenge')
                this.avgDischargeYear.meat = this.userData.meat.avgDischargeYear
                if (data){
                    this.meatChallenge = JSON.parse(data)
                    this.meatBelowAverage = this.meatChallenge.newUsrBelowAverage
                    this.dischargeYear.meat = ((this.meatChallenge.newCo2 / 7) * 365).toFixed(2)
                }else{
                    this.meatBelowAverage = this.userData.meat.usrBelowAverage
                    this.dischargeYear.meat = this.userData.meat.usrDischargePerYear.toFixed(2)
                }
            },
            checkSmokeChallenge:function() {
                let data = localStorage.getItem('smokeChallenge')
                this.avgDischargeYear.smoke = this.userData.smoking.avgDischargeYear
                if (data){
                    this.smokeChallenge = JSON.parse(data)
                    this.smokeBelowAverage = this.smokeChallenge.newUsrBelowAverage
                    this.dischargeYear.smoke = ((this.smokeChallenge.newCo2 / 7) * 365).toFixed(2)
                }else{
                    this.smokeBelowAverage = this.userData.smoking.usrBelowAverage
                    this.dischargeYear.smoke = this.userData.smoking.usrDischargePerYear.toFixed(2)
                }   
            },
            checkShowerChallenge:function() {
                let data = localStorage.getItem('showerChallenge')
                this.avgDischargeYear.shower = this.userData.shower.avgDischargeYear
                if (data){
                    this.showerChallenge = JSON.parse(data)
                    this.showerBelowAverage = this.showerChallenge.newUsrBelowAverage
                    this.dischargeYear.shower = ((this.showerChallenge.newCo2 / 7) * 365).toFixed(2)
                }else{
                    this.showerBelowAverage = this.userData.shower.usrBelowAverage
                    this.dischargeYear.shower = this.userData.shower.usrDischargePerYear.toFixed(2)
                } 
            },
            updateOverview: function (){

                if(this.globalScore >= 3000){
                    this.userState = 0
                    console.log('Slecht')
                }else if (this.globalScore < 3000 && this.globalScore >= 2000){
                    this.userState = 1
                    console.log('Gemiddeld')
                }else if(this.globalScore < 2000 && this.globalScore >= 1000){
                    this.userState = 2
                    console.log('Goed')
                }else if(this.globalScore < 1000){
                    this.userState = 3
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
                        total += (this.carChallenge.newCo2 * 52)
                    }else if(this.userData.car != false){
                        total += this.userData.car.usrDischargePerYear
                    }
                    if(this.meatChallenge){
                        total += (this.meatChallenge.newCo2  * 52)
                    }else if(this.userData.meat != false){
                        total += this.userData.meat.usrDischargePerYear
                    } 
                    if(this.showerChallenge){
                        total += (this.showerChallenge.newCo2  * 52)
                    }else if(this.userData.shower != false){
                        total += this.userData.shower.usrDischargePerYear
                    } 
                    if(this.smokeChallenge){
                        total += (this.smokeChallenge.newCo2  * 52)
                    }else if(this.userData.smoking != false){
                        total += this.userData.smoking.usrDischargePerYear
                    } 
                }
                console.log("new " + total + "--- original "+ this.originalScore)
                this.globalScore = Math.round( total * 100 ) / 100
                this.updateOverview()
                return Math.round( total * 100 ) / 100
            },
            checkCollapse : function(){
                $('.collapse').on('hidden.bs.collapse', function () {
                    console.log("collapse")
                })
            }
        
        },
        created: function() {
            this.getAnswers()
            this.calculateData()
        }
    }
</script>

<style lang="scss" scoped>
    button{
        min-width: 20%;
        max-height: 48px;
    }

    .accordion-content{
        max-width: 70%;
    }

    .alert{
        position: absolute;
        top: 0;
        width: 100%;
    }

    .modal-button{
        position: absolute;
        margin: 0;
        top: 4%;
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
        &.good_1 {
            top: 73%;
            left: 30%;
            transform: scale(1, 1);
        }
        &.good_2 {
            top: 48%;
            left: 2%;
            -webkit-transform: scale(1, 1);
            transform: scale(1, 1);
        }
    }

    .background{
        position: fixed;
        margin: 0 auto;
        margin-top: -17px;
        left: calc(50% - 188px);
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


