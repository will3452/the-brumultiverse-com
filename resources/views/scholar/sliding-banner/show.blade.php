<x-scholar.layout>
    <x-scholar.page.title>
        Sliding Banner
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.sliding-banner.index'),
                    'label' => 'Sliding Banner',
                ],
                [
                    'href' => '#',
                    'label' => 'details',
                ]
            ]
        "
    />
    @if ($slidingBanner->notSaved())
        <form
        enctype="multipart/form-data"
        action="{{route('scholar.sliding-banner.update', ['slidingBanner' => $slidingBanner->id])}}"
        method="POST">
    @endif
        @method('PUT')
        @csrf
        <x-scholar.form.select name="package_id" label="Duration">
            @foreach ($packages as $p)
                <option {{$p->id === $slidingBanner->package_id ? 'selected':''}} value="{{$p->id}}">
                    {{$p->name}}
                </option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.input type="date" value="{{$slidingBanner->scheduled_at->format('Y-m-d')}}" name="scheduled_at" label="Schedule" help="Schedule must be 14 days from date of creation." />

        <img src="{{$slidingBanner->media()->first()->getSize(300, 150)}}" class="my-2 mb-4" alt="">

        @if ($slidingBanner->notSaved())
{{--
        <x-scholar.form.file name="file" label="Upload image for the actual slidingBanner post."/> --}}
        <x-scholar.form.submit>
            Update
        </x-scholar.form.submit>
    </form>
    @endif

    <div class="mt-4">
        <x-scholar.marketing.contract :model="$slidingBanner" type="SlidingBanner" />
    </div>
    @if (! $slidingBanner->wasPaid())
        <div class="mt-4">
            <x-scholar.marketing.payment :model="$slidingBanner" type="SlidingBanner" description="Marketing - Sliding Banner" />
        </div>
    @endif

        <div class="mt-4">
            <x-scholar.marketing.timeline/>
            @if ($slidingBanner->wasPaid() && $slidingBanner->notSaved())
                <form action="{{route('scholar.marketing.save')}}" class="mt-2" method="POST">
                    @csrf
                    <input type="hidden" value="Sliding Banner" name="type">
                    <input type="hidden" value="{{$slidingBanner->id}}" name="id">
                    <x-scholar.form.submit>
                        Save Now
                    </x-scholar.form.submit>
                </form>
            @endif
        </div>
</x-scholar.layout>
