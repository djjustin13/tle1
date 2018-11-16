<template>
    <div>
        <div class="questions slider">
        <question-one v-on:save="save($event)"></question-one>
        <question-two v-on:save="save($event)"></question-two>
        <question-three v-on:save="save($event)"></question-three>
        <question-four v-on:save="save($event)"></question-four>
        </div>
    </div>
    
</template>

<script>
    import QuestionOne from './questions/QuestionOne';
    import QuestionTwo from './questions/QuestionTwo';
    import QuestionThree from './questions/QuestionThree';
    import QuestionFour from './questions/QuestionFour';

    export default {
        name: 'question-handler',
        components:{
            QuestionOne,
            QuestionTwo,
            QuestionThree,
            QuestionFour
        },
        data(){
            return{
                answers: []
            }
        },methods:{
            save: function(event){
                this.answers.push({
                    question : event[0],
                    answer : event[1]
                });
                localStorage.setItem('answers', JSON.stringify(this.answers));
            }
        },
        mounted: function() {
            $('.slider').slick({
                lazyLoad: 'ondemand',
                accessibility: false,
                arrows: false,
                draggable: false,
                mobileFirst: true,
            });

            let data = localStorage.getItem('answers');
            if (data){
                let object = JSON.parse(data);
                this.answers = object;
                if(this.answers.length > 3){
                    this.$router.push('overview')
                }else{
                    $(".slider").slick('slickGoTo', this.answers.length)
                }
            };
        }
    }
</script>
