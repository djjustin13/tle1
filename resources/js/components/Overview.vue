<template>
    <div>
        <p>Overview</p>
        {{ answers }}
        <br>
        <a @click="reset()" href="#">Clear storage & restart</a>
    </div>
</template>

<script>
    export default {
        name: 'question-handler',
        components:{
        },
        data(){
            return{
                answers: null,
            }
        },methods:{
            reset:function(){
                localStorage.clear();
                this.answers = null;
                this.$router.push('/')
            }
        },
        mounted: function() {
            let data = localStorage.getItem('answers');
            if (data){
                let object = JSON.parse(data);
                this.answers = object;
            }
        }
    }
</script>
