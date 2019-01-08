

@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>المنتجات</h2>
    </div>
    <div class="col-md-auto">
      <a href="{{ route('admin.product.create') }}" class="btn btn-secondary btn-sm" role="button">إضافة منتج جديدة</a>
    </div>
    
  </div>


          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>العضو</th>
                  <th>النوع</th>
                  <th>العملة</th>
                  <th>السعر</th>
                  <th>العملة النقدية</th>
                  <th>البلد</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $index => $product)

                <tr>
                  <td class="align-middle">{{ $index +1 }}</td>
                  <td class="align-middle">{{$product->user->name}}</td>
                  <td class="align-middle">{{$product->type}}</td>
                  <td class="align-middle">{{$product->currency->code}}</td>
                  <td class="align-middle">
                    @if ($product->price_type == 'marketwise')
                    حسب سعر السوق
                    @else
                    {{$product->price}}
                    @endif
                  </td>
                <td>{{$product->price_currency->name}}</td>
                  <td class="align-middle">{{$product->country->name}}</td>
                  <td class="align-middle">
                    @if ($product->status == 'pending')
                    <a class="btn btn-success btn-sm" href="{{route('admin.publish', $product->id) }}" role="button" style="float: left">نشر</a>
                    @endif
                  </td>
                  <td class="align-middle">
                      {{-- <button class="btn btn-warning btn-sm" style="margin-bottom:1rem">تعديل</button> --}}
                      <a class="btn btn-warning btn-sm" href="{{route('admin.product.edit', $product->id) }}" role="button" style="float: left">تعديل</a>
                    </td>  
                      <td class="align-middle">
                      {!! BootForm::open(['action' => ['Admin\ProductController@destroy', $product->id]]) !!}
                      {!! BootForm::hidden('_method', 'DELETE') !!}
                      {!! Form::submit('حذف', ['class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("هل أنت متأكد من حذف المنتج؟")']) !!}
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