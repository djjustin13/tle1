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
        <input type="number" v-model="days" placeholder="Dagen">
        <input type="number" v-model="minutes" placeholder="Minuten">
        <button @click="sendData()">Stuur</button>
    </div>
</template>

<script>
    export default {
        name: 'test-component',
        data(){
            return{
                name: "henk",
                days:null,
                minutes: null,
                data: null,
            }
        },methods:{
            sendData:function(){
                axios.post('api/compare/shower', {
                    minutes: this.minutes,
                    days: this.days,

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
