

@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>المدن</h2>
    </div>
    <div class="col-md-auto">
      <a href="{{ route('admin.city.create') }}" class="btn btn-secondary btn-sm" role="button">إضافة مدينة جديدة</a>
    </div>
    
  </div>


          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>المدينة</th>
                  <th>الدولة</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($cities as $city)

                <tr>
                <td class="align-middle">{{$city->name}}</td>
                  <td class="align-middle">{{$city->country->name}}</td>
                <td></td>
                  <td class="align-middle">
                      {{-- <button class="btn btn-warning btn-sm" style="margin-bottom:1rem">تعديل</button> --}}
                      <a class="btn btn-warning btn-sm" href="{{route('admin.city.edit', $city->id) }}" role="button" style="float: left">تعديل</a>
                    </td>  
                      <td class="align-middle">
                      {!! BootForm::open(['action' => ['Admin\CityController@destroy', $city->id]]) !!}
                      {!! BootForm::hidden('_method', 'DELETE') !!}
                      {!! Form::submit('حذف', ['class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("هل أنت متأكد من حذف المدينة؟")']) !!}
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