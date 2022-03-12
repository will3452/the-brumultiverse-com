@props(['id' => \Str::random(16), 'button' => 'open modal', 'extra' => ''])

<!-- The button to open modal -->
<label for="{{$id}}" class="btn {{$extra}} modal-button btm-sm m-1">{{$button}}</label>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="{{$id}}" class="modal-toggle">
<div class="modal">
  <div class="modal-box">
    {{$slot}}
    <div class="modal-action">
      <label for="{{$id}}" class="btn btn-sm">close</label>
    </div>
  </div>
</div>
