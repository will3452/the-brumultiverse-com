<x-scholar.layout>
    <x-scholar.page.title>
        Marquee
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.marquee.index'),
                    'label' => 'Marquee',
                ],
                [
                    'href' => '#',
                    'label' => 'details',
                ]
            ]
        "
    />
    @if ($marquee->notSaved())
        <form
        enctype="multipart/form-data"
        action="{{route('scholars.marquee.update', ['marquee' => $marquee->id])}}"
        method="POST">
    @endif
        @method('PUT')
        @csrf
        <x-scholar.form.select name="package_id" label="Duration">
            @foreach ($packages as $p)
                <option {{$p->id === $marquee->package_id ? 'selected':''}} value="{{$p->id}}">
                    {{$p->name}}
                </option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.input type="date" value="{{$marquee->scheduled_at->format('Y-m-d')}}" name="scheduled_at" label="Schedule" help="Schedule must be 14 days from date of creation." />
        <x-scholar.form.ckeditor name="content" label="Content">{{$marquee->content}}</x-scholar.form.ckeditor>
        @if ($marquee->notSaved())
{{--
        <x-scholar.form.file name="file" label="Upload image for the actual marquee post."/> --}}
        <x-scholar.form.submit>
            Update
        </x-scholar.form.submit>
    </form>
    @endif

    <div class="mt-4">
        <x-scholar.marketing.contract :model="$marquee" type="Marquee" />
    </div>
    @if (! $marquee->wasPaid())
        <div class="mt-4">
            <x-scholar.marketing.payment :model="$marquee" type="Marquee" description="Marketing - Marquee" />
        </div>
    @endif

        <div class="mt-4">
            <x-scholar.marketing.timeline/>
            @if ($marquee->wasPaid() && $marquee->notSaved())
                <form action="{{route('scholars.marketing.save')}}" class="mt-2" method="POST">
                    @csrf
                    <input type="hidden" value="Marquee" name="type">
                    <input type="hidden" value="{{$marquee->id}}" name="id">
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
