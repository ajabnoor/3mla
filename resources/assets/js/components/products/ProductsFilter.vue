<template>
    <nav aria-label="breadcrumb">
        
        <ol class="breadcrumb ">
            <li style="margin-top:10px">فلاتر البحث:</li>
            <li style="width:10px"></li>
            <li>
            <select class="form-control" v-model="search.type" @change="filterProducts">
                <option  value="0">نوع الطلب</option>
                <option value="sell">بيع</option>
                <option value="buy">شراء</option>
            </select>

            </li>

            <li style="width:10px"></li>
            <li>
                <select class="form-control" v-model="search.country" @change="filterProducts">
                <option value="0">الدولة</option>
                <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                </select>
            </li>


<li style="width:10px"></li>
<li >
    <select class="form-control"  v-model="search.currency" @change="filterProducts">
<option  value="0">العملة</option>
                <option v-for="currency in currencies" :key="currency.id" :value="currency.id">{{ currency.name }}</option>
</select></li>
  </ol>
</nav>

</template>
<script>
    export default {
        data(){
            return{
                countries:[],
                currencies:[],
                search:{
                    country:'0',
                    type:'0',
                    currency:'0'
                },
                selected:''

            }
        },
        created() 
        {   
            var self = this;
            axios.get('/getFilters')
            .then(function(response)
            {
            self.countries = response.data.countries;
            self.currencies = response.data.currencies;
            })
            .catch(function(error){
                console.log(error)
            })
        },
        methods: {
            filterProducts(e){
                console.log(this.search)
                this.$emit('changed', this.search)
            }
        }
    }
</script>