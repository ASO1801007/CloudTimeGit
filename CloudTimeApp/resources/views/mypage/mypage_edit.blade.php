@extends('layouts.ctc')

@section('nav_title','プロフィール編集')

@section('content')
<div>

<form action="{{ url('/mypage_update') }}" method="post" enctype="multipart/form-data">
	@csrf
	<p>
		写真：<br>
		<input type="file" name="profile_pic" value="{{ $user_data->profile_pic }}" accept=".png,.jpg,.jpeg,image/png,image/jpg">
	</p>
	<p>
		名前：<br>
		<input type="text" name="name" value="{{ $user_data->name }}">
	</p>
	<p>
		メール：<br>
		<input type="text" name="email" value="{{ $user_data->email }}">
	</p>
	<p>
		誕生日：<br>
		<input type="text" name="birthday" value="{{ $user_data->birthday }}">
	</p>
	<p>
		紹介：<br>
		<input type="text" name="intro" value="{{ $user_data->intro }}">
	</p>
	<p>
		場所：<br>
		<input type="text" name="location" value="{{ $user_data->location }}">
	</p>
	<p>
		職業：<br>
		<input type="text" name="job" value="{{ $user_data->job }}">
	</p>
	<p>
		高校：<br>
		<input type="text" name="high" value="{{ $user_data->high }}">
	</p>
	<p>
		中学：<br>
		<input type="text" name="junior_high" value="{{ $user_data->junior_high }}">
	</p>
	<p>
		小学：<br>
		<input type="text" name="elementary" value="{{ $user_data->elementary }}">
	</p>



	<button type="submit">更新</button>

</form>

</div>

@endsection