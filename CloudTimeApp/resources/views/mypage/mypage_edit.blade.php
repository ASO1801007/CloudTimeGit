@extends('layouts.ctc')

@section('nav_title','プロフィール編集')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif


<head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<div>

<form action="{{ url('/mypage_update') }}" method="post" enctype="multipart/form-data">
	@csrf
	<p>
		写真：<br>
		<img id="img_prv" src="{{ $user_data->profile_pic }}" width="200" height="200"><br>
		<input id="image"type="file" name="image" value="{{ $user_data->profile_pic }}" accept=".png,.jpg,.jpeg,image/png,image/jpg">
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

<script>
//画像が選択される度に、この中の処理が走る
$('#image').on('change', function (ev) {
	//コンソールタブで適切に処理が動いているか確認
	console.log("image is changed");
	//このFileReaderが画像を読み込む上で大切
	const reader = new FileReader();
	//--ファイル名を取得
	const fileName = ev.target.files[0].name;
	//--画像が読み込まれた時の動作を記述
	reader.onload = function (ev) {
		$('#img_prv').attr('src', ev.target.result).css('width', '150px').css('height', '150px');
	}
	reader.readAsDataURL(this.files[0]);
})
</script>

@endsection