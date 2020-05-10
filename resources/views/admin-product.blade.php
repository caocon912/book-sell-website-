@extends('layouts.cms_app')
@section('content')
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Sản phẩm</h3>
        <!-- row -->
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <td colspan="3"><h4><i class="fa fa-angle-right"></i>Danh mục sản phẩm</h4></td>
                    <!-- Button trigger modal -->
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="add_product">
                      Thêm
                  </button></td>
                  </tr>
                  <hr>
                  <tr>
                    <th style="width:50px"> ID</th>
                    <th class="hidden-phone"> Tên</th>
                    <th class="hidden-phone"> Loại</th>
                    <th> Gía nhập</th>
                    <th> Gía bán</th>
                    <th> Số lượng</th>
                    <th class="hidden-phone"> Mô tả</th>
                    <th> Hình ảnh </th>
                    <th> Status</th>
                    <th> Hành động</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                  <tr>
                    <td>
                      <a href="#">{{$product->ID}}</a>
                    </td>
                    <td class="hidden-phone">{{$product->NAME}}</td>
                    <td>{{$product->CATEGORY_NAME}}</td>
                    <td>{{$product->OLD_PRICE}}</td>
                    <td>{{$product->NEW_PRICE}}</td>
                    <td>{{$product->AMOUNT}}</td>
                    <td>{{$product->DESCRIPTION}}</td>
                    <td><img src="uploads/{{$product->IMAGE}}" alt="{{$product->IMAGE}}" style="width:70px;height:70px"></td>
                    <td>{{$product->STATUS}}</td>
                    <td>
                      {{-- <button class="btn btn-success btn-xs" type="button"><i class="fa fa-check"></i></button> --}}
                      <a href="{{route('edit-product',['product_id'=>$product->ID])}}"><button class="btn btn-primary btn-xs" type="button"><i class="fa fa-pencil"></i></button></a>
                    <button class="btn btn-danger btn-xs" data-id="{{$product->ID}}" data-toggle="modal" data-target="#deleteModal" id="delete_product" class='delete_product'><i class="fa fa-trash-o "></i></button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-md-12 -->
        </div>
        {{$products->links()}}
        <!-- /row -->
        <!-- Modal -->
        <form class="form-horizontal style-form" method="post" action={{route('add-product-submit')}} enctype="multipart/form-data">
          @csrf
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                        <div class="form-group ">
                          <label for="category" class="control-label col-lg-2">Loại</label>
                          <div class="col-lg-10">
                            <select name="category" id="category">
                              @foreach($categories as $category)
                                <option value="{{$category->ID}}">{{$category->NAME}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                          <div class="form-group ">
                            <label for="product_name" class="control-label col-lg-2">Tên sản phẩm</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control " id="product_name" name="product_name">
                            </div>
                          </div>

                          <div class="form-group ">
                            <label for="old_price" class="control-label col-lg-2">Gía nhập</label>
                            <div class="col-lg-10">
                              <input type="number" class="form-control " id="old_price" name="old_price">
                            </div>
                          </div>

                          <div class="form-group ">
                            <label for="new_price" class="control-label col-lg-2">Gía bán</label>
                            <div class="col-lg-10">
                              <input class="form-control " id="new_price" name="new_price">
                            </div>
                          </div>

                          <div class="form-group ">
                            <label for="amount" class="control-label col-lg-2">Số lượng</label>
                            <div class="col-lg-10">
                              <input class="form-control " id="amount" name="amount">
                            </div>
                          </div>

                          <div class="form-group ">
                            <label for="description" class="control-label col-lg-2">Mô tả</label>
                            <div class="col-lg-10">
                              <textarea style="margin: 0px; width: 466px; height: 120px;" name="description"></textarea>
                            </div>
                          </div>

                          <div class="form-group ">
                            <label for="image" class="control-label col-lg-2">Upload hình ảnh</label>
                            <div class="col-lg-10">
                              <input type="file" class="form-control " id="imageUpload" name="imageUpload">
                            </div>
                          </div>

                </div> <!-- modal-body-->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-primary">Thêm mới</button></a>
                </div> <!-- modal-footer-->
              </div> <!-- modal-content -->
            </div> <!-- modal-dialog -->
          </div>
        </form>
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
                <p>Bạn có chắc muốn sản phẩm này xóa?</p>
              </div> <!-- modal-body-->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <a href="#" id="delete_product_href"><button type="button" class="btn btn-primary">Xóa</button></a>
              </div> <!-- modal-footer-->
            </div> <!-- modal-content -->
          </div> <!-- modal-dialog -->
        </div>
      </section>

    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <script>
      $('#deleteModal').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget) 
        var id = button.data('id')
        var modal = $(this)
        var url = '{{ route("delete-product", [":product_id"]) }}';
        url = url.replace(':product_id', id);
        modal.find('.modal-footer #delete_product_href').attr("href", url);
      })

      $('#myModal').on('shown.bs.modal', function () {
          $('#myInput').trigger('focus')
      })
  </script>
@endsection
