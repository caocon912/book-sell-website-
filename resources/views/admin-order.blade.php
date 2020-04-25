@extends('layouts.cms_app')
@section('content')
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Đơn hàng</h3>
        <!-- row -->
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <td><h4><i class="fa fa-angle-right"></i>Danh mục đơn hàng</h4></td>
                    <td><a href="{{route('add-order')}}" style="color:white;"><button class="btn btn-primary">Thêm</button></a></td>
                  </tr>
                  <hr>
                  <tr>
                    <th><i class="fa fa-bullhorn"></i> ID</th>
                    <th class="hidden-phone">Thời gian</th>
                    <th class="hidden-phone">Địa chỉ</th>
                    <th> Tổng tiền</th>
                    <th> Status</th>
                    <th class="hidden-phone"> Ghi chú</th>
                    <th><i class=" fa fa-edit"></i>Hành động</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
              @if ($orders != null && !empty($orders))
                @foreach ($orders as $order)
                  <tr>
                    <td>
                      <a href="">{{$order->ID}}</a>
                    </td>
                    <td class="hidden-phone">{{$order->CREATE_AT}}</td>
                    <td>{{$order->ADDRESS_1}}</td>
                    <td><span class="label label-warning label-mini">{{$order->TOTAL}}</span></td>
                    <td>{{$order->STATUS}}</td>
                    <td></td>
                    <td>
                      <a href="{{route('detail-order',['order_id'=>$order->ID,'popup'=>0])}}" ><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                      {{-- <a href="{{route('edit-order',['order_id'=>$order->ID])}}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a> --}}
                      <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" id="delete_order" class='delete_order'><i class="fa fa-trash-o "></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-md-12 -->
        </div>
        <!-- /row -->
        <!-- deleteModal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xoá sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="editModalBody">
                <p>Bạn có chắc muốn đơn hàng này xóa?</p>
              </div> <!-- modal-body-->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <a href="{{route('delete-order',['order_id'=>$order->ID])}}"><button type="button" class="btn btn-primary">Xóa</button></a>
              </div> <!-- modal-footer-->
            </div> <!-- modal-content -->
          </div> <!-- modal-dialog -->
        </div>
        @endforeach
        @else
                
        @endif
      </section>
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
@endsection
