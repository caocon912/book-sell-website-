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
                    <td colspan="3"><h4><i class="fa fa-angle-right"></i>Danh mục loại</h4></td>
                    <!-- Button trigger modal -->
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="add_product">
                      Thêm
                  </button></td>
                  </tr>
                  <hr>
                  <tr>
                    <th> ID</th>
                    <th class="hidden-phone"> Tên loại</th>
                    <th class="hidden-phone"> Mô tả</th>
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
                      {{-- <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button> --}}
                      <button class="btn btn-primary btn-xs" data-id = '{{$category->ID}}' data-toggle="modal" data-target="#editModal" id="edit_category" class='edit_product'><i class="fa fa-pencil"></i></a></button>
                      <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" id="delete_product" class='delete_category'><i class="fa fa-trash-o "></i></button>
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
        <!-- Add Modal -->
        <form class="form-horizontal style-form" method="post" action={{route('add-category-submit')}} enctype="multipart/form-data">
          @csrf
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tên </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name">
                    </div>
                    @error ('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                
                  <div class="form-group ">
                      <label for="ccomment" class="control-label col-lg-2">Mô tả</label>
                      <div class="col-lg-10">
                        <textarea class="form-control " id="ccomment" name="comment"></textarea>
                      </div>
                      @error ('comment')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <div class="form-group ">
                      <label for="ccomment" class="control-label col-lg-2">Status</label>
                      <div class="col-lg-10">
                        <input name="status" type="radio" value="1">Active
                        <input name="status" type="radio" value="0">Deactive
                      </div>
                      @error ('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
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
        <!-- Edit Modal -->
        <form class="form-horizontal style-form" method="get" action='{{route('edit-category-submit',['category_id'=>$category->ID])}}'>
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exitModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Chỉnh danh mục</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="editModalBody">
                  
                </div> <!-- modal-body-->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-primary">Lưu</button></a>
                </div> <!-- modal-footer-->
              </div> <!-- modal-content -->
            </div> <!-- modal-dialog -->
          </div>
        </form>
        
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Xoá danh mục</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="editModalBody">
                  <p>Bạn có chắc muốn xóa?</p>
                </div> <!-- modal-body-->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <a href="{{route('delete-category',['category_id'=>$category->ID])}}"><button type="button" class="btn btn-primary">Xóa</button></a>
                </div> <!-- modal-footer-->
              </div> <!-- modal-content -->
            </div> <!-- modal-dialog -->
          </div>
      </section>
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
<script>
    $(document).ready(function(){

      $('.edit_product').click(function(){
        
        var category_id = $(this).data('id');
     
        // AJAX request
        $.ajax({
         url: 'ajax/get-category/c_id='+category_id,
         type: 'get',
         data: {category_id: category_id},
         success: function(response){ 
           // Add response in Modal body
           $('.modal-body').html(response);
     
           // Display Modal
           $('#editModal').modal('show'); 
         }
       });
      });
     });
</script>
@endsection