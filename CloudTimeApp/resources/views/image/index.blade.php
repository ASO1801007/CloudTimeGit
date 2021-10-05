@extends('layouts.ctc')

@section('nav_title','カプセルプロフィール')

@section('content')

@if( $open_flg == 1)
    @foreach($images as $image)
        <div>
            <img src="{{ $image->image }}" alt="image" style="width: 30%; height: auto;"/>
        </div>
    @endforeach
@endif

@endsection