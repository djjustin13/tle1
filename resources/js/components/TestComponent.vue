<template>
    <div id="main">
        <div class="content text-center">
            <h1>Playground!</h1>
            <hr>
            <p>Data uit een variable <b>{{ name }}</b></p>
            <p>Data opgehaald van /api/test route: <b>{{ data }}</b></p>
            <hr>
            <input type="text" v-model="name">
            <br>

            Type hier iets:
            <input type="text" v-model="something">
            <p v-if="something">Vet!</p>
            <hr>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'test-component',
        methods: {
            nextSlide:function(){
                $(".slider").slick('slickNext');
            }
        },
        data(){
            return{
                name: "henk",
                something: null,
                data: null,
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
