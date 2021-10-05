@extends('layouts.ctc')

@section('nav_title','トップ')

@section('content')
<head>
    <link rel="stylesheet" href="css/genki.css">
</head>

<div>

    @for($i=0; $i<$count; $i++)
        <a href="/capsule_info/{{$capsule_data[$i]->capsule->id}}">
            <div class="card p-2">
        
                {{ $capsule_data[$i]->capsule->name }}
            </div>
        </a>
        <br>
    @endfor
    <a href="capsule_entry" class="btn btn--orange btn--circle btn--circle-a btn--shadow">＋</a>

</div>


@endsection