<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
</head>
<body>
    <h1>Blog Yazıları</h1>
    <ul>
        @foreach ($blogs as $blog)
            <li>{{ $blog->title }}</li> 
        @endforeach
    </ul>
    <a href="{{ route('blogs.create') }}">Yeni Blog Yazısı Yarat</a>
</body>
</html>
