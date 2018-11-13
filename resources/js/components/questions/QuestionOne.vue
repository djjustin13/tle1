<template>
    <div class="question">
        <div class="row justify-content-md-center">
            <div class="col-md-4 text-center">
                <p>Hoeveel rij je?</p>
                <button @click="nextSlide()">Next</button>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        name: 'question-one',
        methods: {
            nextSlide:function(){
                $(".slider").slick('slickNext');
            }
        },
        data(){
            return{
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

<style lang="scss" scoped>
    .question{
        background-color: #6AE5FF;
    }
</style>


