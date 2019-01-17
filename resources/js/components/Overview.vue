<template>
    <div class="overview">
        <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}
        </div>
        
        <!-- improveModal -->
        <div class="modal fade improveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <div v-if="answers.car == false" class="text-success"> Je rijdt geen auto 👍</div>
                                    <div v-else-if="carBelowAverage" class="text-success">Je rijdt zuiniger dan de gemiddelde Nederlander 👍</div>
                                    <div v-else class="text-danger">Je rijdt meer dan de gemiddelde Nederlander</div>
                                </div>
                                <button 
                                    v-if="downArrow.car" 
                                    @click="downArrow.car = false, downArrow.meat = true, downArrow.shower = true, downArrow.smoke = true"
                                    class="btn btn-success col-auto" 
                                    data-toggle="collapse" 
                                    data-target="#car">
                                        <i class="fas fa-chevron-down"></i>
                                </button>
                                <button
                                    v-if="downArrow.car == false"
                                    @click="downArrow.car = true, downArrow.meat = true, downArrow.shower = true, downArrow.smoke = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#car">
                                        <i class="fas fa-chevron-up"></i>
                                </button>
                            </div>
                            <div id="car" class="collapse" data-parent="#accordion">
                                <div v-if="avgDischargeYear.car" class="card-body">
                                    De gemiddelde Nederlander stoot per jaar ongeveer {{avgDischargeYear.car}} kilo CO2 uit met auto rijden.
                                    Jij stoot hiermee {{dischargeYear.car}} kilo CO2 uit per jaar.
                                </div>
                                <div v-else class="card-body">
                                    De gemiddelde Nederlander stoot per jaar ongeveer 1388 kilo CO2 uit met auto rijden.
                                    Jij rijdt niet en stoot dus niks uit!
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
                                    v-if="downArrow.meat"
                                    @click="downArrow.meat = false, downArrow.car = true, downArrow.shower = true, downArrow.smoke = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#meat">
                                        <i class="fas fa-chevron-down"></i>
                                </button>
                                <button
                                    v-if="downArrow.meat == false"
                                    @click="downArrow.meat = true, downArrow.car = true, downArrow.shower = true, downArrow.smoke = true"
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
                                    v-if="downArrow.shower"
                                    @click="downArrow.shower = false, downArrow.car = true, downArrow.meat = true, downArrow.smoke = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#shower">
                                        <i class="fas fa-chevron-down"></i>
                                </button>
                                <button
                                    v-if="downArrow.shower == false"
                                    @click="downArrow.shower = true, downArrow.car = true, downArrow.meat = true, downArrow.smoke = true"
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
                                    v-if="downArrow.smoke"
                                    @click="downArrow.smoke = false, downArrow.car = true, downArrow.meat = true, downArrow.shower = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#smoke">
                                        <i id="#smokeArrow" class="fas fa-chevron-down"></i>
                                </button>
                                <button
                                    v-if="downArrow.smoke == false"
                                    @click="downArrow.smoke = true, downArrow.car = true, downArrow.meat = true, downArrow.shower = true"
                                    class="btn btn-success col-auto"
                                    data-toggle="collapse"
                                    data-target="#smoke">
                                        <i class="fas fa-chevron-up"></i>
                                </button>
                            </div>
                            <div id="smoke" class="collapse" data-parent="#accordion">
                                <div v-if="avgDischargeYear.smoke" class="card-body">
                                    De gemiddelde Nederlander stoot per jaar ongeveer {{avgDischargeYear.smoke}} kilo CO2 uit door te roken.
                                    Jij stoot hiermee {{dischargeYear.smoke}} kilo CO2 uit per jaar.
                                </div>
                                <div v-else class="card-body">
                                    De gemiddelde Nederlander stoot per jaar ongeveer 5 kilo CO2 uit door te roken.
                                    Jij rookt niet en stoot dus niks uit!
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

        <!-- solarModal -->
        <div class="modal fade solarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                    <div v-if="(avgYearlyCo2 - globalScore) > 0" class="modal-header">
                        <p class="solar-modal-text">
                            Jij verbruikt op dit moment {{ globalScore }} kg CO2 met de vier gewoontes waar we naar hebben gevraagd.
                            <br>
                            De gemiddelde Nederlander verbruikt hiermee ongeveer 2425 kg CO2 per jaar.
                            Dat is een verschil van
                            <span class="text-success">{{avgYearlyCo2 - globalScore}} kg CO2.</span> Lekker bezig!
                            <br>
                            {{avgYearlyCo2 - globalScore}} kg CO2 staat gelijk aan wat <span class="text-primary">{{ solarPanelBalance }} zonnepanelen</span> voor een jaar op je dak aan CO2 besparen!
                        </p>
                    </div>
                    <div v-else class="modal-header">
                        <p class="solar-modal-text">
                            Jij verbruikt op dit moment {{ globalScore }} kg CO2 met de vier gewoontes waar we naar hebben gevraagd.
                            <br>
                            De gemiddelde Nederlander verbruikt hiermee ongeveer 2425 kg CO2 per jaar.
                            Jij verbruikt dus <span class="text-danger">{{globalScore - avgYearlyCo2}} kg CO2</span> meer.
                            <br>
                            Ga challenges aan om zonnepanelen te verdienen!
                        </p>
                    </div>
                    <div class="card-body py-0">
                        <div class="row justify-content-start">
                            <div class="col-3 py-2 justify-content-center" v-for="panel in solarPanelArray" v-bind:key="panel.id">
                                <img class="solarPanel" src="/icons/50x50.png" alt="solarPanel">
                            </div>
                        </div>    
                    </div>
                    
                    <div class="modal-footer">
                        <div class="accordion-content">
                            Haal zonnepanelen door challenges aan te gaan!
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
                    </div>
               </div>
           </div>
        </div>

        <img class="sun asset" src="/img/sun.png" alt="Sun">
        <img class="cloud1 asset" src="/img/cloud_lg.png" alt="Cloud">
        <img class="cloud2 asset" src="/img/cloud_lg.png" alt="Cloud">
        <img v-if="userState == 0" class="background" src="/img/factories.png" alt="">
        <img v-if="userState > 2" class="background good_2" src="/img/trees.png" alt="">
        <div class="container-fluid">
            <div class="row justify-content-center">    
                <!-- Button trigger modal -->
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center modal-button">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".improveModal">
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
            
        </div>
        <div class="row justify-content-center bottom-text">      
            <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                <p v-if="totalScore">Jouw jaarlijkse uitstoot op dit moment: {{ globalScore }} kg CO2</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".solarModal">
                Wat betekend dit?
                </button> 
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
                downArrow: {
                    car: true,
                    meat: true,
                    shower: true,
                    smoke: true
                },
                avgYearlyCo2: 2425,
                yearlySolarGeneration: 95,
                solarPanelArray: [],
                solarPanelBalance: 0,
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
                    console.log('test')
                    this.totalScore()
                    this.makeSolarPanelArray()
                })
                .catch(function (error) {
                    console.log(error.response)
                })
            },
            checkCarChallenge:function() {
                let data = localStorage.getItem('carChallenge')
                if (data){
                    this.carChallenge =  JSON.parse(data)
                    this.carBelowAverage = this.carChallenge.newUsrBelowAverage
                    this.dischargeYear.car = ((this.carChallenge.newCo2 / 7) * 365).toFixed(2)
                    console.log("wel car challenge " + this.carBelowAverage)
                }else if(this.userData.car){
                    this.avgDischargeYear.car = this.userData.car.avgDischargeYear
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
                if (data){
                    this.smokeChallenge = JSON.parse(data)
                    this.smokeBelowAverage = this.smokeChallenge.newUsrBelowAverage
                    this.dischargeYear.smoke = ((this.smokeChallenge.newCo2 / 7) * 365).toFixed(2)
                }else if(this.userData.smoking){
                    this.avgDischargeYear.smoke = this.userData.smoking.avgDischargeYear
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
            },totalScore: function () {
                let total = 0
                console.log('totalscore aangeroepen')

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
            makeSolarPanelArray: function (){
                console.log(this.globalScore)
                this.solarPanelBalance = ((this.avgYearlyCo2 - this.globalScore) / this.yearlySolarGeneration).toFixed(0)
                
                console.log(this.solarPanelBalance)
                for(let i = 0; i < this.solarPanelBalance; i++) {
                    this.solarPanelArray.push(i)
                    console.log('test')
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
            checkCollapse : function(){
                $('.collapse').on('hidden.bs.collapse', function () {
                    console.log("collapse")
                })
            },
        
        },
        created: function() {
            this.getAnswers()
            this.calculateData()
        },
           
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
    
    .solarPanel{
        display: block;
        margin-left: auto;
        margin-right: auto;
        max-width: 100%;
    }
    .solar-modal-text{
        font-size: 16px;
        line-height: normal;
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


