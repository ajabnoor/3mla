@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>إضافة دولة جديدة</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 

            {!! Form::open(['action' => 'Admin\CountryController@store']) !!}
            {!! Form::bsText('name', 'إسم الدولة') !!}
                {!! Form::bsSubmit('إضافة') !!}
            {!! Form::close() !!}
    
        
@endsection