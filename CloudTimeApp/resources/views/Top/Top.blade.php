<html>
<head>
    <title>top</title>
    <link rel="stylesheet" href="css/genki.css">
</head>
<body>
    <h1>トップ</h1>
    @for($i=0; $i<$count; $i++)
        <a href="/capsule/{{$capsule_data[$i]->capsule->id}}">{{ $capsule_data[$i]->capsule->name }}</a><br>
    @endfor

        <a href="capsule_entry" class="btn btn--orange btn--circle btn--circle-a btn--shadow">➕</a>
</body>
</html>