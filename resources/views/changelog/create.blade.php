<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create changelog</title>
</head>
<body>
    <form action="/changelog" method="POST">
        @csrf
        <div>
            <div for="">Title</div>
            <input type="text" name="title" required>
        </div>
        <div>
            <div for="">Description</div>

            <textarea name="description" id="" cols="30" rows="10"></textarea>
        </div>
        <button>log</button>
    </form>
</body>
</html>
