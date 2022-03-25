<x-scholar.layout>
    <x-scholar.page.title>
        Bulletin
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.bulletin.index'),
                    'label' => 'Bulletins',
                ],
                [
                    'href' => '#',
                    'label' => 'details',
                ]
            ]
        "
    />
    @if ($bulletin->notSaved())
        <form
        enctype="multipart/form-data"
        action="{{route('scholar.bulletin.update', ['bulletin' => $bulletin->id])}}"
        method="POST">
    @endif
        @method('PUT')
        @csrf
        <x-scholar.form.select name="package_id" label="Duration">
            @foreach ($packages as $p)
                <option {{$p->id === $bulletin->package_id ? 'selected':''}} value="{{$p->id}}">
                    {{$p->name}}
                </option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.input type="date" value="{{$bulletin->scheduled_at->format('Y-m-d')}}" name="scheduled_at" label="Schedule" help="Schedule must be 14 days from date of creation." />

        <x-scholar.form.input name="headline" label="Headline" value="{{$bulletin->headline}}" />

        <x-scholar.form.ckeditor name="content" label="Content">{{$bulletin->content}}</x-scholar.form.ckeditor>
        @if ($bulletin->notSaved())
{{--
        <x-scholar.form.file name="file" label="Upload image for the actual bulletin post."/> --}}
        <x-scholar.form.submit>
            Update
        </x-scholar.form.submit>
    </form>
    @endif

    <div class="mt-4">
        <x-scholar.marketing.contract :model="$bulletin" type="Bulletin" />
    </div>
    @if (! $bulletin->wasPaid())
        <div class="mt-4">
            <x-scholar.marketing.payment :model="$bulletin" type="Bulletin" description="Marketing - Bulletin" />
        </div>
    @endif

        <div class="mt-4">
            <x-scholar.marketing.timeline/>
            @if ($bulletin->wasPaid() && $bulletin->notSaved())
                <form action="{{route('scholar.marketing.save')}}" class="mt-2" method="POST">
                    @csrf
                    <input type="hidden" value="Bulletin" name="type">
                    <input type="hidden" value="{{$bulletin->id}}" name="id">
                    <x-scholar.form.submit>
                        Save Now
                    </x-scholar.form.submit>
                </form>
            @endif
        </div>
    @push('head-script')
        <x-vendor.ckeditor/>
    @endpush
</x-scholar.layout>
