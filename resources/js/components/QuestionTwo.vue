<template>
    <div class="question q2">
        <div class="row justify-content-md-center">
            <div class="col-md-4 text-center">
                <p>Question 2</p>
                <button @click="nextSlide()">Next</button>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        name: 'question-two',
        methods: {
            nextSlide:function(){
                $(".slider").slick('slickNext');
            }
        }
    }
</script>
