@props(['links'=>[]])
<div class="text-sm breadcrumbs">
    <ul>
        @foreach ($links as $link)
            <li>
                <a href="{{$link['href'] ?? '#'}}">
                    {{$link['label']}}
                </a>
            </li>
        @endforeach
    </ul>
</div>
{{--
    $links = [
        [
            'href' => 'www.sample.com',
            'label' => 'sample',
        ],
        [
            'href' => 'www.sample1.com',
            'label' => 'sample1'
        ]
    ]
--}}
