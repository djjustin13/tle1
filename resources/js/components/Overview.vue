<template>
    <div>
        <p>Overview</p>
        {{ answers }}
        <br>
        <a @click="reset()" href="#">Clear storage</a>
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
            }
        },
        mounted: function() {
            console.log('a');
            let data = localStorage.getItem('answers');
            if (data){
                let object = JSON.parse(data);
                this.answers = object;
            }
        }
    }
</script>
