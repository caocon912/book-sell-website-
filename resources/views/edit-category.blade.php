@extends('layouts.cms_app')
@section ('content')
<section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Danh mục</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Thêm loại</h4>
              <form class="form-horizontal style-form" method="get" action='{{route('edit-category-submit',['category_id'=>$category->ID])}}'>
                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tên </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value='{{$category->NAME}}'>
                    </div>
                    @error ('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">Mô tả</label>
                    <div class="col-lg-10">
                      <textarea class="form-control " id="ccomment" name="comment">{{$category->DESCRIPTION}}</textarea>
                    </div>
                    @error ('comment')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">Status</label>
                    <div class="col-lg-10">
                        @if($category->STATUS=='1')
                            <input type="radio" name="status" value="1" checked > Active
                            <input type="radio" name="status" value="0"> Deactive
                        @else
                            <input type="radio" name="status" value="1" > Active
                            <input type="radio" name="status" value="0" checked> Deactive
                        @endif
                        
                    </div>
                    @error ('status')
                      <div class="alert alert-danger">{{ $status }}</div>
                    @enderror
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