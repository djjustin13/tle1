<template>
    <div class="content text-center">
        <h1>Playground!</h1>
        <hr>
        <p>Data uit een variable <b>{{ name }}</b></p>
        <p>Data opgehaald van /api/test route: <b>{{ data }}</b></p>
        <hr>
        <input type="text" v-model="name">
        <br>
        <hr>
        <input class="form-control" type="number" v-model="cigaretteAmount">
        <button @click="sendData()">Stuur</button>
    </div>
</template>

<script>
    export default {
        name: 'test-component',
        data(){
            return{
                name: "henk",
                cigaretteAmount: null,
                data: null,
            }
        },methods:{
            sendData:function(){
                axios.post('api/compare/smoking', {
                    input: this.cigaretteAmount,

                }).then((response)  =>  {
                    console.log(response)
                })
            }
        },
        mounted: function(){
            axios.get("/api/data")
                .then((response)  =>  {
                    this.data = response.data;
                    console.log(this.data)
            })
        }
    }
</script>
