@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>إضافة حالة طلب جديدة</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 

            {!! Form::open(['action' => 'Admin\StatusController@store', 'enctype'=>'multipart/form-data']) !!}
            {!! Form::bsText('order', 'الترتيب') !!}
            {!! Form::bsText('name', 'إسم الحالة') !!}
            {!! Form::bsText('question', 'سؤال الحالة') !!}
            {!! Form::bsSelect('user_type','صاحب الحالة', ['buyer'=>'المشتري', 'owner'=>'المالك'] ) !!}
            {!! Form::bsSubmit('إضافة') !!}
            {!! Form::close() !!}
    
        
@endsection