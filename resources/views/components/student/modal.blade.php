@props(['id' => \Str::random(16), 'button' => 'open modal', 'extra' => '', 'noButton' => false])

<!-- The button to open modal -->
<div class="mt-4">
    @if ($noButton)
        <label for="{{$id}}">
            {{$trigger}}
        </label>
    @else
        <label for="{{$id}}" class="btn btn-scholar btn-sm {{$extra}} modal-button m-1">{{$button}}</label>
    @endif
</div>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="{{$id}}" class="modal-toggle">
<div class="modal">
    <div class="modal-box relative bg-black rounded-none">
        <label for="{{$id}}" class="absolute top-1 right-1">
            <img src="/img/icons/crud/x.svg" alt="" class="invert">
        </label>
        <div>
            {{$slot}}
        </div>
  </div>
</div>
