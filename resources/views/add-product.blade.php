@extends('layouts.cms_app')
@section ('content')
<section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Sản phẩm</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Thêm sản phẩm</h4>
              <form class="form-horizontal style-form" method="get" action={{route('add-product-submit')}}>
                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tên </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name">
                    </div>
                    @error ('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Loại </label>
                    <div class="col-sm-10">
                        <select class="form-control" name="category">
                            @foreach($categories as $category)
                              <option value='{{$category->ID}}'>{{$category->NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error ('category')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Số lượng </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="amount">
                    </div>
                    @error ('amount')
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
                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Gía cũ </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="old_price">
                    </div>
                    @error ('old_price')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Gía mới </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="new_price">
                    </div>
                    @error ('new_price')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Chọn file</label>
                  <div class="col-md-4">
                    <input type="file" class="default" name="image" />
                  </div>

                </div>

                <div class="form-group last">
                  <label class="control-label col-md-3">Image Upload</label>
                  <div class="col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                    </div>
                    <span class="label label-info">NOTE!</span>
                    <span>
                      only .jpg, .jpeg, .png and less than 5MB.
                      </span>
                  </div>
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