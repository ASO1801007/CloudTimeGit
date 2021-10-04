@extends('layouts.ctc')

@section('content')

<div>

	@if( strcmp($capsuleRow->thumbnail,'noImage.png') == 0)
	<div style="display: block; width: 100vw;">
		<img src="{{ asset('/sampleImage.png') }}" >
	</div>
	@else
	<img src="{{ asset('/storage/' . $capsuleRow->thumbnail ) }}">
	@endif


	<div><!-- カプセル名 -->
		{{$capsuleRow->name}}(id:{{$capsuleRow->id}})
	</div>
	<div><!-- 明ける日付 -->
		{{$capsuleRow->open_date_str}}
	</div>
	<div><!-- 概要 -->
		{{$capsuleRow->intro}}
	</div>



	<!-- 追加ボタンor開封ボタンの有無 -->

	@if( $open_flag == 1 )
	<div class="btn-warning p-2 text-center">
	<form method="POST" action="{{ route('image.index') }}">
		@csrf
		 	<input type = "hidden" name = "capsule_id" value = "{{$capsuleRow->id}}">
			<input type = "submit" name = "add" value="+">
			開封する
		</form>
	</div>
	@elseif( $open_flag == 0 )
	<div class="btn-primary p-1 text-center">
		<form method="POST" action="{{ route('image.index') }}">
		@csrf
		 	<input type = "hidden" name = "capsule_id" value = "{{$capsuleRow->id}}">
			<input type = "submit" name = "add" value="+">
			(＋)<br>
			写真を追加
		</form>
	</div>
	@else
	open_flagの値が適切ではありません。
	@endif

	<!-- 追加ボタンor開封ボタン -->

	チャット
	最近の投稿
	有光：おはよう！
	メンバー一覧

	<!-- カプセル破棄ボタンの有無 -->

	@if( $admin_flag == 1 )
	<div class="btn-danger p-2 text-center">
		タイムカプセルを破棄
	</div>
	@elseif( $admin_flag == 0 )
	<div class="btn-light p-2 text-center text-white">
		タイムカプセルを破棄
	</div>
	@else
	※admin_flagの値が適切ではありません。※
	@endif

	<!-- カプセル破棄ボタンの有無 -->
</div>


<style>


</style>

@endsection
	