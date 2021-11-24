@extends('layouts.ctc')

@section('back_button')
<a class="navbar-brand" href="">＜</a>
@endsection

@section('nav_title','カプセル開封')

@section('content')

<div id ="xyz" style ="display:none;">
    @if( $open_flg == 1)
        @foreach($images as $image)
            <div>
                <img src="{{ $image->image }}" alt="image" style="width: 30%; height: auto;"/>
            </div>
        @endforeach
    @endif
</div>

@endsection

<script>

window.onload = function(){
    if( {{$genzaiti}} == 1){
        var select = confirm("開封地点から離れているようですが、開封してよろしいですか？");
        document.getElementById('xyz').style.display = "block";
        if( select == false){
            location.href = "/top";
        }
    }
}
</script>