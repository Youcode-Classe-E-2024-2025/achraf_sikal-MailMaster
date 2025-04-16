<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>

<body>
    <h2>{{ $title }}</h2>
    <div>{!! nl2br(e($content)) !!}</div>
</body>

</html>
