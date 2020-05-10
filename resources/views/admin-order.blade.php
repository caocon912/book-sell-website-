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
        @if(Session::has('success-message'))
          <div class="alert alert-success"> 
              <button type="button" 
                  class="close" 
                  data-dismiss="alert" 
                  aria-hidden="true">&times;</button>
              {{ session()->get('success-message') }} 
          </div>
        @endif
        @if(Session::has('error-message'))
          <div class="alert alert-danger"> 
              <button type="button" 
                  class="close" 
                  data-dismiss="alert" 
                  aria-hidden="true">&times;</button>
              {{ session()->get('error-message') }} 
          </div>
        @endif
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <td colspan="2"><h4><i class="fa fa-angle-right"></i>Danh mục đơn hàng</h4></td>
                    <td><a href="{{route('add-order')}}" style="color:white;"><button class="btn btn-primary">Thêm</button></a></td>
                  </tr>
                  <hr>
                  <tr>
                    <th><i class="fa fa-bullhorn"></i> ID</th>
                    <th><i class="fa fa-bullhorn"></i> SDT</th>
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
                      <a href="{{route('detail-order',['order_id'=>$order->ID,'popup'=>0])}}">{{$order->ID}}</a>
                    </td>
                    <td class="hidden-phone">{{$order->PHONE_NUMBER}}</td>
                    <td class="hidden-phone">{{$order->CREATE_AT}}</td>
                    <td>{{$order->ADDRESS_1}}</td>
                    <td><span class="label label-warning label-mini">{{$order->TOTAL}}</span></td>
                    <td>{{$order->STATUS}}</td>
                    <td></td>
                    <td>
                      {{-- <a href="{{route('detail-order',['order_id'=>$order->ID,'popup'=>0])}}" ><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a> --}}
                      <a href="{{route('detail-order',['order_id'=>$order->ID,'popup'=>0])}}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                    <button class="btn btn-danger btn-xs" data-id='{{$order->ID}}' data-toggle="modal" data-target="#deleteModal" id="delete_order" class='delete_order'><i class="fa fa-trash-o "></i></button>
                    </td>
                  </tr>
              @endforeach
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
                <a href="#" id="delete_order_href"><button type="button" class="btn btn-primary">Xóa</button></a>
              </div> <!-- modal-footer-->
            </div> <!-- modal-content -->
          </div> <!-- modal-dialog -->
        </div>
      </tbody>
    </table>
  </div>
  <!-- /content-panel -->
</div>
<!-- /col-md-12 -->
</div>
<!-- /row -->
        @else
                
        @endif
      </section>
      {{$orders->links()}}
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <script>
      $('#deleteModal').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget) 
        var id = button.data('id')
        var modal = $(this)
        var url = '{{ route("delete-order", [":order_id"]) }}';
        url = url.replace(':order_id', id);
        modal.find('.modal-footer #delete_order_href').attr("href", url);
      })
    </script>
@endsection
