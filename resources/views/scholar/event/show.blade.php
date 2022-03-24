<x-scholar.layout>
    @if ($event->status === \App\Models\Event::STATUS_DRAFT)
        <x-slot name="alert">
            <x-scholar.alert-warning>
                This event has not yet been submitted for approval.
            </x-scholar.alert-warning>
        </x-slot>
    @endif
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.event.index'),
                    'label' => 'Events',
                ],
                [
                    'href' => '#',
                    'label' => $event->title,
                ]
            ]
        "
    />
    <div class="flex md:flex-wrap flex-wrap-reverse">
        <div class="w-full md:w-8/12">
            <form action="{{route('scholar.event.update', ['event' => $event->id])}}" method="POST">
                @method('put')
                @csrf
                <x-scholar.form.input name="title" label="Event title" :value="$event->title"/>

                <x-scholar.form.ckeditor name="description" label="Event Description" help="Describe the event to lure the users in.">{{$event->description}}</x-scholar.form.ckeditor>

                <x-scholar.form.select name="account" label="Host">
                    @foreach ($accounts as $id=>$label)
                        <option value="{{$id}}" {{$id === $event->account_id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.input type="date" value="{{$event->start_date->format('Y-m-d')}}" name="start_date" label="From" help="Event should at least be {{nova_get_setting('event_day_away', 60)}} days away."/>

                <x-scholar.form.input type="date" value="{{$event->end_date->format('Y-m-d')}}" name="end_date" label="To"/>

                <x-scholar.form.submit>
                    Update
                </x-scholar.form.submit>

            </form>
        </div>
        {{-- second part --}}
        <div class="w-full md:w-4/12 p-4 flex justify-center">
            @if ($event->status != \App\Models\Event::STATUS_APPROVED)
            <x-scholar.modal button="request for approval" id="r2p">
                <form action="{{route('scholar.event.request-to-approve', ['event' => $event])}}" method="POST">
                    @csrf
                      <div class="label">
                          <div class="label-text">
                                Are you sure you want to run this action?
                          </div>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-sm btn-primary">
                            Yes
                        </button>
                        <label for="r2p" class="btn btn-secondary btn-sm">
                            No
                        </label>
                    </div>
                </form>
            </x-scholar.modal>
            @endif
        </div>
    </div>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
