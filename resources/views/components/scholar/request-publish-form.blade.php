@props(['model' => null])
@if ($model->wasPublishedApproved())
    <div class="w-full flex-none mt-4 flex justify-center border-dashed border-2 p-4">
        <div class="text-center">
            <x-scholar.material-title icon="/img/icons/dashboard/calendar.svg" title="Published Date"/>
            <div>
                {{$model->published_at->format('m/d/Y')}}
            </div>
        </div>
    </div>
@else
<x-scholar.modal extra="btn-sm" button="request to publish">
    <div>
        @if (! $model->hasPendingPublishApproval() && ! $model->wasPublishedApproved())
            <form action="{{route('scholar.request.publish')}}" method="POST">
                <div class="bg-yellow-200 text-yellow-900 p-2 text-xs rounded">
                    Reminder: Editing other details of your work alone, is not possible, when it has a published date.
                </div>
                @csrf
                <input type="hidden" name="type" value="{{$model->modelType()}}">
                <input type="hidden" name="id" value="{{$model->id}}">
                <x-scholar.form.ckeditor name="notes" label="Notes" help="It's great if you put your wish date to publish your work."/>
                <x-scholar.form.submit>
                    Submit
                </x-scholar.form.submit>
            </form>
        @elseif($model->hasPendingPublishApproval())
            <div>
                You have submitted, and your request is processed.
            </div>
        @endif
    </div>
</x-scholar.modal>
@endif
