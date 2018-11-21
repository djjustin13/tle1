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
        <select  class="custom-select custom-select-sm question-select"  v-model="carType">
            <option value="benzin_car">Benzine</option>
            <option value="diesel_car">Diesel</option>
            <option value="electric_car">Elektrisch</option>
            <option value="hybrid_car">Hybride</option>
        </select>
        <input type="number" min="0" max="10000" v-model="km">
        <button @click="sendData()">Stuur</button>
    </div>
</template>

<script>
    export default {
        name: 'test-component',
        data(){
            return{
                name: "henk",
                carType:null,
                km: null,
                data: null,
            }
        },methods:{
            sendData:function(){
                axios.post('api/compare/'+ this.carType, {
                    input: this.km,

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
