@props(['title' => '', 'href' => '#', 'proceedText' => 'ok', 'noOk' => false])
<div class="alert shadow-lg">
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      <div>
        <h3 class="font-bold">{{$title}}</h3>
        <div class="text-xs">{{$slot}}</div>
      </div>
    </div>
    @if (!$noOk)
        <div class="flex-none">
            <a href="{{$href}}" class="btn btn-sm">{{$proceedText}}</a>
      </div>
    @endif
  </div>
