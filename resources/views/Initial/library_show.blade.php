<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/library">back</a>
    <table border="1">
        <tr>
            <th>
                Title
            </th>
            <td>
                {{$book->title}}
            </td>
        </tr>
        <tr>
            <th>
                Author
            </th>
            <td>
                {{$book->account->penname}}
            </td>
        </tr>
        <tr>
            <th>
                Category
            </th>
            <td>
                {{$book->category->name}}
            </td>

        </tr>
        <tr>
            <th>
                Lead Character
            </th>
            <td>
                {{$book->lead_character}}
            </td>
        </tr>
        <tr>
            <th>
                Lead College
            </th>
            <td>
                {{$book->lead_college}}
            </td>
        </tr>
        <tr>
            <th>
                Blurb
            </th>
            <td>
                {{$book->blurb}}
            </td>
        </tr>
        <tr>
            <th>
                Credits
            </th>
            <td>
                {{$book->credit}}
            </td>
        </tr>
        <tr>
            <th>
                Cover
            </th>
            <td>
                <img style="display:block;width:70px; height:100px;" src="/storage/{{optional($book->cover)->path}}" alt="cover photo of the book">
            </td>
        </tr>
        <tr>
            <th>
                Cost
            </th>
            <td>
                {{$book->cost}} {{$book->cost_type}}
            </td>
        </tr>
    </table>
    <a href="/library/{{$book->id}}/chapters">Read Now</a>
</body>
</html>
