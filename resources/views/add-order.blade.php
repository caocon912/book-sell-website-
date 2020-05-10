@extends('layouts.cms_app')
@section ('content')
<section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Đơn hàng</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Thêm đơn hàng</h4>
              <form class="form-horizontal style-form" method="post" action={{route('add-order-submit')}} >
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Người đặt hàng* </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="customer_name">
                    </div>
                    @error ('customer_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Username </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username">
                    </div>
                    @error ('username')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Số điện thoại* </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone">
                    </div>
                    @error ('phone')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Email* </label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email">
                    </div>
                    @error ('email')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group ">
                    <label for="address_1" class="control-label col-lg-2">Địa chỉ nhà*</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="address_1">
                    </div>
                    @error ('address_1')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Địa chỉ cty</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address_2">
                    </div>
                    @error ('address_2')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Danh mục</label>
                    <div class="col-sm-10">
                        <select id="categories" name="categories" onchange="loadProductByCategoryId();">
                            @foreach($categories as $category)
                                <option value="{{$category->ID}}">{{$category->NAME}}</option>
                            @endforeach
                        </select> 
                    </div>
                    @error ('categories')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Sản phẩm</label>
                    <div class="col-sm-10">
                          <select name="product" id="product">
                            {{-- load ajax by category id here --}}
                          </select> 
                          <button type="button" name="add_product_btn" id="add_product_btn" onclick="addProductIntoOrder();">Thêm</button> 
                    </div>
                    @error ('product')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
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
                          <tbody id="product_table" name="product_table">   
                          </tbody>
                        </table>
                    </div> <!-- col-md-12-->
                </div>

                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Submit</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
          <!-- col-lg-12-->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
@endsection