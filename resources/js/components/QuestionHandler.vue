<template>
    <div class="questions slider">
        
        <question-one></question-one>
        <question-two></question-two>
    </div>
</template>

<script>
    import QuestionOne from './questions/QuestionOne';
    import QuestionTwo from './questions/QuestionTwo';

    export default {
        name: 'question-handler',
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
