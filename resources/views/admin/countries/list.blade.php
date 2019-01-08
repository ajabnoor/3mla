

@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>الدول</h2>
    </div>
    <div class="col-md-auto">
      <a href="{{ route('admin.country.create') }}" class="btn btn-secondary btn-sm" role="button">إضافة دولة جديدة</a>
    </div>
    
  </div>


          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>الدولة</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($countries as $country)

                <tr>
                <td class="align-middle">{{$country->name}}</td>
                  <td class="align-middle"></td>
                <td></td>
                  <td class="align-middle">
                      {{-- <button class="btn btn-warning btn-sm" style="margin-bottom:1rem">تعديل</button> --}}
                      <a class="btn btn-warning btn-sm" href="{{route('admin.country.edit', $country->id) }}" role="button" style="float: left">تعديل</a>
                    </td>  
                      <td class="align-middle">
                      {!! BootForm::open(['action' => ['Admin\CountryController@destroy', $country->id]]) !!}
                      {!! BootForm::hidden('_method', 'DELETE') !!}
                      {!! Form::submit('حذف', ['class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("هل أنت متأكد من حذف العملة؟")']) !!}
                      {!! BootForm::close() !!}
                  
                    </td>
                </tr>
                @endforeach
               
                
              </tbody>
            </table>
          </div>


  <style>
  
  .form-group {
    margin-bottom: 0rem;
}</style>

          @endsection