@extends('layouts.cms_app')
@section('content')
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Chi tiết đơn hàng</h3>
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
                  <hr>
                  <tr>
                    <th style="width:50px"> ID order</th>
                    <th>Tên khách hàng </th>
                    <th>Username</th>
                    <th>Địa chỉ nhà</th>
                    <th>Địa chỉ công ty</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Sản phẩm</th>
                    <th>Tổng tiền</th>
                    <th>Hành động</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    {{-- <td><input id="order_id" value="{{$order_detail->ID_ORDER}}" readonly style="width:50px"></td> --}}
                    <td>{{$order_detail->ID_ORDER}}</td>
                    <td>{{$order_detail->CUSTOMER_NAME}}</td>
                    <td>{{$order_detail->USERNAME}}</td>
                    <td>{{$order_detail->ADDRESS_1}}</td>
                    <td>{{$order_detail->ADDRESS_2}}</td>
                    <td>{{$order_detail->PHONE_NUMBER}}</td>
                    <td>{{$order_detail->EMAIL}}</td>
                    <td>
                      @foreach($order_items as $item)
                        <li>{{$item->NAME}}-{{$item->PRICE}}-{{$item->QUANLITY}}</li>
                      @endforeach
                    </td>
                    <td class="hidden-phone">{{$order_detail->TOTAL}}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="edit_order_detail">
                            <i class="fa fa-pencil"></i>
                        </button>    
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
      </section>
    {{-- popup edit --}}
    <!-- Modal -->
  <form class="form-horizontal style-form" method="post" action={{route('submit-edit-order-detail',['order_id'=>$order_detail->ID_ORDER])}}>
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông tin đơn hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div>
                    @endif
                    <div class="form-group ">
                      <label for="customer_name" class="control-label col-lg-2">Tên khách hàng</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control " id="customer_name" name="customer_name" value="{{$order_detail->CUSTOMER_NAME}}">
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="username" class="control-label col-lg-2">Username</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control " id="username" name="username" value="{{$order_detail->USERNAME}}" readonly>
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="address_1" class="control-label col-lg-2">Địa chỉ nhà</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="address_1" name="address_1" value="{{$order_detail->ADDRESS_1}}">
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="address_2" class="control-label col-lg-2">Địa chỉ công ty</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="address_2" name="address_2" value="{{$order_detail->ADDRESS_2}}">
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="phone_number" class="control-label col-lg-2">Điện thoại</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="phone_number" name="phone_number" value="{{$order_detail->PHONE_NUMBER}}">
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">Email</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="email" name="email" value="{{$order_detail->EMAIL}}">
                      </div>
                    </div>

                    <div class="form-group ">
                      <button class="primary-btn up-cart" onclick="getListItemId('update-order-item');" type="button">Update cart</button>
                      <select id="categories" name="categories" onchange="loadProductByCategoryId();">
                        @foreach($categories as $category)
                            <option value="{{$category->ID}}">{{$category->NAME}}</option>
                        @endforeach
                      </select>
                      <select name="product" id="product">
                        {{-- load ajax by category id here --}}
                      </select> 
                      <button type="button" name="add_product_btn" id="add_product_btn" onclick="addProductIntoOrder();">Thêm</button>  
                      <div class="col-md-12">
                            <table class="cart-table" id="cart-table"> 
                              <thead>
                                <tr>
                                  <th style="width:80px">Image</th>
                                  <th class="p-name" style="width:120px">Product Name</th>
                                  <th style="width:80px">Price</th>
                                  <th style="width:80px">Quantity</th>
                                  <th style="width:80px">Total</th>
                                  <th style="width:80px">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if ($order_items != null&&count($order_items)!=0)
                                  
                                  @foreach($order_items as $item)
                                        
                                    <input type="hidden" value = "{{$item->ID}}" name="id_item">
                                    <tr>
                                      <td class="cart-pic"><img src="{{asset('app-assets/img/products/doremon-shirt.jpg')}}" alt="" style="width:50px;height:50px"></td>
                                      <td class="cart-title"><h5>{{$item->NAME}}</h5></td>
                                      <td class="p-price">{{$item->PRICE}}</td>
                                      <td class="qua-col">
                                        <div class="quantity">
                                          <div class="pro-qty">
                                            <input type="number" min="1" value="{{$item->QUANLITY}}" name="quanlity" style="width:50px">
                                          </div>
                                        </div>
                                      </td>
                                      <td class="total-price">{{$item->QUANLITY * $item->PRICE}}</td>
                                    <td class="close-td"><a href="{{route('delete-order-item',['order_id'=>$order_detail->ID_ORDER,'order_item_id'=>$item->ID])}}">Xoá</a></td>
                                    </tr>
                                  @endforeach
                                @else
                                  <tr><td colspan="6">You have no items in cart.</td></tr>
                                @endif
                              </tbody>
                            </table>
                        </div> <!-- col-md-12-->
                    </div>

          </div> <!-- modal-body-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button></a>
          </div> <!-- modal-footer-->
        </div> <!-- modal-content -->
      </div> <!-- modal-dialog -->
    </div>
  </form>
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <script>
      $('#myModal').on('shown.bs.modal', function () {
          $('#myInput').trigger('focus')
      })
  </script>
  @if($popup==1)
    <script>
      window.onload = function(){
        document.getElementById('edit_order_detail').click();
      }
    </script>
  @endif
@endsection
