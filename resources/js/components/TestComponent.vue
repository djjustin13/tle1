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
        <select class="custom-select custom-select-sm question-select" name="meat" v-model="answer">
            <option value="1">1 dag</option>
            <option value="2">2 dagen</option>
            <option value="3">3 dagen</option>
            <option value="4">4 dagen</option>
            <option value="5">5 dagen</option>
            <option value="6">6 dagen</option>
            <option value="7">7 dagen</option>
        </select>
        <button @click="sendData()">Stuur</button>
    </div>
</template>

<script>
    export default {
        name: 'test-component',
        data(){
            return{
                name: "henk",
                answer: null,
                data: null,
            }
        },methods:{
            sendData:function(){
                axios.post('api/compare/flesheaters', {
                    input: this.answer,

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
