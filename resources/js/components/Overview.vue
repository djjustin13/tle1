<template>
    <div>
        <p>Overview</p>
        {{ answers }}
        <br>
        <a @click="reset()" href="#">Clear storage & restart</a>
        <br>
        <button @click="$router.push('challengecar')" class="btn btn-dark">Car Challenge!</button>
        <br>
        <button @click="$router.push('challengemeat')" class="btn btn-dark">Meat Challenge!</button>
        <br>
        <button @click="$router.push('challengeshower')" class="btn btn-dark">Shower Challenge!</button>
        <br>
        <button @click="$router.push('challengesmoking')" class="btn btn-dark">Smoking Challenge!</button>


        <!--<a href="/challengecar" class="btn btn-light ">Car Challenge!</a>-->
        <!--<a href="/challengemeat" class="btn ">Meat Challenge!</a>-->
        <!--<a href="/challengeshower" class="btn ">Shower Challenge!</a>-->
        <!--<a href="/challengesmoking" class="btn ">Smoking Challenge!</a>-->

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
            parseJson:function() {
                let data = localStorage.getItem('answers');
                if (data){
                    let object = JSON.parse(data);
                    this.answers = object;
                }
            }
        },
        mounted: function() {
            this.parseJson();
            this.sendData();
        }
    }
</script>
