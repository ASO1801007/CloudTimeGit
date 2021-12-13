@extends('layouts.ctc')

@section('nav_title','プロフィール')

@section('content')

<div class="row">
	<div class="col-12 text-center" style="margin-top:120px;">
		<img src="{{$user_data->profile_pic}}" class="prf_img">
	</div>
	<div class="col-12 text-center mt-3">
		<div class="name_tag">{{ $user_data->name }}</div>
	</div>
	<div class="col-12 text-center mt-1">
		<div class="sub_tag">{{ $user_data->birthday }}</div>
		<div class="sub_tag">{{ $user_data->location }}・{{ $user_data->job }}</div>
	</div>
	<div class="col-12 text-center">
		<div class="introbox-top">
			<p>{{ $user_data->intro }}</p>
		</div>
	</div>
</div>
<hr>
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
	<hr>
@endif

<!-- 学歴カード -->

<div class="school_card card p-4">
	<div class="row">
		<div class="col-3 text-center">
			<i class="fa fa-2x fa-graduation-cap" aria-hidden="true"></i>
		</div>
		<div class="col-9">
			<h7>high school</h7>
			<h6>{{ $user_data->high }}</h6>
		</div>
		<div class="col-3"></div>
		<div class="col-9">
			<h7>junior high school</h7>
			<h6>{{ $user_data->junior_high }}</h6>
		</div>
		<div class="col-3"></div>
		<div class="col-9">
			<h7>elementary school</h7>
			<h6>{{ $user_data->elementary }}</h6>
		</div>
	</div>
</div>

<!-- 学歴カード -->



<div>

	<div>
		@if( $i_am_flag == 0 )
		<a href="/invitation/{{$user_data->id}}">
			<div class="btn-primary mt-2 p-3 text-center waves-effect" style="border-radius:15px;">
				カプセルに招待する
			</div>
		</a>
		@elseif( $i_am_flag == 1 )
		<div class="point_button">
			<a href="{{ url('/mypage_edit') }}" style="color:white;">
				<i class="fa fa-pencil" aria-hidden="true"></i>
			</a>
		</div>
		@endif
		<hr>
	</div>


</div>


<style>

body{
	background-image: url('/image/prf_{{$user_data->birth_type}}.jpg');
	background-repeat:no-repeat;
	background-size:contain;
	background-position:0% 6%;
}
.card{
	background-image: url('/image/scale_r.jpg');
	background-size:cover;
	color:white;
}
h7{
	font-size:13px;
}

.prf_img{
	border-radius: 50%;
	width=:100px;
	height:100px;
	border: 4px solid #ecefbc;
}
.name_tag{
	font-size:25px;
	color:#000000;
	font-weight:bold;
}
.sub_tag{
	font-size:15px;
	/* color:#AAAAAA; */
	color:#000000;
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
  background: #6da9a0;
  border-radius: 10px;
}
.introbox-top:before {
  content: "";
  position: absolute;
  top: -30px;
  left: 50%;
  margin-left: -15px;
  border: 15px solid transparent;
  border-bottom: 15px solid #6da9a0;
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

.point_button {
  position:fixed;
  bottom: 70px;
  right: 30px;
  transition:1s;
  border-radius:100px;
}



</style>

@endsection
	