<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @foreach ($chapters as $chapter)
        <a href="/library/{{$chapter->model->id}}">Back to book details.</a>
        <h3>
            Chapter Title: {{$chapter->title}}
        </h3>
        @if ($chapter->model->category->file_type === \App\Models\Category::FILE_TYPE_TEXT)
            <div>
                {!!$chapter->content!!}
            </div>
        @else
            <iframe src="/storage/{{$chapter->content}}" frameborder="0" width="400" height="700"></iframe>
        @endif
    @endforeach
    {{$chapters->links()}}
</body>
</html>
