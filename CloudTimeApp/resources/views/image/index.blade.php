@extends('layouts.ctc')

@section('back_button')
<a class="navbar-brand" href="">＜</a>
@endsection

@section('nav_title','カプセル開封')

@section('content')

<div id ="photo" class="photo" style ="display:none;">
    @if( $open_flg == 1)
        <div class="row">
            @foreach($images as $image)
                <div class="col-6 col-sm-4 mb-2">
                    <a href="{{ $image->image }}" data-lightbox="group" data-title="{{$image->title}}"><img src="{{ $image->image }}" style="width: 100%; height: 180px; object-fit: cover; border-radius:7px;"/></a>
                    <div style="color:black;">{{$image->title}}</div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div id="letter" class="letter" style ="display:none;">
    @if( $open_flg == 1)
        <div class="row">
            @foreach($letters as $letter)
                <div class="col-12 col-sm-6">
                    <div style="color:black;">{{$letter->title}}</div>
                    <img src="/image/letter_back.jpg">
                    <p>{{$letter->text}}</p>
                </div>
            @endforeach
        </div>
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