

@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>الدول</h2>
    </div>
    <div class="col-md-auto">
      <a href="{{ route('admin.user.create') }}" class="btn btn-secondary btn-sm" role="button">إضافة عضو جديدة</a>
    </div>
    
  </div>


          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>العضو</th>
                  <th>البريد</th>
                  <th>التنشيط</th>
                  <th>الأوسمة</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)

                <tr>
                <td class="align-middle">{{$user->name}}</td>
                  <td class="align-middle">{{$user->email}}</td>
                <td class="align-middle">
                  @if ($user->confirmed == 0)
                  غير نشط
                    @elseif ($user->confirmed == 1)
                  نشط
                    @endif
                </td>
                <td>
                    @foreach($badges as $badge)
                      @if ($user->badges->contains($badge))
                      <a href="{{route('admin.removebadge', [$user->id, $badge->id]) }}" class="badge badge-{{$badge->class}}">{{$badge->name}}</a>
                      @else
                      <a href="{{route('admin.addbadge', [$user->id, $badge->id]) }}" class="badge badge-inactive">{{$badge->name}}</a>
                      @endif
                    @endforeach
                </td>
                  <td class="align-middle">
                      {{-- <button class="btn btn-warning btn-sm" style="margin-bottom:1rem">تعديل</button> --}}
                      <a class="btn btn-warning btn-sm" href="{{route('admin.user.edit', $user->id) }}" role="button" style="float: left">تعديل</a>
                    </td>  
                      <td class="align-middle">
                      {!! BootForm::open(['action' => ['Admin\UserController@destroy', $user->id]]) !!}
                      {!! BootForm::hidden('_method', 'DELETE') !!}
                      {!! Form::submit('حذف', ['class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("هل أنت متأكد من حذف العضو؟")']) !!}
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