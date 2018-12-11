<template>
    <div>
        <div class="questions slider">
            <homepage v-on:save="save($event)"></homepage>
            <question-one v-on:save="save($event)"></question-one>
            <question-two v-on:save="save($event)"></question-two>
            <question-three v-on:save="save($event)"></question-three>
            <question-four v-on:save="save($event)"></question-four>
        </div>
    </div>
</template>

<script>
    import homepage from './questions/homepage';
    import QuestionOne from './questions/QuestionOne';
    import QuestionTwo from './questions/QuestionTwo';
    import QuestionThree from './questions/QuestionThree';
    import QuestionFour from './questions/QuestionFour';

    export default {
        name: 'question-handler',
        components: {
            homepage,
            QuestionOne,
            QuestionTwo,
            QuestionThree,
            QuestionFour
        },
        data() {
            return {
                answers: {}
            }
        }, methods: {
            save: function (event) {
                this.answers[event[0]] = event[1];
                localStorage.setItem('answers', JSON.stringify(this.answers));
            },

            sliderSetup: function () {
                $('.slider').slick({
                    lazyLoad: 'ondemand',
                    accessibility: false,
                    arrows: false,
                    draggable: false,
                    mobileFirst: true,
                });
            },

            pageChecker: function () {
                let data = localStorage.getItem('answers');
                if (data){
                    let object = JSON.parse(data);
                    this.answers = object;
                    if(this.answers.length > 3){
                        this.$router.push('overview')
                    }else{
                        $(".slider").slick('slickGoTo', Object.keys(this.answers).length)
                    }
                }
            }
        },

        mounted: function() {

            this.sliderSetup()
            this.pageChecker()

        }
    }
</script>
