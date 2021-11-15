@extends('layouts.ctc')

@section('nav_title','プロフィール')

@section('content')

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="row">
	<div class="col-12 text-center" style="margin-top:150px;">
		<img src="{{$user_data->profile_pic}}" class="prf_img">
	</div>
	<div class="col-12 text-center mt-3">
		<div class="name_tag">{{ $user_data->name }}</div>
	</div>
	<div class="col-12 text-center mt-1">
		<div class="job_tag">{{ $user_data->location }}・{{ $user_data->job }}・21歳</div>
	</div>
	<div class="col-12 text-center">
		<div class="introbox-top">
			<p>{{ $user_data->intro }}</p>
		</div>
	</div>
</div>
<hr>
<div class="row text-center">
	<div class="col-4">高</div>
	<div class="col-4">中</div>
	<div class="col-4">小</div>
</div>

<hr>

<div class="row">
	<div class="col-4">
		<div class="sq_flame">
			<img src="{{ url('/image/scale_b.jpg') }}" />
			<p>{{ $user_data->high }}</p>	
		</div>
	</div>
	<div class="col-4">
		<div class="sq_flame">
			<img src="{{ url('/image/scale_g.jpg') }}" />
			<p>{{ $user_data->junior_high }}</p>	
		</div>
	</div>
	<div class="col-4">
		<div class="sq_flame">
			<img src="{{ url('/image/scale_r.jpg') }}" />
			<p>{{ $user_data->elementary }}</p>	
		</div>
	</div>
</div>

<div>

	<div>
		<h5><b>名前 : </b>{{ $user_data->name }}</h5>
		<h5><b>メール : </b>{{ $user_data->email }}</h5>
		<h5><b>誕生日 : </b>{{ $user_data->birthday }}</h5>
		<h5><b>場所 : </b>{{ $user_data->location }}</h5>
		<h5><b>職業 : </b>{{ $user_data->job }}</h5>
	</div>
	<div>
		<hr>
		@if( $i_am_flag == 0 )
		<p>このページはあなたのページではありません。(編集不可)</p>
		@elseif( $i_am_flag == 1 )
		<p>このページはあなたのページです。(編集可)</p>
		<a href="{{ url('/mypage_edit') }}">
			<h5>編集ボタン</h5>
		</a>
		@endif
		<hr>
	</div>


</div>


<style>

body{
	background-image: url('/image/prf_1.jpg');
	background-repeat:no-repeat;
	background-size:contain;
	background-position:0% 7%;
}

.prf_img{
	border-radius: 50%;
	width=:100px;
	height:100px;
	border: 4px solid #FFFFFF;
}
.name_tag{
	font-size:25px;
	font-weight:bold;
}
.job_tag{
	font-size:15px;
	color:#BBBBBB;
}
.introbox-top {
  position: relative;
  display: inline-block;
  margin: 1.5em 0;
  padding: 7px 10px;
  min-width: 120px;
  max-width: 100%;
  color: #555;
  font-size: 16px;
  background: #e0edff;
  border-radius: 10px;
}
.introbox-top:before {
  content: "";
  position: absolute;
  top: -30px;
  left: 50%;
  margin-left: -15px;
  border: 15px solid transparent;
  border-bottom: 15px solid #e0edff;
}
.introbox-top p {
  margin: 0;
  padding: 0;
}
.sq_flame {
  position: relative;
  }

.sq_flame p {
	color:white;
	position: absolute;
	top: 50%;
	left: 50%;
	-ms-transform: translate(-50%,-50%);
	-webkit-transform: translate(-50%,-50%);
	transform: translate(-50%,-50%);
	margin:0;
	padding:0;
	/*文字の装飾は省略*/
	}

.sq_flame img {
  width: 100%;
  }



</style>

@endsection
	