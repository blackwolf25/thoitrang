@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý sản phẩm</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>        

        <div class="breadcrumb float-sm-right">
          <button data-toggle="modal" data-target="#modal-xl-add" ui-toggle-class="" type="submit" name="" class="btn btn-warning">Thêm mới</button>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
      	
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách sản phẩm</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 1700px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead style="text-align: center;">
                      <tr>
                        <th style="width: 10px;">STT</th>
                        <th>Tên sản phẩm</th>
                        <th style="width: 100px;">Hình ảnh</th>
                        
                        <th>Danh mục</th>
                        <th>Nhà sản xuất</th>
                        <th>Đơn giá</th>
                        <th>Nhập</th>
                        <th>Số lượng</th>
                        <th>Kho</th>
                        <th>Thư viện ảnh</th>
                        <th>Tài liệu kèm theo</th>
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
                    @foreach($all_product as $key => $product)
                        @php 
                            $i++;
                        @endphp
                        <tr style="text-align: center; align-self: center;">
                            <td>{{$i}}</td>
                            <td style="text-align: left;">{{ cutTitle($product->product_name,10) }}</td>
                            <td><img src="public/uploads/images/product/{{ $product->product_image }}" height="50" width="50" /></td>
                            
                            <td><span class="badge badge-warning">{{ $product->category_name }}</span></a></td>
                            <td><span class="badge badge-info">{{ $product->brand_name }}</span></td>
                            <td>{{ number_format($product->product_price) }} VNĐ</td>
                            <td>{{ number_format($product->product_nhap) }} VNĐ</td>
                            <td>{{ $product->product_quantity }}</td>
                            <td>
                                <?php
                                     if($product->product_quantity - $product->product_sold < 3){
                                ?>
                                    <span class="badge badge-danger">{{ $product->product_quantity - $product->product_sold }}</span>
                                <?php
                                    }else{
                                ?>
                                     <span class="badge badge-success">{{ $product->product_quantity - $product->product_sold }}</span>
                                <?php
                                    }
                                ?>
                            </td>
                            <td><a href="{{URL::to('add-gallery/'.$product->product_id)}}"><span class="fa fa-file-image text-warning text"></span></a></td>
                            <td>
                                <?php
                                    if($product->product_file){
                                ?>
                                    <a href="public/uploads/files/{{$product->product_file}}"><span style="color: red" class="fa fa-file"></span></a>
                                <?php
                                    }else{
                                ?>
                                    <a><span style="color: black" class="fa fa-file"></span></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($product->product_status==1){
                                ?>
                                    <a href="{{URL::to('/unactive-product/'.$product->product_id)}}"><span class="fa fa-eye"></span></a>
                                <?php
                                    }else{
                                ?>
                                    <a href="{{URL::to('/active-product/'.$product->product_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($product->product_noibat==1){
                                ?>
                                    <a href="{{URL::to('/unnoibat-product/'.$product->product_id)}}"><span class="fa fa-check"></span></a>
                                <?php
                                    }else{
                                ?>
                                    <a href="{{URL::to('/noibat-product/'.$product->product_id)}}"><span style="color: orange" class="fa fa-times "></span></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                    data-id="{{ $product->product_id }}"
                                    data-name="{{ $product->product_name }}"
                                    data-desc="{{ $product->product_desc }}"
                                    data-content="{{ $product->product_content }}"
                                    data-image="{{ $product->product_image }}"
                                    data-category="{{ $product->category_id }}"
                                    data-brand="{{ $product->brand_id }}"
                                    data-status="{{ $product->product_status }}"
                                    data-price="{{ $product->product_price }}"
                                    data-quantity="{{ $product->product_quantity }}"
                                    data-tags="{{ $product->product_tags }}"
                                    data-file="{{ $product->product_file }}"
                                    data-exp="{{ $product->product_exp }}"
                                    data-mfg="{{ $product->product_mfg }}"
                                    data-noibat="{{ $product->product_noibat }}"
                                    data-nhap="{{ $product->product_nhap }}"
                                    onclick="renderDOM(this)"><i class="fa fa-edit text-success text-active"></i>
                                </a>
                            </td>
                            <td>
                                <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')" href="{{URL::to('/delete-product/'.$product->product_id)}}" class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-trash text-danger text"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                 
                </table>
                <br>
                
                 
              </div>
              <div class="content-header">
                    {{ $all_product->links() }}
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
<div class="modal fade" id="modal-xl-add">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{URL::to('/save-product')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mới sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin sản phẩm</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning">Tên sản phẩm</label>
                                    <input type="text" class="form-control is-warning" name="product_name" placeholder="Nhập tên sản phẩm..." required>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="5" name="product_desc" type="text" class="form-control is-warning" id="ckeditordesc"  placeholder="Nhập mô tả sản phẩm..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="8" name="product_content" type="text" class="form-control is-warning" id="ckeditorcontent"  placeholder="Nhập nội dung sản phẩm..." required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Danh mục sản phẩm</label>
                                            <select name="product_cate" class="form-control is-warning">
                                                  @foreach ($cate_product as $key => $val)
                                                    @if ($val->category_parent == 0)
                                                      <option value="{{ $val->category_id }}">{{ $val->category_name }}</option>
                                                    @endif
                                                    @foreach ($cate_product as $key => $val2)
                                                      @if ($val2->category_parent == $val->category_id)
                                                      <option value="{{ $val2->category_id }}">----- {{ $val2->category_name }}</option>
                                                    @endif
                                                    @endforeach
                                                  @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Nhà sản xuất sản phẩm / Nhà sản xuất</label>
                                            <select name="product_brand" class="form-control is-warning">
                                                @foreach($brand_product as $key => $brand)
                                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="product_status" class="form-control is-warning">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Không hiển thị</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Đơn giá bán</label>
                                            <input type="text" class="form-control is-warning" name="product_price" placeholder="Nhập giá lẻ..." required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Đơn giá nhập</label>
                                            <input type="text" class="form-control is-warning" name="product_nhap" placeholder="Nhập giá nhập..." required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Số lượng nhập</label>
                                            <input type="text" class="form-control is-warning" name="product_quantity" placeholder="Nhập số lượng sản phẩm nhập kho..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="exampleInputFile">Tài liệu kèm theo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="product_file" type="file" class="custom-file-input" id="customFileFile" />
                                                    <label class="custom-file-label" for="customFileFile">Chọn tệp tài liệu đính kèm</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <div class="form-group">
                                        <label class="col-form-label" for="exampleInputFile">Ngày sản xuất MFG</label>
                                          <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                              <input name="product_mfg"  placeholder="Nhập tháng/ ngày/ năm sản xuất của sản phẩm." type="text" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                                              <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <div class="form-group">
                                        <label class="col-form-label" for="exampleInputFile">Ngày hết hạn EXP</label>
                                          <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                              <input name="product_exp"  placeholder="Nhập tháng/ ngày/ năm hết hạn sử dụng của sản phẩm." type="text" class="form-control datetimepicker-input" data-target="#reservationdate2"/>
                                              <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="exampleInputFile">Hình ảnh 1.000x1.000px</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="product_image" type="file" class="custom-file-input" id="customFile1" />
                                                    <label class="custom-file-label" for="customFile1">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="exampleInputFile">Sản phẩm nổi bật</label>
                                            <select name="product_noibat" class="form-control is-warning">
                                                <option value="0">Không</option>
                                                <option value="1">Có</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Tags</label><br>
                                            
                                                <input type="text" class="form-control is-warning" name="product_tags" placeholder="Nhập tags, các tags cách nhau dấu phẩy (,)">
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="add_product" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<script type="text/javascript">
    
    const renderDOM = product => {
        console.log(product.dataset)
        const action = '{!! URL::to('/update-product') !!}/' + product.dataset.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("nameEdit").value = product.dataset.name;
        CKEDITOR.instances.ckeditordescedit.setData(product.dataset.desc);
        document.getElementById("imageEdit").src = 'public/uploads/images/product/' + product.dataset.image;
        document.getElementById("categoryEdit").value = product.dataset.category;
        document.getElementById("brandEdit").value = product.dataset.brand;
        document.getElementById("statusEdit").value = product.dataset.status;
        document.getElementById("priceEdit").value = product.dataset.price;
        document.getElementById("quantityEdit").value = product.dataset.quantity;
        document.getElementById("tagsEdit").value = product.dataset.tags;
        document.getElementById("fileEdit").value = product.dataset.file;
        document.getElementById("expEdit").value = product.dataset.exp;
        document.getElementById("mfgEdit").value = product.dataset.mfg;
        document.getElementById("noibatEdit").value = product.dataset.noibat;
        document.getElementById("nhapEdit").value = product.dataset.nhap;
        CKEDITOR.instances.ckeditorcontentedit.setData(product.dataset.content);
    }

</script>
<!-- /.modal-dialog -->
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin sản phẩm</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Tên sản phẩm</label>
                                            <input value="" type="text" class="form-control is-warning" id="nameEdit" name="product_name" placeholder="Nhập tên sản phẩm..." />
                                        </div>
                                        </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Mô tả sản phẩm</label>
                                            <textarea style="resize: none" rows="5" name="product_desc"  class="form-control is-warning" id="ckeditordescedit" placeholder="Nhập mô tả sản phẩm..." /></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Nội dung sản phẩm</label>
                                            <textarea style="resize: none" rows="8" name="product_content"  class="form-control is-warning" id="ckeditorcontentedit" placeholder="Nhập nội dung sản phẩm..." /></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Danh mục sản phẩm</label>
                                            <select id="categoryEdit" name="product_cate" class="form-control is-warning">
                                                <option value="0">----- Danh mục gốc -----</option>
                                                  @foreach ($cate_product as $key => $val)
                                                    @if ($val->category_parent == 0)
                                                      <option value="{{ $val->category_id }}">{{ $val->category_name }}</option>
                                                    @endif
                                                    @foreach ($cate_product as $key => $val2)
                                                      @if ($val2->category_parent == $val->category_id)
                                                      <option value="{{ $val2->category_id }}">----- {{ $val2->category_name }}</option>
                                                    @endif
                                                    @endforeach
                                                  @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Nhà sản xuất sản phẩm / Nhà sản xuất</label>
                                            <select id="brandEdit" name="product_brand" class="form-control is-warning">
                                                @foreach($brand_product as $key => $brand)
                                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Trạng thái</label>
                                            <div class="input-group">
                                                    <select id="statusEdit" name="product_status" class="form-control is-warning">
                                                        <option value="1">Hiển thị</option>
                                                        <option value="0">Không hiển thị</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Đơn giá bán</label>
                                            <input id="priceEdit" type="text" class="form-control is-warning" name="product_price" placeholder="Nhập giá lẻ..." required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Đơn giá nhập</label>
                                            <input id="nhapEdit" type="text" class="form-control is-warning" name="product_nhap" placeholder="Nhập giá nhập..." required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Số lượng nhập</label>
                                            <input id="quantityEdit" type="text" class="form-control is-warning" name="product_quantity" placeholder="Nhập số lượng sản phẩm nhập kho..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-4">
                                      <div class="form-group">
                                        <label class="col-form-label" for="exampleInputFile">Ngày sản xuất MFG</label>
                                          <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                              <input id="mfgEdit" name="product_mfg"  placeholder="Nhập tháng/ ngày/ năm sản xuất của sản phẩm." type="text" class="form-control datetimepicker-input" data-target="#reservationdate3"/>
                                              <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <div class="form-group">
                                        <label class="col-form-label" for="exampleInputFile">Ngày hết hạn EXP</label>
                                          <div class="input-group date" id="reservationdate4" data-target-input="nearest">
                                              <input id="expEdit" name="product_exp"  placeholder="Nhập tháng/ ngày/ năm hết hạn sử dụng của sản phẩm." type="text" class="form-control datetimepicker-input" data-target="#reservationdate4"/>
                                              <div class="input-group-append" data-target="#reservationdate4" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="exampleInputFile">Sản phẩm nổi bật</label>
                                            <select id="noibatEdit" name="product_noibat" class="form-control is-warning">
                                                <option value="0">Không</option>
                                                <option value="1">Có</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Tags</label><br>
                                            
                                                     <input id="tagsEdit" type="text" class="form-control is-warning" name="product_tags" placeholder="Nhập tags, các tags cách nhau dấu phẩy (,)">
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Tài liệu hiện tại của sản phẩm</label>
                                            <input id="fileEdit" type="text" class="form-control is-warning" name="product_file">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Cập nhật lại tài liệu kèm theo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="product_file" type="file" class="custom-file-input" id="customFileFile1" />
                                                    <label class="custom-file-label" for="customFileFile1">Chọn tệp tài liệu đính kèm</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Hình ảnh sản phẩm 1.000x1.000px</label>
                                            <div>
                                                <img style="width: 100px; align-items: center;" id="imageEdit" src="#">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="exampleInputFile">Cập nhật lại hình ảnh sản phẩm 1.000x1.000px</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="product_image" type="file" class="custom-file-input" id="customFile" />
                                                    <label class="custom-file-label" for="customFile">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="update_product" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

@endsection
