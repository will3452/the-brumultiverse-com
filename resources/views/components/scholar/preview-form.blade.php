@props(['model' => null, 'type' => 'Film'])
@if ( ! $model->hasPreview() )
<x-scholar.modal button="Upload Preview">
    <form action="{{route('scholar.upload.preview')}}" method="POST">
        @csrf
        <x-scholar.form.filepond  enable="button[type=submit]" name="file" label="Upload 30 seconds or less." :accept="$type === 'Film' ? 'video' : 'audio'"/>
        <input type="hidden" name="mediable_id" value="{{$model->id}}"/>
        <input type="hidden" name="mediable_type" value="{{get_class($model)}}"/>
        <x-scholar.form.submit :disabled="1">
            Submit
        </x-scholar.form.submit>
    </form>
</x-scholar.modal>
@endif
