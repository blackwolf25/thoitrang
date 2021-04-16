@extends('layout')
@section('contents')

<br>
<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            <li><a href="{{URL::to('/gio-hang')}}">Giỏ hàng</a></li>
                            <li><a href="{{URL::to('thanh-toan')}}">Thanh toán</a></li>
                            <li class="active">Hoàn thành</li>
                        </ul>
                    </div>
                </div>
            </div>
<div>
	<br>
	<div class="container">
		<style type="text/css">
			.congtacvien{
				text-align: center;
			}
		</style>

		<div class="congtacvien">
		<img width="100%" src="{{asset('public/uploads/images/website/camon.jpg')}}">
		</div>
		<br>
		<div class="congtacvien">
		     <a href="{{URL::to('/trang-chu')}}" class="btn btn-warning">VỀ TRANG CHỦ</a>
		</div>
	</div>
</div>
<br>
@endsection