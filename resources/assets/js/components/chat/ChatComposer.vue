<template>
    <div class="input-group mb-3 chat-composer">
        <input type="text" class="form-control" placeholder="أكتب رسالتك هنا..." v-model="messageText" @keyup.enter="sendMessage" :disabled="(owner && neworder) ? true : false">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" @click="sendMessage" :disabled="(owner && neworder) ? true : false">أرسل</button>
        </div>
    </div>
</template>
<script>
export default {
    props:['orderid','owner'],
    data(){
        return{
            messageText:'',
            neworder:newOrder
        }
    },
    created(){
        
    },
    mounted(){
        // this.newOrder = newOrder;
        console.log()
    },
    methods:{
        sendMessage(){
            // var url =  window.location.pathname;
            // var product_id = url.substring(url.lastIndexOf('/') + 1);

            this.$emit('messagesent', {
                date: new Date(),
                message: this.messageText,
                orderid: this.orderid,
                product_id:productid
                
            });
            this.messageText = '';



        },

        
        
    
    }

    
}
</script>
<style lang="css">
    .chat-composer button{
        margin-top: 0px;  
        margin-right: 5px;
    }
</style>
