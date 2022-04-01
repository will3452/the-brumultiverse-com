@props(['model' => null])
@if (! $model->tickets()->whereStatus(\App\Models\Ticket::STATUS_PENDING)->exists())
<x-scholar.modal button="submit ticket" extra="btn-sm">
    <form action="{{route('scholar.ticket.store-update')}}" method="POST">
        @csrf
        <input type="hidden" name="type" value="{{\App\Helpers\TicketHelper::getModel(get_class($model))}}">
        <input type="hidden" name="id" value="{{$model->id}}">
        <h1 class="text-center uppercase font-bold tracking-widest text-xl border-dashed border-2 p-4">Submit Ticket</h1>
        @foreach ($model->ticketCanUpdate() as $item)

            @if (in_array($item, ['description', 'blurb', 'credit', 'copyright', 'lyrics']))
                <x-scholar.form.ckeditor name="{{$item}}" label="{{\Str::headline($item)}}">{{$model[$item]}}</x-scholar.form.ckeditor>
            @elseif(in_array($item, ['title']))
                <x-scholar.form.input name="{{$item}}" label="{{\Str::headline($item)}}" :value="$model[$item]"/>
            @elseif (in_array($item, ['cost']))
                <x-scholar.form.number name="{{$item}}" label="{{\Str::headline($item)}}" :value="$model[$item]" />
            @endif

        @endforeach

        <x-scholar.form.ckeditor name="requestor_notes" label="Additional Notes"></x-scholar.form.ckeditor>

        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>
    </form>
    <x-vendor.ckeditor/>
</x-scholar.modal>
@else
    <div class="bg-yellow-200 p-2 mt-4 text-sm text-yellow-900">
        Your ticket has been sent, please wait for administrator approval.
    </div>
@endif