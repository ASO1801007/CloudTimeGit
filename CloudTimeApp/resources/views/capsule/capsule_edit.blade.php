@extends('layouts.ctc')

@section('back_button')
<a class="navbar-brand" href="{{route('top.top')}}">＜</a>
@endsection

@section('nav_title','カプセルプロフィール編集')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
		<br>
		<ul type="sqare">
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
	<form action="{{ url('/capsule_update') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="hidden" name="id" value="{{ $data->id }}">

		<div class="card_before">
			タイムカプセルの情報を編集します。情報を再入力してください。<br><hr>
			<div class="">
				<div class="">
					<div class="md-form">
						<input type="text" id="name" name="name" size="50" maxlength="20" class="form-control" value="{{ $data->name }}">
						<label for="form1">名前を決める</label>
					</div>
				</div>

				<div class="">
					<div class="md-form amber-textarea active-amber-textarea-2">
						<textarea id="form2" name="intro" class="md-textarea form-control" rows="3">{{ $data->intro }}</textarea>
						<label for="form2">概要を書く</label>
					</div>
				</div>

				<div class="">
					<div class="md-form">
						<input type="text" id="open_date" name="open_date" size="50" maxlength="20" class="form-control" value="{{ $data->open_date }}">
						<label for="form3">開封日を決める</label>
					</div>
				</div>

				<div class="">
				<label for="form4">サムネイルを決める</label>
					<div class="md-form">
							<img id="img_prv" src="{{ $data->thumbnail }}" style="width:100%">
							<input type="file" id="image" name="thumbnail" size="50" maxlength="20" class="form-control" accept=".png,.jpg,.jpeg,image/png,image/jpg">
					</div>
				</div>

				<div class="">
					<button type="submit" class="btn btn-primary btn-block waves-effect">OK</button>
				</div>
			</div>



		</div>

	</form>
</div>


<style>

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
	