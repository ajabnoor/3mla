<template>
<div  class="card-body border-bottom2 bg-light chat-log">

    <chat-message v-for="message in messages" :key="message.id" :message="message"></chat-message>
   
</div>
</template>

<script>
export default {
    props:['messages'],
    created(){
    },
    
    
}
</script>
<style lang="css">
.chat-log{
    overflow-y:scroll;
    height:440px;
    padding-top:5px;
}
</style>

