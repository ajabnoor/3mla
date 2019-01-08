

@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>الأوسمة</h2>
    </div>
    <div class="col-md-auto">
      <a href="{{ route('admin.badge.create') }}" class="btn btn-secondary btn-sm" role="button">إضافة وسم جديد</a>
    </div>
    
  </div>


          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>الوسم</th>
                  <th>الوصف</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($badges as $badge)

                <tr>
                <td class="align-middle">
                    <span class="badge badge-{{$badge->class}}">{{$badge->name}}</span>
                  </td>
                  <td class="align-middle">{{$badge->description}}</td>
                <td></td>
                  <td class="align-middle">
                      {{-- <button class="btn btn-warning btn-sm" style="margin-bottom:1rem">تعديل</button> --}}
                      <a class="btn btn-warning btn-sm" href="{{route('admin.badge.edit', $badge->id) }}" role="button" style="float: left">تعديل</a>
                    </td>  
                      <td class="align-middle">
                      {!! BootForm::open(['action' => ['Admin\BadgeController@destroy', $badge->id]]) !!}
                      {!! BootForm::hidden('_method', 'DELETE') !!}
                      {!! Form::submit('حذف', ['class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("هل أنت متأكد من حذف الوسم")']) !!}
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