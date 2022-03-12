<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <input type="search" name="keyword" id="" placeholder="Search By Title">
        <button>search</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>
                    Published Date
                </th>
                <th>
                    Cover
                </th>
                <th>
                    Book Title
                </th>
                <th>
                    Author
                </th>
                <th>
                    Category
                </th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>
                        {{$book->published_at}}
                    </td>
                    <td>
                        <img style="width:70px; height:100px;" src="/storage/{{optional($book->cover)->path}}" alt="">
                    </td>
                    <td>
                        {{$book->title}}
                    </td>
                    <td>
                        {{$book->account->penname}}
                    </td>
                    <td>
                        {{$book->category->name}}
                    </td>
                    <td>
                        <a href="/library/{{$book->id}}">view details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
