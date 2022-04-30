<x-scholar.layout>
    <x-scholar.page.title>
        Message Blast
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.message-blast.index'),
                    'label' => 'Message Blasts',
                ],
                [
                    'href' => '#',
                    'label' => 'details',
                ]
            ]
        "
    />
    @if ($messageBlast->notSaved())
        <form
        enctype="multipart/form-data"
        action="{{route('scholars.message-blast.update', ['messageBlast' => $messageBlast->id])}}"
        method="POST">
    @endif
        @method('PUT')
        @csrf
        <x-scholar.form.select name="package_id" label="Duration">
            @foreach ($packages as $p)
                <option {{$p->id === $messageBlast->package_id ? 'selected':''}} value="{{$p->id}}">
                    {{$p->name}}
                </option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.input type="date" value="{{$messageBlast->scheduled_at->format('Y-m-d')}}" name="scheduled_at" label="Schedule" help="Schedule must be 14 days from date of creation." />

        <div>
            @foreach ($messageBlast->getAllMessages() as $item)
                <div class="mb-2 border-4 border-dashed p-2 ">
                    <div>
                        <span class="font-bold">Subject: </span> {{$item->subject}}
                    </div>
                    <div>
                        <span class="font-bold">Message: </span> {{$item->messages}}
                    </div>
                </div>
            @endforeach
        </div>
       @if ($messageBlast->notSaved())
{{--
        <x-scholar.form.file name="file" label="Upload image for the actual messageBlast post."/> --}}
        <x-scholar.form.submit>
            Update
        </x-scholar.form.submit>
    </form>
    @endif

    <div class="mt-4">
        <x-scholar.marketing.contract :model="$messageBlast" type="MessageBlast" />
    </div>
    @if (! $messageBlast->wasPaid())
        <div class="mt-4">
            <x-scholar.marketing.payment :model="$messageBlast" type="MessageBlast" description="Marketing - Message Blast" />
        </div>
    @endif

        <div class="mt-4">
            <x-scholar.marketing.timeline/>
            @if ($messageBlast->wasPaid() && $messageBlast->notSaved())
                <form action="{{route('scholars.marketing.save')}}" class="mt-2" method="POST">
                    @csrf
                    <input type="hidden" value="Message Blast" name="type">
                    <input type="hidden" value="{{$messageBlast->id}}" name="id">
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
