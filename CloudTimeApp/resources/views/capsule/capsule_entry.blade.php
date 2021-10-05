@extends('layouts.ctc')

@section('nav_title','カプセルプロフィール設定')

@section('content')

<div>
	<form action="{{ url('/capsule_create') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}

		<div class="card_before">
			新しいタイムカプセルを作成します。情報を入力してください。<br><hr>
			<div class="">
				<div class="">
					<div class="md-form">
						<input type="text" id="form1" name="name" size="50" maxlength="20" class="form-control" value="新しいカプセル">
						<label for="form1">名前を決める</label>
					</div>
				</div>

				<div class="">
					<div class="md-form amber-textarea active-amber-textarea-2">
						<textarea id="form2" name="intro" class="md-textarea form-control" rows="3">説明</textarea>
						<label for="form2">概要を書く</label>
					</div>
				</div>

				<div class="">
					<div class="md-form">
						<input type="text" id="form3" name="open_date" size="50" maxlength="20" class="form-control" value="2021-12-31">
						<label for="form3">開封日を決める</label>
					</div>
				</div>

				<div class="">
					<div class="md-form">
						<input type="text" id="form3" name="thumbnail" size="50" maxlength="20" class="form-control" value="noImage.png">
						<label for="form3">カプセルの表紙を決める</label>
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

@endsection
	