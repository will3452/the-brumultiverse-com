@props(['model' => null])
@if (! is_null($model))
    <div class="mx-4 ">
        <div style="height:200px; background:url('{{$model->artFile ? optional($model->artFile)->withWatermark() : optional($model->cover)->withFrame()}}');background-position:center;background-size:contain;background-repeat:no-repeat;" class="shadow work-card  border w-36">
        </div>
        <div class="text-sm text-center">{{$model->title}}</div>
    </div>
@endif
