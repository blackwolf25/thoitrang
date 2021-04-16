@extends('layout')
@section('contents')
<br>
<div>
	<div class="container">
		<style type="text/css">
			.congtacvien{
				text-align: center;
			}
		</style>
		<div class="congtacvien">
		<img src="{{asset('public/frontend/images/down.gif')}}">
		</div>
		<div class="congtacvien">
			<a href="{{URL::to('/admin')}}">
				<button style="color: black" type="submit" class="btn" id="mc-submit">CLICK CHUỘT VÀO ĐÂY ĐỂ VÀO HỆ THỐNG thoitrang</button>
			</a>
		</div>
	</div>
</div>
<br>
@endsection