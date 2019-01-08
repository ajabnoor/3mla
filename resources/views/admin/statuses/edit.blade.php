@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>تعديل العملة</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 
{!! Form::model($status, [
  'route' => ['admin.status.update', $status->id],
]) !!}
{!! Form::bsText('order', 'الترتيب') !!}
{!! Form::bsText('name', 'إسم الحالة') !!}
{!! Form::bsText('question', 'سؤال الحالة') !!}
{!! Form::bsSelect('user_type','صاحب الحالة', ['buyer'=>'المشتري', 'owner'=>'البائع'] ) !!}
{!! Form::hidden('_method', 'PUT') !!}
{!! Form::bsSubmit('تعديل') !!}
{!! Form::close() !!}

    
    

@endsection