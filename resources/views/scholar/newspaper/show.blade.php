<x-scholar.layout>
    <x-scholar.page.title>
        Newspaper
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.newspaper.index'),
                    'label' => 'Newspapers',
                ],
                [
                    'href' => '#',
                    'label' => 'details',
                ]
            ]
        "
    />
    @if ($newspaper->notSaved())
        <form
        enctype="multipart/form-data"
        action="{{route('scholars.newspaper.update', ['newspaper' => $newspaper->id])}}"
        method="POST">
    @endif
        @method('PUT')
        @csrf
        <x-scholar.form.select name="package_id" label="Duration">
            @foreach ($packages as $p)
                <option {{$p->id === $newspaper->package_id ? 'selected':''}} value="{{$p->id}}">
                    {{$p->name}}
                </option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.input type="date" value="{{$newspaper->scheduled_at->format('Y-m-d')}}" name="scheduled_at" label="Schedule" help="Schedule must be 14 days from date of creation." />

        <x-scholar.form.input name="headline" label="Headline" value="{{$newspaper->headline}}" />

        <x-scholar.form.ckeditor name="content" label="Content">{{$newspaper->content}}</x-scholar.form.ckeditor>
        @if ($newspaper->notSaved())
{{--
        <x-scholar.form.file name="file" label="Upload image for the actual bulletin post."/> --}}
        <x-scholar.form.submit>
            Update
        </x-scholar.form.submit>
    </form>
    @endif

    <div class="mt-4">
        <x-scholar.marketing.contract :model="$newspaper" type="Newspaper" />
    </div>
    @if (! $newspaper->wasPaid())
        <div class="mt-4">
            <x-scholar.marketing.payment :model="$newspaper" type="Newspaper" description="Marketing - Newspaper" />
        </div>
    @endif

        <div class="mt-4">
            <x-scholar.marketing.timeline/>
            @if ($newspaper->wasPaid() && $newspaper->notSaved())
                <form action="{{route('scholars.marketing.save')}}" class="mt-2" method="POST">
                    @csrf
                    <input type="hidden" value="Newspaper" name="type">
                    <input type="hidden" value="{{$newspaper->id}}" name="id">
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
