@extends('layouts.cms_app')
@section('content')
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Tài khoản</h3>
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
        <!-- row -->
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <td colspan="3"><h4><i class="fa fa-angle-right"></i>Danh mục tài khoản</h4></td>
                    <!-- Button trigger modal -->
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="add_product">
                      Thêm
                  </button></td>
                  </tr>
                  <hr>
                  <tr>
                    <th> ID</th>
                    <th class="hidden-phone">Username</th>
                    <th class="hidden-phone">Email</th>
                    <th>Họ tên</th>
                    <th>Ngày tạo</th>
                    <th><i class=" fa fa-edit">Cập nhật lúc</i></th>
                    <th>Số lần đăng nhập</th>
                    <th><i class=" fa fa-edit">Status</i></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>
                      <a href="">{{$user->ID}}</a>
                    </td>
                    <td>{{$user->USERNAME}}</td>
                    <td>{{$user->EMAIL}}</td>
                    <td>{{$user->NAME}}</td>
                    <td>{{$user->CREATE_AT}}</td>
                    <td>{{$user->UPDATE_AT}}</td>
                    <td>{{$user->COUNT_LOGIN}}</td>
                    <td>{{$user->STATUS}}</td>
                    <td>
                      {{-- <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button> --}}
                    <button class="btn btn-primary btn-xs" data-id = '{{$user->ID}}' data-username='{{$user->USERNAME}}' data-name='{{$user->NAME}}' data-email='{{$user->EMAIL}}' data-status='{{$user->STATUS}}' data-phone='{{$user->PHONE_NUMBER}}' data-address_1='{{$user->ADDRESS_1}}'data-address_2='{{$user->ADDRESS_2}}' data-avatar='{{$user->AVATAR}}' data-toggle="modal" data-target="#editModal" id="edit_user" class='edit_user'><i class="fa fa-pencil"></i></button></a>
                    <button class="btn btn-danger btn-xs"  data-id= '{{$user->ID}}' data-toggle="modal" data-target="#deleteModal" id="delete_user" class='delete_user'><i class="fa fa-trash-o "></i></button>
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
        <form class="form-horizontal style-form" method="post" action={{route('add-user-submit')}} enctype="multipart/form-data">
          @csrf
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Thêm tài khoản</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    @error ('username')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                
                  <div class="form-group ">
                      <label for="ccomment" class="control-label col-lg-2">Email</label>
                      <div class="col-lg-10">
                        <textarea class="form-control " id="email" name="email" required></textarea>
                      </div>
                      @error ('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">Ho ten</label>
                    <div class="col-lg-10">
                      <textarea class="form-control " id="name" name="name" required></textarea>
                    </div>
                    @error ('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">Dia chi nha</label>
                    <div class="col-lg-10">
                      <textarea class="form-control " id="address_1" name="address_1" required></textarea>
                    </div>
                    @error ('address_1')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">Dia chi cong ty</label>
                    <div class="col-lg-10">
                      <textarea class="form-control " id="address_2" name="address_2"></textarea>
                    </div>
                    @error ('address_2')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">SDT</label>
                    <div class="col-lg-10">
                      <textarea class="form-control " id="phone_number" name="phone_number" required></textarea>
                    </div>
                    @error ('phone_number')
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

                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">Mat khau</label>
                    <div class="col-lg-10">
                      <textarea class="form-control " id="pwd" name="pwd" required></textarea>
                    </div>
                    @error ('pwd')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group ">
                    <label for="image" class="control-label col-lg-2">Hình đại diện</label>
                    <div class="col-lg-10">
                      <input type="file" class="form-control " id="avatar" name="avatar">
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
        <!-- Edit Modal -->
        <form class="form-horizontal style-form" method="post" id="edit_user_form" action='#' enctype="multipart/form-data">
          @csrf
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exitModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Chỉnh tài khoản</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="editModalBody">
                        <div class="form-group last">
                          <label class="control-label col-md-3">Hình đại diện</label>
                          <div class="col-md-9">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                              <img src="" id="edit_avatar_src" alt="hinh anh user" class="fileupload-new thumbnail" style="width: 200px; height: 150px;"/>
                                {{-- <img src="uploads/{{$product->IMAGE}}" alt="hinh anh san pham" />
                              </div> --}}
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            </div>
                            <span class="label label-info">NOTE!</span>
                            <span>
                              only .jpg, .jpeg, .png and less than 5MB.
                              </span>
                          </div>
                        </div>
  
                        <div class="form-group ">
                          <label for="image" class="control-label col-lg-2">Hình đại diện</label>
                          <div class="col-lg-10">
                            <input type="file" class="form-control " id="edit_avatar" name="avatar">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">username</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="username" id="edit_username" required>
                          </div>
                        </div>
                      
                        <div class="form-group ">
                            <label for="ccomment" class="control-label col-lg-2">Email</label>
                            <div class="col-lg-10">
                              <input class="form-control " id="edit_email" name="email" required>
                            </div>
                        </div>
      
                        <div class="form-group ">
                          <label for="ccomment" class="control-label col-lg-2">Ho ten</label>
                          <div class="col-lg-10">
                            <input class="form-control " id="edit_name" name="name" required>
                          </div>
                        </div>
      
                        <div class="form-group ">
                          <label for="ccomment" class="control-label col-lg-2">Dia chi nha</label>
                          <div class="col-lg-10">
                            <input class="form-control " id="edit_address_1" name="address_1" required>
                          </div>
                        </div>
      
                        <div class="form-group ">
                          <label for="ccomment" class="control-label col-lg-2">Dia chi cong ty</label>
                          <div class="col-lg-10">
                            <input class="form-control " id="edit_address_2" name="address_2">
                          </div>
                        </div>
      
                        <div class="form-group ">
                          <label for="ccomment" class="control-label col-lg-2">SDT</label>
                          <div class="col-lg-10">
                            <input class="form-control " id="edit_phone_number" name="phone_number" required>
                          </div>
                        </div>
      
                        <div class="form-group ">
                            <label for="ccomment" class="control-label col-lg-2">Status</label>
                            <div class="col-lg-10">
                              <input name="status" type="radio" value="1" id='edit_active'>Active
                              <input name="status" type="radio" value="0" id='edit_deactive'>Deactive
                            </div>
                        </div>

                        <div class="form-group ">
                          <label for="ccomment" class="control-label col-lg-2">Mat khau</label>
                          <div class="col-lg-10">
                            <input class="form-control " id="edit_pwd" name="pwd" type="password">
                          </div>
                          @error ('pwd')
                            <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
      
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
                  <h5 class="modal-title" id="exampleModalLabel">Xoá tài khoản</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="editModalBody">
                  <p>Bạn có chắc muốn xóa?</p>
                </div> <!-- modal-body-->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <a href="#" id="url_delete_user"><button type="button" class="btn btn-primary">Xóa</button></a>
                </div> <!-- modal-footer-->
              </div> <!-- modal-content -->
            </div> <!-- modal-dialog -->
          </div>
      </section>
      {{$users->links()}}
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
<script>
    $('#deleteModal').on('show.bs.modal',function(event){
      var button = $(event.relatedTarget) 
      var id = button.data('id')
      var modal = $(this)
      var url = '{{ route("delete-user", [":user_id"]) }}';
      url = url.replace(':user_id', id);
      modal.find('.modal-footer #url_delete_user').attr("href", url);
    })
    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var id = button.data('id')
      var username = button.data('username')
      var name = button.data('name') 
      var email = button.data('email')
      var phone = button.data('phone')
      var address_1 = button.data('address_1')
      var address_2 = button.data('address_2')
      var status = button.data('status') 
      var img = button.data('avatar')
      var modal = $(this)
      modal.find('.modal-body #edit_username').val(username);
      modal.find('.modal-body #edit_name').val(name);
      modal.find('.modal-body #edit_email').val(email);
      modal.find('.modal-body #edit_phone_number').val(phone);
      modal.find('.modal-body #edit_address_1').val(address_1);
      modal.find('.modal-body #edit_address_2').val(address_2);
      modal.find('.modal-body #edit_avatar_src').attr("src", '../../uploads/'+img);
      if (status=="1"){
        modal.find('.modal-body #edit_active').prop("checked", true);
      } else if (status=="0"){
        modal.find('.modal-body #edit_deactive').prop("checked", true);
      }
      var url = "{{route('edit-user-submit',[':user_id'])}}";
      url = url.replace(':user_id',id);
      $('#edit_user_form').attr('action', url);

    }) 
  
</script>
@endsection