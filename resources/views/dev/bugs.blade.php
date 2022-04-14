<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bugs</title>
</head>
<body>
    @php
        $fixed = \App\Models\Bug::whereStatus(\App\Models\Bug::STATUS_FIXED)->count();
        $unfixed = \App\Models\Bug::whereStatus(\App\Models\Bug::STATUS_PENDING)->count();
    @endphp
    <div>
        {{-- progress rate: {{ number_format(($fixed / count($bugs)) * 100, 2) }} % --}}
    </div>
    <div>
        total: {{count($bugs)}} | remaining bugs: {{$unfixed}} | fixed: {{$fixed}}
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>
                    DATE
                </th>
                <th>
                    URI
                </th>
                <th>
                    PROBLEM/ISSUE
                </th>
                <th>
                    REPLACEMENT
                </th>
                <th>
                    STATUS
                </th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bugs as $b)
                <tr>
                    <td>
                        {{$b->created_at->format('d/m/y h:i:s')}}
                    </td>
                    <td>
                        {{$b->uri}}
                    </td>
                    <td>
                        {!!$b->problem!!}
                    </td>
                    <td>
                        {!!$b->replacement!!}
                    </td>
                    <td>
                        {{$b->status}}
                    </td>
                    <td >
                        @if ($b->status === \App\Models\Bug::STATUS_PENDING)
                        <div x-data="{
                            isHide:false,
                            id:{{$b->id}},
                            text:'Mark as Fix',
                            submit() {
                                this.text = 'loading ...';
                                fetch('/devs/bugs/' + this.id, {method:'POST', body:JSON.stringify({_token:`{{csrf_token()}}`}), headers: {
                                    'Content-type': 'application/json; charset=UTF-8'
                                }})
                                    .then(res=>this.isHide = true)
                            },
                        }">
                        <button x-show="! isHide" x-on:click="submit" x-text="text"></button>
                        </div>
                        @endif
                        @csrf
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-vendor.alpinejs/>
</body>
</html>
