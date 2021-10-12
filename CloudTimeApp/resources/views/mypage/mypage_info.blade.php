@extends('layouts.ctc')

@section('nav_title','プロフィール')

@section('content')

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div>

	<div>
		<img src="{{$user_data->profile_pic}}" width="200" height="200">
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


</style>

@endsection
	