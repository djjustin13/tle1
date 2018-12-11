<template>
    <div>
        <div class="container">
            <div v-if="error" class="alert alert-light" role="alert">
                {{ error }}

            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center">
                    <img class="house-img" src="/img/house.png" alt="house" usemap="#image-map">
                    <map name="image-map">
                        <area target="" alt="Room 1" title="Room 1" href="#room1" coords="178,79,281,94,280,148,178,149" shape="poly">
                        <area target="" alt="Room 2" title="Room 2" href="#room2" coords="286,95,342,105,341,148,285,149" shape="poly">
                        <area target="" alt="Meat" title="Meat" href="#meat" coords="178,162,281,161,281,243,178,271" shape="poly">
                        <area target="" alt="Room 4" title="Room 4" href="#room4" coords="285,161,342,157,343,225,285,241" shape="poly">
                        <area target="" alt="Garage" title="Garage" href="#garage" coords="0,156,47,156,48,238,0,221" shape="poly">
                        <area target="" alt="Solar panel" title="Solar panel" href="#roof" coords="100,16,290,53,344,100,176,76" shape="poly">
                    </map>
                    <hr>
                    <p>Overview</p>
                    <hr>
                    {{ answers }}
                    <br>
                    {{ carChallenge }}
                    <a @click="reset()" href="#">Clear storage & restart</a>
                    <br>
                    <button @click="$router.push('challengecar')" class="btn btn-dark">Car Challenge!</button>
                    <br>
                    <button @click="$router.push('challengemeat')" class="btn btn-dark">Meat Challenge!</button>
                    <br>
                    <button @click="$router.push('challengeshower')" class="btn btn-dark">Shower Challenge!</button>
                    <br>
                    <button @click="$router.push('challengesmoking')" class="btn btn-dark">Smoking Challenge!</button>

                </div>
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
                answers: null,
                carChallenge: null,
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
                    console.log(error.response);
                })
            },
            getAnswers:function() {
                let data = localStorage.getItem('answers');
                if (data){
                    let object = JSON.parse(data);
                    this.answers = object;
                }
            },
            getCarChallenge:function() {
                let data = localStorage.getItem('carChallenge');
                if (data){
                    let object = JSON.parse(data);
                    this.carChallenge = object;
                }
            }
        },
        mounted: function() {
            this.getAnswers();
            this.getCarChallenge();
            this.sendData();
        }
    }
</script>

<style lang="scss" scoped>
    .house-img{
        width: 100%;
    }

</style>


