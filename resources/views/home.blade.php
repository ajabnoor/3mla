
@extends('layouts.app')

@section('title','سوق بيع وشراء العملات الرقمية والكريبتو والبيتكوين')
@section('description','موقع عملة هو سوق الكتروني آمن لبيع وشراء العملات الرقمية (الكريبتو) البيتكوين والإيثيرويم والبيتكوين كاش في العالم العربي.')

@section('content')
    {{-- <div id="pricebar">
    <prices ></prices>
    </div> --}}
    @include('inc.intro')

<div class="container" id="frontend" style="padding:0">
    <products-filter v-on:changed="filterProducts"></products-filter>
    <product :products="products"></product>
    <button type="button" v-on:click="showMore(nextpage)" class="btn btn-light  btn-block font-weight-bold text-secondary " v-if="loadmore">أعرض المزيد</button>

</div>
@endsection