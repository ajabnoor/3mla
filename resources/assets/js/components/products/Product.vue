<template>

        <div class="row">
            <div class="col-md-4 col-sm-6" v-for="product in products" v-bind:key="product.id">

                <div class="card mb-4 box-shadow card-red" v-if="product.type === 'sell'">
                    <li class="list-group-item d-flex align-items-center list-top">
                        <span  v-for="badge in product.user.badges" v-bind:key="badge.id" style="margin-left:5px" :class="['badge badge-'+badge.class]">{{badge.name}}</span>
                    </li>
                   
                    <img class="card-img-top-sm" :src="product.currency.logo" :alt="product.currency.name">
                    <div class="card-body2 padding-top-zero">
                        <h5 class="card-title sell-red">{{product.currency.name}} للبيع بسعر</h5>
                        <div class="card-title pricing-card-title title-center">{{product.price}} {{product.price_currency.name}}<small class="text-muted">/ {{product.currency.code}}</small></div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">اسم العضو<span class="badge badge-order-red">{{product.user.name}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">المكان<span class="badge badge-order-red">{{product.country.name}} - {{product.city.name}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">عمليات سابقة<span class="badge badge-order-red">{{product.user.finished_orders.length}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">سرعة التحويل<span class="badge badge-order-red">{{product.speed}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">طرق التحويل<span class="badge badge-order-red">{{product.transfer_methods}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المتوفرة<span class="badge badge-order-red">{{product.available}} {{product.currency.code}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">أقل كمية للبيع<span class="badge badge-order-red">{{product.min_amount}}</span></li>
                    </ul>
                    <a :href="'user/neworder/'+product.id" class="card-body2 btn btn-order-red" style="margin-top:0px">اطلب الأن</a>
                </div>

                <div class="card mb-4 box-shadow card-green" v-else>
                    <li class="list-group-item d-flex align-items-center list-top">
                        <span  v-for="badge in product.user.badges" v-bind:key="badge.id" style="margin-left:5px" :class="['badge badge-'+badge.class]">{{badge.name}}</span>
                    </li>

                    <img class="card-img-top-sm" :src="product.currency.logo" :alt="product.currency.name">
                    <div class="card-body2 padding-top-zero">
                        <h5 class="card-title sell-green">طلب {{product.currency.name}} بسعر</h5>
                        <div class="card-title pricing-card-title title-center">{{product.price}} {{product.price_currency.name}}<small class="text-muted">/ {{product.currency.code}}</small></div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">اسم العضو<span class="badge badge-order-green">{{product.user.name}}</span></li> 
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">المكان<span class="badge badge-order-green">{{product.country.name}} - {{product.city.name}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">عمليات سابقة<span class="badge badge-order-green">{{product.user.finished_orders.length}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">سرعة التحويل<span class="badge badge-order-green">{{product.speed}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">طرق التحويل<span class="badge badge-order-green">{{product.transfer_methods}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المتوفرة<span class="badge badge-order-green">{{product.available}} {{product.currency.code}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">أقل كمية للشراء<span class="badge badge-order-green">{{product.min_amount}}</span></li>
                    </ul>
                    <a :href="'user/neworder/'+product.id" class="card-body2 btn btn-order-green" style="margin-top:0px">اطلب الأن</a>
                </div>
            </div>
        </div>


</template>

<script>
    export default {
        props: ['products'],
        data(){
            return{

            }
        },
        created(){
        },
        methods: {

            
        }
    }
</script>
