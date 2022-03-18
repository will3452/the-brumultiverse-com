@props(['disabled' => false])
<button {{$disabled ? 'disabled' : ''}} type="submit" class="btn">
    {{$slot}}
</button>
