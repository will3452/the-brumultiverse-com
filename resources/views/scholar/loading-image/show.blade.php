<x-scholar.layout>
    <x-scholar.page.title>
        Loading Image
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholars.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.loading-image.index'),
                    'label' => 'Loading Image',
                ],
                [
                    'href' => '#',
                    'label' => 'details',
                ]
            ]
        "
    />
    @if ($loadingImage->notSaved())
        <form
        enctype="multipart/form-data"
        action="{{route('scholars.loading-image.update', ['loadingImage' => $loadingImage->id])}}"
        method="POST">
    @endif
        @method('PUT')
        @csrf
        <x-scholar.form.select name="package_id" label="Duration">
            @foreach ($packages as $p)
                <option {{$p->id === $loadingImage->package_id ? 'selected':''}} value="{{$p->id}}">
                    {{$p->name}}
                </option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.input type="date" value="{{$loadingImage->scheduled_at->format('Y-m-d')}}" name="scheduled_at" label="Schedule" help="Schedule must be 14 days from date of creation." />

        <img src="{{$loadingImage->media()->first()->getSize(300, 150)}}" class="my-2 mb-4" alt="">

        @if ($loadingImage->notSaved())
{{--
        <x-scholar.form.file name="file" label="Upload image for the actual loadingImage post."/> --}}
        <x-scholar.form.submit>
            Update
        </x-scholar.form.submit>
    </form>
    @endif

    <div class="mt-4">
        <x-scholar.marketing.contract :model="$loadingImage" type="LoadingImage" />
    </div>
    @if (! $loadingImage->wasPaid())
        <div class="mt-4">
            <x-scholar.marketing.payment :model="$loadingImage" type="LoadingImage" description="Marketing - Loading Image" />
        </div>
    @endif

        <div class="mt-4">
            <x-scholar.marketing.timeline/>
            @if ($loadingImage->wasPaid() && $loadingImage->notSaved())
                <form action="{{route('scholars.marketing.save')}}" class="mt-2" method="POST">
                    @csrf
                    <input type="hidden" value="LoadingImage" name="type">
                    <input type="hidden" value="{{$loadingImage->id}}" name="id">
                    <x-scholar.form.submit>
                        Save Now
                    </x-scholar.form.submit>
                </form>
            @endif
        </div>
</x-scholar.layout>
