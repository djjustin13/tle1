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
        <input type="text" v-model="something">
        <button @click="sendData()">Stuur {{something}}</button>
    </div>
</template>

<script>
    export default {
        name: 'test-component',
        methods: {
            
        },
        data(){
            return{
                name: "henk",
                something: null,
                data: null,
            }
        },methods:{
            sendData:function(){
                axios.post('api/calculate', {
                    data: this.something
                }).then((response)  =>  {
                    console.log(response.data)
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
