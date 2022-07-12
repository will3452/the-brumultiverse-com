@props(['model' => null])
@if (! $model->tickets()->whereStatus(\App\Models\Ticket::STATUS_PENDING)->exists())
<div class="flex flex-col justify-center items-center">
    <div>
        <x-scholar.modal button="submit ticket" extra="btn-sm">
            <form action="{{route('scholar.ticket.store-update')}}" method="POST">
                @csrf
                <input type="hidden" name="_type" value="{{\App\Helpers\TicketHelper::getModel(get_class($model))}}">
                <input type="hidden" name="id" value="{{$model->id}}">
                <h1 class="text-center uppercase font-bold tracking-widest text-xl p-4 bg-scholar rounded-md">Submit Ticket</h1>
                @foreach ($model->ticketCanUpdate() as $item)

                    @if (in_array($item, ['description', 'blurb', 'credit', 'copyright', 'lyrics']))
                        <x-scholar.form.ckeditor name="{{$item}}" label="{{\Str::headline($item)}}">{{$model[$item]}}</x-scholar.form.ckeditor>
                    @elseif(in_array($item, ['title']))
                        <x-scholar.form.input name="{{$item}}" label="{{\Str::headline($item)}}" :value="$model[$item]"/>
                    @elseif (in_array($item, ['cost']))
                        <x-scholar.form.number name="{{$item}}" label="{{\Str::headline($item)}}" :value="$model[$item]" />
                    @elseif (in_array($item, ['type']))
                        <x-scholar.form.select name="{{$item}}" label="{{\Str::headline($item)}}" :value="$model[$item]">
                            @foreach (get_class($model)::TYPES as $t)
                                <option value="{{$t}}">
                                    {{$t}}
                                </option>
                            @endforeach
                        </x-scholar.form.select>
                    @endif

                @endforeach

                <x-scholar.form.ckeditor name="requestor_notes" label="Additional Notes"></x-scholar.form.ckeditor>

                <x-scholar.form.submit>
                    Submit
                </x-scholar.form.submit>
            </form>
            <x-vendor.ckeditor/>
        </x-scholar.modal>
    </div>
    <div>
        <x-scholar.modal button="Request to delete" extra="btn-sm">
            <form action="{{route('scholar.ticket.store-update')}}" method="POST">
                @csrf
                <input type="hidden" name="_type" value="{{\App\Helpers\TicketHelper::getModel(get_class($model))}}">
                <input type="hidden" name="id" value="{{$model->id}}">
                <input type="hidden" name="action" value="{{\App\Models\Ticket::ACTION_DELETE}}">
                <h1 class="text-center uppercase font-bold tracking-widest text-xl p-4 bg-scholar rounded-md">Request to delete</h1>
                <x-scholar.form.ckeditor name="requestor_notes" label="Reason/Additional notes"></x-scholar.form.ckeditor>
                <x-scholar.form.submit>
                    Submit
                </x-scholar.form.submit>
            </form>
            <x-vendor.ckeditor/>
        </x-scholar.modal>
    </div>
</div>
@else
    <div class="bg-yellow-200 p-2 mt-4 text-sm text-yellow-900">
        Your ticket has been sent, please wait for administrator approval.
    </div>
@endif
