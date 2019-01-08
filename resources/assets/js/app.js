import Vue from 'vue';
// import { StringDecoder } from 'string_decoder';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js');

    require('rtl-bootstrap');
} catch (e) {}


                
window.Vue = require('vue');
window.VueRouter = require('vue-router');
window.VueTimeago = require('vue-timeago');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Loading = require('vue-loading-overlay');

import 'vue-loading-overlay/dist/vue-loading.min.css';

Vue.use(Loading);

Vue.component('products-filter', require('./components/products/ProductsFilter.vue'));
Vue.component('prices', require('./components//Prices.vue'));
Vue.component('product', require('./components/products/Product.vue'));
Vue.component('chat-message', require('./components/chat/ChatMessage.vue'));
Vue.component('chat-log', require('./components/chat/ChatLog.vue'));
Vue.component('chat-composer', require('./components/chat/ChatComposer.vue'));
Vue.component('status', require('./components/Status.vue'));

Vue.use(VueTimeago, {
    name: 'Timeago', // Component name, `Timeago` by default
    locale: 'ar', // Default locale
    // We use `date-fns` under the hood
    // So you can use all locales from it
    locales: {
      'ar': require('date-fns/locale/ar'),
    }
  })

if (document.getElementById("app")){
    const app = new Vue(
    {
    el: '#app',
    data: {
        cities:'',
        profit: false,
        price:'',
        percent:globalpercent
    },
    mounted(){
        this.showCities();
        this.showProfit();
    },
    methods:{
        showCities()
        {   
            var country_id = this.$refs.country.value;
            axios.get('/getCities/'+country_id).then(response=>this.cities = response.data);
        },
        showProfit()
        {
            var profit_value = this.$refs.profit.value;
            var currency_id = this.$refs.currency.value;
            var pricecurrency_id = this.$refs.price_currency.value;
            if (profit_value == 'marketwise'){
                this.profit = true;
                var self = this;

                    axios.get('/getcurrency/'+currency_id).then(function(response){
                    var currency_name = response.data.english;

                        // axios.get('https://api.coinmarketcap.com/v1/ticker/'+currency_name+'/').then(function(response){
                        // var usprice = response.data[0].price_usd;

                        axios.get('/getcryptoprice/'+currency_name).then(function(response){
                        var usprice = response.data;

                            axios.get('/getpricecurrency/'+pricecurrency_id).then(function(response){
                            var pricecurrency_rate = response.data.rate;
                            self.price = usprice*pricecurrency_rate;
                                self.price = Math.round(self.price*100)/100;
                            if (self.percent != ''){
                                self.price = self.price+(self.price*self.percent/100);
                                self.price = Math.round(self.price*100)/100;
                            }
                            });
                    });
                    });
            } else {
                this.profit = false;
                this.price = '';
            }
        }

    }
});

}
if (document.getElementById("pricebar")) {
    const fronend = new Vue({
        el: '#pricebar',
        data: {}
    });
}
if (document.getElementById("frontend")){
    const fronend = new Vue({
        el: '#frontend',
        data:{
            products:[],
            fullPage:false,
            nextpage:'',
            loadmore:false

        },
        created(){
            let loader = this.$loading.show();
                var self = this;
                axios.get('/getProducts?page='+1)
                .then(function(response)
                {
                self.products = response.data.data;
                    loader.hide()
                if (response.data.next_page_url != null){
                    self.nextpage = response.data.current_page + 1;
                    self.loadmore = true;
                }
                })
                .catch(function(error){
                    console.log(error)
                })
        },
        methods:{
            showMore(nextpage){
                let loader = this.$loading.show();
                var self = this;
                axios.get('/getProducts?page='+nextpage)
                    .then(function(response)
                    {
                        if (response.data.next_page_url != null){
                            self.nextpage = response.data.current_page + 1;
                        } else {
                            self.loadmore = false;
                        }
                        self.products = self.products.concat(response.data.data)
                        loader.hide()
                    })
            },
            filterProducts(value){
                var self = this;
                axios.post('/getProducts', value)
                .then(function(response)
                {
                    self.products = response.data.data;
                })
                .catch(function(error){
                    console.log(error)
                })
            },
        },
    });
}


if (document.getElementById("chat")){
    
    const chat = new Vue({
    el: '#chat',
    props:['productid'],
    data:{
        messages:[],
        orderid:null,
        owner:'',
        amount:null,
        show:true,
        textshow:false,
        button: 'أدخل',
        total:'',
        amounterror:'',
        // statuses:[],
        // currentstatus:'',
        statuskey:0,
        fullPage: false

        },
    created(){

            var self = this;
            
            //get messages
            if (saleorderid != null){
                axios.get('/getordermessages/'+saleorderid)
            .then(function(response)
            {
            self.messages = response.data.messages;
            self.orderid = response.data.order_id;
            self.owner = response.data.owner;
            })
            .catch(function(error){
                console.log(error)
            })
            } else {
            axios.get('/getmessages/'+productid+'/'+newOrder)
            .then(function(response)
            {
            self.messages = response.data.messages;
            self.orderid = response.data.order_id;
            self.owner = response.data.owner;
            })
            .catch(function(error){
                console.log(error)
            })
            }

            //pusher
            Echo.join('chatroom')
            .listen('MessagePosted', (e)=>{
                if (e.message.order_id == self.orderid){
                    self.messages.push({
                        message:e.message.message,
                        user: e.user,
                        date: e.message.date,
                        user_type: e.message.user_type,
                        order_id: e.message.order_id,
                    })
                }
                
                this.scrollToBottom(750)
            })
            
    },
    mounted(){
        this.scrollToBottom(1200)

        setTimeout(() => {
        this.getAmount(this)   
        }, 1200);

        // setTimeout(() => {
        //     this.getStatus(self)   
        //     }, 1200);
        


    },
    methods:{

        addMessage(message){
            // console.log(message)
            axios.post('/message', message).then(function(response)
            {
            })
            this.scrollToBottom(1000)
        },
        scrollToBottom(delay){
            setTimeout(()=>{
            var container = this.$el.querySelector(".chat-log");
            container.scrollTop = container.scrollHeight;
            },delay);
        },
        addAmount(){
            var self = this;
            if(this.isNumeric(this.amount)){
                console.log(this.amount)
            axios.post('/addamount', {'amount': this.amount,'order_id':this.orderid})
            .then(function(response){
                self.total = response.data;
            });
            this.show = false;
            this.textshow = true;
            this.button = 'تعديل';
            this.addMessage({
                date: new Date(), 
                message: 'تم تحديد الكمية المطلوبة', 
                orderid: this.orderid, 
                product_id: productid
            })
            }
            else{
                alert('الرجاء إدخال أرقام فقط')
            }
        },
        editAmount(){
            this.show = true;
            this.textshow = false;
        },
        getAmount(self){
            if(this.owner && newOrder){
                return
            }else{
                axios.get('/getamount/'+this.orderid).then(function(response)
            {
                if (response.data.amount > 0){
                self.amount = response.data.amount;
                self.total = response.data.total;
                self.show = false;
                self.textshow = true;
                self.button = 'تعديل';
                }
            });
            }
            
        },
        isNumeric(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
          },
      
        addKey(e){
            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.statusContainer
                });
            this.statuskey++;
            this.addMessage(e)
            setTimeout(() => {loader.hide()}, 1500);
        }

    },
});
}