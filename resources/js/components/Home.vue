<template>
    <div class="questions slider">
        
        <question-one></question-one>
        <question-two></question-two>
    </div>
</template>

<script>
    import QuestionOne from './QuestionOne';
    import QuestionTwo from './QuestionTwo';

    export default {
        name: 'home',
        components:{
            QuestionOne,
            QuestionTwo
        },
        mounted: function() {
            $('.slider').slick({
                accessibility: false,
                arrows: false,
                draggable: false,
                mobileFirst: true,
            });
        }
    }
</script>
