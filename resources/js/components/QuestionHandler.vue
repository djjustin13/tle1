<template>
    <div>
        <div class="questions slider">
        <question-one v-on:save="save($event)"></question-one>
        <question-two></question-two>
        </div>
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
        data(){
            return{
                answers: []
            }
        },methods:{
            save: function(event){
                this.answers.push(event);

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
                $(".slider").slick('slickGoTo', this.answers.lengt)
            };
        }
    }
</script>
