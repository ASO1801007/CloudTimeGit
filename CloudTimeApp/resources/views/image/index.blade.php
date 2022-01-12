@extends('layouts.ctc')

@section('back_button')
<a class="navbar-brand" href="">＜</a>
@endsection

@section('nav_title','カプセル開封')

@section('content')

<div id ="photo" class="photo" style ="display:none;">
    @if( $open_flg == 1)
        @foreach($images as $image)
            <div>
                {{$image->title}} <br>
                <a href="{{ $image->image }}" data-lightbox="group"><img src="{{ $image->image }}" style="width: 30%; height: auto;"/></a>
            </div>
        @endforeach
    @endif
</div>

<div id="letter" class="letter" style ="display:none;">
    @if( $open_flg == 1)
        @foreach($letters as $letter)
            <div>
                {{$letter->title}} {{$letter->created_at}} <br>
                <img src="/image/letter_back.jpg">
                <p>{{$letter->text}}</p>
            </div>
        @endforeach
    @endif
</div>

@endsection

<script>

window.onload = function(){
    if( {{$genzaiti}} == 1){
        var select = confirm("開封地点から離れているようですが、開封してよろしいですか？");
        document.getElementById('photo').style.display = "block";
        document.getElementById('letter').style.display = "block";
        if( select == false){
            location.href = "/top";
        }
    }else{
        document.getElementById('photo').style.display = "block";
        document.getElementById('letter').style.display = "block";
    }
}
</script>

<style>
.photo {
    margin-top: 5px;
}

.letter {
  position: relative;
  margin-top: 5px;
  }

.letter p {
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%,-50%);
  -webkit-transform: translate(-50%,-50%);
  transform: translate(-50%,-50%);
  margin:0;
  padding:0;
  color: black;
  font-family :Quicksand, sans-serif;
  }

.letter img {
  width: 100%;
  }
</style>