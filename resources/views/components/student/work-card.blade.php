@props(['model' => null, 'url' => null])
@if (! is_null($model))
    <div class="mx-4" x-data="{}"
    x-on:click="
        ()=>{
            Modal.open({
                @if ($url == null)
                ajaxContent:'{{route($model->getStudentLinks('show'), ['work' => $model->id])}}',
                @else
                ajaxContent:'{{$url}}',
                @endif
                draggable:true,
                width:'70%',
                hideclose: true,
            })
        }
        ">
        <div style="height:200px; background:url('{{$model->artFile ? optional($model->artFile)->withWatermark() : optional($model->cover)->withFrame()}}');background-position:center;background-size:contain;background-repeat:no-repeat;" class="shadow work-card  border w-36">
        </div>
        <div class="text-sm text-center">{{$model->title}}</div>
    </div>
@endif
