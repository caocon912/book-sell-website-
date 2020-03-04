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
                    <td><h4><i class="fa fa-angle-right"></i>Danh mục sản phẩm</h4></td>
                    <td><button class="btn btn-success btn-xs"><a href="{{route('add-product')}}">Thêm</button></a></td>
                  </tr>
                  <hr>
                  <tr>
                    <th><i class="fa fa-bullhorn"></i> ID</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Tên</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Loại</th>
                    <th><i class="fa fa-bullhorn"></i> Gía</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Mô tả</th>
                    <th><i class="fa fa-bookmark"></i>Hình ảnh </th>
                    <th><i class=" fa fa-edit"></i> Status</th>
                    <th><i class=" fa fa-edit"></i>Hành động</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                  <tr>
                    <td>
                      <a href="">{{$product->ID}}</a>
                    </td>
                    <td class="hidden-phone">{{$product->NAME}}</td>
                    <td>{{$product->CATEGORY_NAME}}</td>
                    <td><span class="label label-warning label-mini">{{$product->NEW_PRICE}}</span></td>
                    <td>{{$product->DESCRIPTION}}</td>
                    <td>{{$product->IMAGE}}</td>
                    <td>{{$product->STATUS}}</td>
                    <td>
                      <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                      <a href="{{route('edit-product',['product_id'=>$product->ID])}}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                      <a href="{{route('delete-product',['product_id'=>$product->ID])}}"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
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
        <!-- /row -->
      </section>
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
@endsection
