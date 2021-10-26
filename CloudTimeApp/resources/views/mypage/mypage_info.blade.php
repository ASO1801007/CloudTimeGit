@extends('layouts.ctc')

@section('nav_title','プロフィール')

@section('content')

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="row">
	<div class="col-12 text-center mt-5">
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
<div class="row">
	<div class="col-4 scholl_sq">高</div>
</div>

</div>

<hr>

<div>

	<div>
		<img src="{{$user_data->profile_pic}}" class="prf_img">
	</div>
	<div>
		<h5><b>名前 : </b>{{ $user_data->name }}</h5>
		<h5><b>メール : </b>{{ $user_data->email }}</h5>
		<h5><b>誕生日 : </b>{{ $user_data->birthday }}</h5>
		<h5><b>紹介 : </b>{{ $user_data->intro }}</h5>
		<h5><b>場所 : </b>{{ $user_data->location }}</h5>
		<h5><b>職業 : </b>{{ $user_data->job }}</h5>
		<h5><b>高校 : </b>{{ $user_data->high }}</h5>
		<h5><b>中学 : </b>{{ $user_data->junior_high }}</h5>
		<h5><b>小学 : </b>{{ $user_data->elementary }}</h5>
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
.prf_img{
	border-radius: 50%;
	width=:100px;
	height:100px;
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
.school_sq{
	
}



</style>

@endsection
	