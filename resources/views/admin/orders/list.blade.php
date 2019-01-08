

@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>قائمة الطلبات</h2>
    </div>
    {{-- <div class="col-md-auto">
      <a href="" class="btn btn-secondary btn-sm" role="button">قائمة الطلبات</a>
    </div> --}}
    
  </div>


          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                    <th>المنتج</th>
                    <th>حالة الطلب</th>
                    <th>البائع</th>
                  <th>المشتري</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)

                <tr>
                <td class="align-middle">{{$order->product->type}} {{$order->product->currency->code}}</td>

                @if ($order->status['id'] == 0)
                <td class="align-middle">جديد</td>
                @else
                <td class="align-middle">{{$order->status['name']}}</td>
                @endif

                <td class="align-middle">
                @if ($order->owner->hasrole('admin'))
                    <span class="badge badge-warning">{{$order->owner->name}}</span>
                @else
                    {{$order->owner->name}}
                @endif
                @if ($order->owner_notifications > 0)
                    <span class="badge badge-danger">{{$order->owner_notifications}}</span>
                @endif
                </td>

                  <td class="align-middle">{{$order->buyer->name}}
                      @if ($order->buyer_notifications > 0)
                          <span class="badge badge-danger">{{$order->buyer_notifications}}</span>
                      @endif
                  </td>
                <td class="align-middle">
                  <a class="btn btn-warning btn-sm disabled" href="{{route('admin.order.show', $order->id) }}" role="button" style="float: left" aria-disabled="true">دخول كإدارة</a>
                </td>

                <td class="align-middle ">
                  <a class="btn btn-info btn-sm float-left" href="{{route('admin.loginasowner', [$order->owner->id, $order->id]) }}" role="button" style="float: left">دخول كبائع</a>
                </td>
                  <td class="align-middle ">
                    <a class="btn btn-info btn-sm float-right" href="{{route('admin.loginasbuyer', [$order->buyer->id, $order->id]) }}" role="button" style="float: left">دخول كمشتري</a>
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