@extends('layouts.cms_app')
@section('content')
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Danh mục</h3>
        <!-- row -->
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <td><h4><i class="fa fa-angle-right"></i>Danh mục loại</h4></td>
                    <td><button class="btn btn-success btn-xs"><a href="{{route('add-category')}}">Thêm</button></a></td>
                  </tr>
                  <hr>
                  <tr>
                    <th><i class="fa fa-bullhorn"></i> ID</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Tên loại</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Mô tả</th>
                    <th><i class=" fa fa-edit"></i> Status</th>
                    <th><i class=" fa fa-edit"></i>Hành động</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                  <tr>
                    <td>
                      <a href="">{{$category->ID}}</a>
                    </td>
                    <td class="hidden-phone">{{$category->NAME}}</td>
                    <td>{{$category->DESCRIPTION}}</td>
                    <td>{{$category->STATUS}}</td>
                    <td>
                      <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                      <a href="{{route('edit-category',['category_id'=>$category->ID])}}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                      <a href="{{route('delete-category',['category_id'=>$category->ID])}}"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
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