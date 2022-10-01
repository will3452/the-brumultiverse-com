@props(['time'=>'', 'model' => null])
<a class=" bg-gray-300 shadow-lg border rounded p-4 flex block mt-1 text-dark" href="{{route('scholar.notification.mark-as-read', ['id' => $model->id])}}">
    @if ($model->read_at === null)
        <span class="badge-xs badge badge-primary animate-pulse"></span>
    @endif
    <div class="flex-none w-10 h-10 rounded-full flex items-center justify-center">
        <img src="/img/icons/dashboard/bell.svg" alt="">
    </div>
    <div class="ml-4">
        <div class="text-sm text-gray-900 ">
            {{$slot}}
        </div>
        <div class="text-xs text-gray-900 font-bold">
            {{$time ?? ''}}
        </div>
    </div>
</a>
