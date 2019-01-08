

@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>العملات</h2>
    </div>
    <div class="col-md-auto">
      <a href="{{ route('admin.status.create') }}" class="btn btn-secondary btn-sm" role="button">إضافة حالة طلب جديدة</a>
    </div>
    
  </div>


          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>الترتيب</th>
                  <th>إسم الحالة</th>
                  <th>صاحب الحالة</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($statuses as $status)

                <tr>
                <td class="align-middle">{{$status->order}}</td>
                <td class="align-middle">{{$status->name}}</td>
                <td class="align-middle">{{$status->user_type}}</td>
                  <td class="align-middle">
                      {{-- <button class="btn btn-warning btn-sm" style="margin-bottom:1rem">تعديل</button> --}}
                      <a class="btn btn-warning btn-sm" href="{{route('admin.status.edit', $status->id) }}" role="button" style="float: left">تعديل</a>
                    </td>  
                      <td class="align-middle">
                      {!! BootForm::open(['action' => ['Admin\StatusController@destroy', $status->id]]) !!}
                {!! BootForm::hidden('_method', 'DELETE') !!}
                {!! Form::submit('حذف', ['class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("هل أنت متأكد من حذف الحالة؟")']) !!}
            {!! BootForm::close() !!}
                  
                    </td>
                </tr>
                @endforeach
               
                
              </tbody>
            </table>
          </div>



          <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


  <style>
  
  .form-group {
    margin-bottom: 0rem;
}</style>

          @endsection