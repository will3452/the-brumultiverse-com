@props(['editable' => true, 'updateLink' => '#'])
@if ($editable)
<form action="{{$updateLink}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
@endif
    <div>
        {{$slot}}
    </div>
@if ($editable)
<x-scholar.form.submit>
    Save Changes
</x-scholar.form.submit>
</form>
@endif
