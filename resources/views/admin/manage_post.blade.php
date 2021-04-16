@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý bài viết</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Bài viết</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh mục bài viết</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
                 <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th>STT</th>
                      <th>Danh mục bài viết</th>
                      <th>Mô tả danh mục bài viết</th>
                      <th>Slug</th>
                      <th>Hình đại diện</th>
                      <th>Trạng thái</th>
                      <th>Sửa</th>
                      <th>Xóa</th>
                    </tr>
                  </thead>
                  			<tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($all_category_post as $key => $category)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td style="text-align: left;">{{ cutTitle($category->category_name,10) }}</td>
                                        <td style="text-align: justify;">{{ cutTitle($category->category_desc,10)}}</td>
                                        <td style="text-align: justify;">{{ cutTitle($category->slug_category_post,10)}}</td>
                                        <td><img src="public/uploads/images/post/{{ $category->category_image }}" height="50px" width="145px" /></td>
                                        <td>
                                            <?php
                                                if($category->category_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-category-post/'.$category->category_id)}}"><span class=" fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-category-post/'.$category->category_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update-cate-post" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    idcate: '{{$category->category_id}}',
                                                    namecate: '{{$category->category_name}}',
                                                    desccate: '{{$category->category_desc}}',
                                                    seocate: '{{$category->meta_keywords}}',
                                                    statuscate: '{{$category->category_status}}',
                                                    imagecate: '{{$category->category_image}}', 
                                                })"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục bài viết này không?')" href="{{URL::to('/delete-category-post/'.$category->category_id)}}" class="active styling-edit" ui-toggle-class="">
                                                <i class="fa fa-trash text-danger text"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                </table>
                
              </div>
              <br>
              <div style="padding-left: 20px">
                    {{ $all_category_post->links() }}
                    <br>
			        <button data-toggle="modal" data-target="#modal-xl-add-cate-post" ui-toggle-class="" type="submit" name="add_category_post" class="btn btn-warning">Thêm mới danh mục bài viết</button>
			   </div>
			   <br>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách bài viết</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 1000px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                  <tr style="text-align: center;">
                    <th>STT</th>
                    <th>Tiêu đề bài viết</th>
                    <th>Nội dung tóm tắt của bài viết</th>
                    <th>Danh mục bài viết</th>
                    <th>Trạng thái</th>
                    <th>Nổi bật</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                  </tr>
                  </thead>
                  <tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($all_post as $key => $post)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td style="text-align: left;">{{ cutTitle($post->post_name,10) }}</td>
                                        <td style="text-align: justify;">{!! cutTitle($post->post_desc,10)!!}</td>
                                        <td style="text-align: justify;">{{ $post->category_name }}</td>
                                        <td>
                                            <?php
                                                if($post->post_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-post/'.$post->post_id)}}"><span class=" fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-post/'.$post->post_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($post->post_noibat==1){
                                            ?>
                                                <a href="{{URL::to('/unnoibat-post/'.$post->post_id)}}"><span class=" fa fa-check"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/noibat-post/'.$post->post_id)}}"><span style="color: orange" class="fa fa-times"></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update-post" class="active styling-edit" ui-toggle-class=""
			                                    data-id="{{ $post->post_id }}"
			                                    data-name="{{ $post->post_name }}"
			                                    data-desc="{{ $post->post_desc }}"
			                                    data-content="{{ $post->post_content }}"
			                                    data-image="{{ $post->post_image }}"
			                                    data-category="{{ $post->category_id }}"
			                                    data-seo="{{ $post->key_words }}"
			                                    data-status="{{ $post->post_status }}"
                                          data-tags="{{ $post->post_tags }}"
                                          data-noibat="{{ $post->post_noibat }}"
                                          data-author="{{ $post->post_author }}"
                                    onclick="renderPRO(this)"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa bài viết này không?')" href="{{URL::to('/delete-post/'.$post->post_id)}}" class="active styling-edit" ui-toggle-class="">
                                                <i class="fa fa-trash text-danger text"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                </table>
                <br>
                <div style="padding-left: 20px">
                    {{ $all_post->links() }}
                    <br>
      			    <button data-toggle="modal" data-target="#modal-xl-add-post" ui-toggle-class="" type="submit" name="add_post" class="btn btn-warning">Thêm mới bài viết</button>
      			    </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

{{-- modal danh muc bai viet --}}
      <div class="modal fade" id="modal-xl-add-cate-post">
	    <div class="modal-dialog modal-xl">
	        <div class="modal-content">
	            <form action="{{URL::to('/insert-category-post')}}" role="form" method="post" enctype="multipart/form-data">
	                {{ csrf_field() }}
	                <div class="modal-header">
	                    <h4 class="modal-title">Thêm mới danh mục bài viết</h4>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body">
	                    <div class="col-md-12">
	                        <!-- general form elements disabled -->
	                        <div class="card card-warning">
	                            <div class="card-header">
	                                <h3 class="card-title">Thông tin của danh mục bài viết</h3>
	                            </div>
	                            <!-- /.card-header -->
	                            <div class="card-body">
	                                <form action="" role="form" method="post" enctype="multipart/form-data">
	                                  {{ csrf_field() }}
	                                <div class="row">
	                                    <div class="col-sm-12">
	                                      <!-- text input -->
	                                      <div class="form-group">
	                                        <label class="col-form-label" for="inputWarning">Tên danh mục bài viết</label>
	                                        <input name="category_post_name" type="text" class="form-control is-warning" placeholder="Nhập tên của danh mục bài viết." required>
	                                      </div>
	                                    </div>
	                                    <div class="col-sm-12">
	                                      <div class="form-group">
	                                        <label class="col-form-label" for="inputWarning">Nội dung mô tả danh mục bài viết</label>
	                                        <input name="category_post_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả danh mục bài viết." required>
	                                      </div>
	                                    </div>
	                                    <div class="col-sm-12">
	                                      <div class="form-group">
	                                        <label class="col-form-label" for="inputWarning">Từ khóa SEO danh mục bài viết</label>
	                                        <input name="meta_keywords" type="text" class="form-control is-warning" placeholder="Nhập từ khóa SEO danh mục bài viết." required>
	                                      </div>
	                                    </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Hình ảnh đại diện danh mục 460x244px</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="category_post_image" type="file" class="custom-file-input" id="customFileImage" required/>
                                                    <label class="custom-file-label" for="customFileImage">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
		                                <div class="col-sm-6">
		                                    <div class="form-group">
		                                        <label class="col-form-label" for="inputWarning">Trạng thái</label>
		                                            <select name="category_post_status" class="form-control is-warning">
		                                                <option value="1">Hiển thị</option>
		                                                <option value="0">Không hiển thị</option>
		                                            </select>
		                                      </div>
		                                </div>   
	                                    </div>
	                                </div>
	                                  <div class="modal-footer justify-content-between">
	                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
	                                    <button type="submit" name="insert-category-post" class="btn btn-warning">THÊM MỚI</button>
	                                </div>
	                                </form>
	                              </div>
	                            <!-- /.card-body -->
	                        </div>
	                        <!-- /.card -->
	                    </div>
	                </div>
	            </form>
	        </div>
	        <!-- /.modal-content -->
	    </div>
	  </div>
<script type="text/javascript">

    const renderDOM = category => {
        console.log(category)
        const action = '{!! URL::to('/update-category-post') !!}/' + category.idcate;
        document.getElementById("formcatepostEdit").action = action;
        document.getElementById("namecatepostEdit").value = category.namecate;
        document.getElementById("desccatepostEdit").value = category.desccate;
        document.getElementById("statuscatepostEdit").value = category.statuscate;
        document.getElementById("seocatepostEdit").value = category.seocate;
        document.getElementById("imagecatepostEdit").src = 'public/uploads/images/post/' + category.imagecate;
    }
</script>
<div class="modal fade" id="modal-xl-update-cate-post">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formcatepostEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin danh mục bài viết</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của danh mục bài viết</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Tên danh mục bài viết</label>
                                        <input id="namecatepostEdit" name="category_post_name" type="text" class="form-control is-warning" placeholder="Nhập tên của danh mục bài viết." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Nội dung mô tả danh mục bài viết</label>
                                        <input id="desccatepostEdit" name="category_post_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả danh mục bài viết." required>
                                      </div>
                                    </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-form-label" for="inputWarning">Từ khóa SEO</label>
                                          <input id="seocatepostEdit" name="meta_keywords" type="text" class="form-control is-warning" placeholder="Nhập từ khóa SEO." required>
                                      </div>
                                    </div>
                                  
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-form-label" for="inputWarning">Trạng thái</label>
                                              <select id="statuscatepostEdit" name="category_post_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="col-form-label" for="inputWarning">Hình ảnh đại diện danh mục bài viết hiện tại 460x244px</label>
                                      <div>
                                        <img style="width: 100px; align-items: center;" id="imagecatepostEdit" src="#">
                                      </div>
                                    </div>
                                  </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Cập nhật lại hình ảnh danh mục bài viết 460x244px</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="category_post_image" type="file" class="custom-file-input" id="customFileFile" />
                                                    <label class="custom-file-label" for="customFileFile">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-category-post" class="btn btn-warning">CẬP NHẬT</button>
                                </div>
                                </form>
                              </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

{{-- modal bai viet --}}

      <div class="modal fade" id="modal-xl-add-post">
	    <div class="modal-dialog modal-xl">
	        <div class="modal-content">
	            <form action="{{URL::to('/insert-post')}}" role="form" method="post" enctype="multipart/form-data">
	                {{ csrf_field() }}
	                <div class="modal-header">
	                    <h4 class="modal-title">Thêm mới danh mục bài viết</h4>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body">
	                    <div class="col-md-12">
	                        <!-- general form elements disabled -->
	                        <div class="card card-warning">
	                            <div class="card-header">
	                                <h3 class="card-title">Thông tin của bài viết</h3>
	                            </div>
	                            <!-- /.card-header -->
	                            <div class="card-body">
	                                <form action="" role="form" method="post" enctype="multipart/form-data">
	                                  {{ csrf_field() }}
	                                <div class="row">
	                                    <div class="col-sm-12">
	                                      <!-- text input -->
	                                      <div class="form-group">
	                                        <label class="col-form-label" for="inputWarning">Tiêu đề bài viết</label>
	                                        <input name="post_name" type="text" class="form-control is-warning" placeholder="Nhập tiêu đề của bài viết." required>
	                                      </div>
	                                    </div>
	                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Nội dung tóm tắt bài viết</label>
                                        <textarea style="resize: none" rows="8" name="post_desc" type="text" class="form-control is-warning" id="ckeditordesc"  placeholder="Nhập nội dung tóm tắt bài viết." required></textarea>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Nội dung bài viết</label>
                                        <textarea style="resize: none" rows="8" name="post_content" type="text" class="form-control is-warning" id="ckeditorcontent"  placeholder="Nhập nội dung bài viết..." required></textarea>
                                      </div>
                                    </div>
	                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Hình ảnh đại diện bài viết 460x244px</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="post_image" type="file" class="custom-file-input" id="customFile " />
                                                    <label class="custom-file-label" for="customFile">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
	                                    <div class="col-sm-6">
	                                      <div class="form-group">
	                                        <label class="col-form-label" for="inputWarning">Danh mục bài viết</label>
	                                        <select name="post_cate" class="form-control is-warning">
                                                @foreach($all_category_post as $key => $catepost)
                                                <option value="{{$catepost->category_id}}">{{$catepost->category_name}}</option>
                                                @endforeach
                                            </select>
	                                      </div>
	                                    </div>
	                                    <div class="col-sm-12">
	                                      <div class="form-group">
	                                        <label class="col-form-label" for="inputWarning">Từ khóa SEO  bài viết</label>
	                                        <input name="meta_keywords" type="text" class="form-control is-warning" placeholder="Nhập từ khóa SEO bài viết." required>
	                                      </div>
	                                    </div>
		                                <div class="col-sm-6">
		                                    <div class="form-group">
		                                        <label class="col-form-label" for="inputWarning">Trạng thái</label>
		                                            <select name="post_status" class="form-control is-warning">
		                                                <option value="1">Hiển thị</option>
		                                                <option value="0">Không hiển thị</option>
		                                            </select>
		                                      </div>
		                                </div>  
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Bài viết nổi bật</label>
                                                <select name="post_noibat" class="form-control is-warning">
                                                    <option value="1">Hiển thị</option>
                                                    <option value="0">Không hiển thị</option>
                                                </select>
                                          </div>
                                    </div>    
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                          <label class="col-form-label" for="inputWarning">Tên người đăng bài</label>
                                          <input name="post_author" type="text" class="form-control is-warning" placeholder="Nhập tên hoặc biệt danh người đăng bài." required>
                                        </div>
                                      </div>
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Tags</label><br>
                                            <input  type="text" class="form-control is-warning" name="post_tags" placeholder="Nhập tags, các tags cách nhau dấu phẩy (,)">
                                        </div>
                                    </div>
	                                    </div>
	                                </div>
	                                  <div class="modal-footer justify-content-between">
	                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
	                                    <button type="submit" name="insert-post" class="btn btn-warning">THÊM MỚI</button>
	                                </div>
	                                </form>
	                              </div>
	                            <!-- /.card-body -->
	                        </div>
	                        <!-- /.card -->
	                    </div>
	                </div>
	            </form>
	        </div>
	        <!-- /.modal-content -->
	    </div>
	  </div>
<script type="text/javascript">
    const renderPRO = post => {
        console.log(post.dataset)
        const action = '{!! URL::to('/update-post') !!}/' + post.dataset.id;
        document.getElementById("formpostEdit").action = action;
        document.getElementById("namepostEdit").value = post.dataset.name;
        CKEDITOR.instances.ckeditordescedit.setData(post.dataset.desc);
        document.getElementById("statuspostEdit").value = post.dataset.status;
        document.getElementById("seopostEdit").value = post.dataset.seo;
        document.getElementById("tagspostEdit").value = post.dataset.tags;
        document.getElementById("imagepostEdit").src = 'public/uploads/images/post/' + post.dataset.image;
        CKEDITOR.instances.ckeditorcontentedit.setData(post.dataset.content);
        document.getElementById("categorypostEdit").value = post.dataset.category;
        document.getElementById("noibatpostEdit").value = post.dataset.noibat;
        document.getElementById("authorpostEdit").value = post.dataset.author;
    }
</script>
<div class="modal fade" id="modal-xl-update-post">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formpostEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật bài viết</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của bài viết</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Tiêu đề bài viết</label>
                                        <input id="namepostEdit" name="post_name" type="text" class="form-control is-warning" placeholder="Nhập tiêu đề của bài viết." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Nội dung tóm tắt bài viết</label>
                                        <textarea style="resize: none" rows="8" name="post_desc"  class="form-control is-warning" id="ckeditordescedit" placeholder="Nhập nội dung tóm tắt bài viết..." /></textarea>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Nội dung bài viết</label>
                                        <textarea style="resize: none" rows="8" name="post_content"  class="form-control is-warning" id="ckeditorcontentedit" placeholder="Nhập nội dung bài viết..." /></textarea>
                                	  </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-form-label" for="inputWarning">Từ khóa SEO</label>
                                          <input id="seopostEdit" name="meta_keywords" type="text" class="form-control is-warning" placeholder="Nhập từ khóa SEO." required>
                                      	</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Tags</label><br>
                                            <input id="tagspostEdit" type="text" class="form-control is-warning" name="post_tags" placeholder="Nhập tags, các tags cách nhau dấu phẩy (,)">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Danh mục bài viết</label>
                                            <select id="categorypostEdit" name="post_cate" class="form-control is-warning">
                                                @foreach($all_category_post as $key => $cate)
                                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="inputWarning">Trạng thái</label>
                                              <select id="statuspostEdit" name="post_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="inputWarning">Bài viết nổi bật</label>
                                              <select id="noibatpostEdit" name="post_noibat" class="form-control is-warning">
                                                  <option value="0">Không</option>
                                                  <option value="1">Có</option>
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                      <label class="col-form-label" for="inputWarning">Hình ảnh đại diện bài viết hiện tại 1726x660px</label>
                                      <div>
                                        <img style="width: 100px; align-items: center;" id="imagepostEdit" src="#">
                                      </div>
                                  </div>
                                  </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Cập nhật lại hình ảnh sản phẩm 1726x660px</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="post_image" type="file" class="custom-file-input" id="customFile" />
                                                    <label class="custom-file-label" for="customFile">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- text input -->
                                        <div class="form-group">
                                          <label class="col-form-label" for="inputWarning">Tên người đăng bài</label>
                                          <input id="authorpostEdit" name="post_author" type="text" class="form-control is-warning" placeholder="Nhập tên hoặc biệt danh người đăng bài." required>
                                        </div>
                                      </div>
                                </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-post" class="btn btn-warning">CẬP NHẬT</button>
                                </div>
                              	</div>
                              </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
@endsection
