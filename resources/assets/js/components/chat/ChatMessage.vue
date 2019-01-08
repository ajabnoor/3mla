<template>
    <div class="row justify-content-end" v-if="message.user_type === 'owner'">
        <div class="col-8">
            <small class="text-muted"><timeago :datetime="message.date" :auto-update="60"></timeago></small>
            <div class="alert alert-primary mb-0"><strong>{{message.user.name}}: </strong>{{message.message}}</div> 
        </div>
    </div>
    <div class="row justify-content-start" v-else-if="message.user_type === 'buyer'">
        <div class="col-8">
            <small class="text-muted"><timeago :datetime="message.date" :auto-update="60"></timeago></small>
            <div class="alert alert-success mb-0"><strong>{{message.user.name}}: </strong>{{message.message}}</div> 
        </div>
    </div>
    <div class="row justify-content-center" v-else-if="message.user_type === 'admin'">
        <div class="col-8">
            <!-- <small class="text-muted"><timeago :datetime="message.date" :auto-update="60"></timeago></small> -->
            <div class="alert alert-danger mb-0"><strong>إدارة موقع عملة: </strong>{{message.message}}</div> 
        </div>
    </div>
</template>

<script>
export default {
            props: ['message'],
            created(){

            }
}
</script>
