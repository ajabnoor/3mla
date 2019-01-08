@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>إضافة مدينة جديدة</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>


            {!! Form::open(['action' => 'Admin\CityController@store']) !!}
            {!! Form::bsSelect('country','اختر الدولة', $countries ) !!}
            {!! Form::bsText('name', 'إسم المدينة') !!}
                {!! Form::bsSubmit('إضافة') !!}
            {!! Form::close() !!}
    
        
@endsection