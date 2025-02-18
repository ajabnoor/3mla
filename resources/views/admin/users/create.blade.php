@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>إضافة عضو جديد</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
{{-- {!! Form::open(['action' => route('register')]) !!}
{!! Form::bsText('name', 'إسم العضو') !!}
    {!! Form::bsSubmit('إضافة') !!}
{!! Form::close() !!} --}}

<form class="form-horizontal" method="POST" action="{{ route('register') }}">
  {{ csrf_field() }}

  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <label for="name" class="col-md-4 control-label">الإسم</label>

      <div class="col-md-6">
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

          @if ($errors->has('name'))
              <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
      </div>
  </div>

  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
      <label for="email" class="col-md-4 control-label">البريد الإلكتروني</label>

      <div class="col-md-6">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
      </div>
  </div>

  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
      <label for="password" class="col-md-4 control-label">كلمة المرور</label>

      <div class="col-md-6">
          <input id="password" type="password" class="form-control" name="password" required>

          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
      </div>
  </div>

  <div class="form-group">
      <label for="password-confirm" class="col-md-4 control-label">تأكيد كلمة المرور</label>

      <div class="col-md-6">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
      </div>
  </div>

  <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
          <button type="submit" class="btn btn-primary">
              تسجيل
          </button>
      </div>
  </div>
</form>
    
        
@endsection