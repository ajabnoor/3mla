<template>

    <nav aria-label="breadcrumb" class="loading-parent" ref="statusContainer">
        <ol class="breadcrumb" style="min-height: 65px;" >
            <li style="margin-top:9px"><strong>حدد حالة الطلب</strong></li>
            <li style="width:15px" ></li>
            <li style="margin-left:3px" v-for="status in statuses" :key="status.id">
                <a href="#" data-toggle="modal" :data-target="'#status'+status.id" @click.prevent="checkUpdate(currentstatus,orderid,status)" class="btn btn-sm btn-arrow-left " :class="getClass(currentstatus,status.id,status.user_type)"  style="line-height: 1.7">{{status.name}}</a>
            
            <div class="modal fade" :id="'status'+status.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{question}}
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal" v-if="btnshow" @click.prevent="updateStatus(orderid,status)">نعم</a>
        <a href="#" class="btn btn-secondary" data-dismiss="modal" v-if="btnshow">لا</a>
        <a href="#" class="btn btn-secondary" data-dismiss="modal" v-else>أغلاق</a>
      </div>
    </div>
  </div>
</div>


            </li>
        </ol>

    </nav>
</template>
<script>
export default {
    props:['owner','orderid'],
    data(){
        return{
        gray:'btn-secondary',
        green:'btn-success',
        blue:'btn-info',
        statuses:[],
        currentstatus:'',
        statuskey:0,
        fullPage: false,
        title:'',
        question:'',
        btnshow:true
        }
       
    },
    created(){
        
        var self = this;
         setTimeout(() => {
            this.getStatus(self)   
            }, 1200);
    },

    methods:{
        getClass(currentstatus,statusid,usertype){
            if (statusid <= currentstatus && currentstatus!=0){
                return usertype == 'buyer' ? this.green : this.blue;
            } else {
                return this.gray;
            }
        },
        getStatus(self){
             let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.statusContainer
            });

              axios.get('/getstatus/'+this.orderid).then(function(response)
              {
                  self.statuses = response.data.statuses;
                  self.currentstatus = response.data.current_status;
                  loader.hide()
              });
          },
        checkUpdate(currentstatus,orderid,status){
            console.log(currentstatus,status.id)
            if ( status.id <= currentstatus){
                this.title = 'تحديث حالة الطلب';
                this.question = 'لا يمكن التراجع عن حالة طلب تم تحديدها';
                this.btnshow = false;
            }else if(status.id > currentstatus+1){
                this.title = 'تحديث حالة الطلب';
                this.question = 'لا يمكن تجاوز خطوة سابقة عند تحديد حالة جديدة للطلب';
                this.btnshow = false;
            }
            else{
            if(!this.owner && status.user_type == 'buyer'){
                this.title = 'تحديث حالة الطلب';
                this.question = status.question;
                this.btnshow = true;
            }else if(this.owner && status.user_type == 'owner'){
                this.title = 'تحديث حالة الطلب';
                this.question = status.question;
                this.btnshow = true;
            }else{
                this.title = 'تحديث حالة الطلب';
                this.question = 'ليس من صلاحياتك اختيار هذه الحالة للطلب';
                this.btnshow = false;
            }
        }
        
        },
        updateStatus(orderid,status){
            
            axios.get('/updatestatus/'+orderid+'/'+status.id).then((response)=>{})
            
            this.$emit('statuskey',{
                date: new Date(),
                message: 'لقد تم تغيير حالة الطلب إلى "' + status.name + '"',
                orderid: orderid,
                product_id:productid
                
            })   
         
        },
    }
}
</script>
<style>
.loading-parent {
  position: relative;
}
</style>

