<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Blog Yazısı</title>
</head>
<body>
    <h1>Yeni Blog Yazısı Yarat</h1>
    <form action="{{ route('blogs.store') }}" method="POST">
        @csrf
        <label for="title">Başlıq:</label>
        <input type="text" name="title" id="title" required>
        
        <label for="content">Məzmun:</label>
        <textarea name="content" id="content" required></textarea>
        
        <button type="submit">Yarat</button>
    </form>
</body>
</html>
