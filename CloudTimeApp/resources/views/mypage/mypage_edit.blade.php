@extends('layouts.ctc')

@section('back_button')
<a class="navbar-brand" href="javascript:history.back();">＜</a>
@endsection

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
	<div class="row">
		<div class="col-12 text-center" style="margin-top:135px;">
			@if($user_data->profile_pic == "0")
				<img src="/noImage.png" class="prf_img">
			@else
				<img id="img_prv" src="{{$user_data->profile_pic}}" class="prf_img">
			@endif
			<input id="image" type="file" name="image" value="{{ $user_data->profile_pic }}" accept=".png,.jpg,.jpeg,image/png,image/jpg">
		</div>
		<i hidden class="fa fa-question-circle-o text-primary waves-effect" aria-hidden="true" data-toggle="modal" data-target="#helpPop"></i>
		<div class="col-12">
			<div class="md-form">
				<input type="text" id="name" name="name" size="50" maxlength="20" class="form-control" value="{{ $user_data->name }}">
				<label for="form1">名前</label>
			</div>
			<div class="md-form">
				<input type="text" id="birthday" name="birthday" size="50" maxlength="20" class="form-control" value="{{ $user_data->birthday }}">
				<label for="form2">誕生日</label>
			</div>
			<div class="md-form">
				<input type="text" id="location" name="location" size="50" maxlength="20" class="form-control" value="{{ $user_data->location }}">
				<label for="form3">場所</label>
			</div>
			<div class="md-form">
				<input type="text" id="job" name="job" size="50" maxlength="20" class="form-control" value="{{ $user_data->job }}">
				<label for="form4">職業</label>
			</div>
		</div>
		<div class="col-12">
			<!--Basic textarea-->
			<div class="md-form amber-textarea active-amber-textarea-2">
				<textarea id="form9" name="intro" class="md-textarea form-control" rows="3">{{ $user_data->intro }}</textarea>
				<label for="form9">自己紹介</label>
			</div>
			<!--Basic textarea-->
		</div>
	</div>
	


	<!-- 学歴カード -->

	<div class="row">
		<div class="col-12 mb-1">
			<div style="font-size:14px; color:#777777;">卒業した学校</div>
		</div>
		<div class="col-12">
			<div class="school_card card p-4">
				<div class="row">
					<div class="col-12">
						<div class="form-outline mb-4">
							<label class="form-label" for="high">高校</label>
							<input type="text" name="high" id="high" class="form-control" value="{{ $user_data->high }}" />
						</div>
					</div>
					<div class="col-12">
						<div class="form-outline mb-4">
							<label class="form-label" for="junior_high">中学校</label>
							<input type="text" name="junior_high" id="junior_high" class="form-control" value="{{ $user_data->junior_high }}" />
						</div>
					</div>
					<div class="col-12">
						<div class="form-outline mb-4">
							<label class="form-label" for="elementary">小学校</label>
							<input type="text" name="elementary" id="elementary" class="form-control" value="{{ $user_data->elementary }}" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 学歴カード -->
	<div class="row">
		<div class="col-12">
			<button type="submit" class="btn-primary btn-block p-3 mt-3" style="border-radius:15px;">更新</button>
		</div>
	</div>

</form>

</div>

<style>
body{
	background-image: url('/image/prf_{{$user_data->birth_type}}.jpg');
	background-repeat:no-repeat;
	background-size:contain;
	background-position:0% 5%;
}

.card{
	background-image: url('/image/scale_r.jpg');
	background-size:cover;
	color:white;
}

.prf_img{
	border-radius: 50%;
	width:100px;
	height:100px;
	border: 4px solid #ecefbc;
}

</style>

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