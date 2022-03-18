@props(['model'=>'','label' => '', 'name' => '', 'help' => '', 'required' => true, 'readonly' => false])
<div class="form-control w-full">
    <label class="label">
        <span class="label-text">
                {{$label}}
                @if ($required)
                <span class="text-red-600">
                    *
                </span>
            @endif
        </span>
    </label>
    <select
    x-model="{{$model}}"
    {{!$readonly ?:'disabled'}}
    class="select select-bordered @error($name) input-error @enderror"
    name="{{$name}}"
    @if($required)
        required
    @endif
    >
        {{$slot}}
    </select>
    <div class="label">
        <span class="label-text-alt">{{$help}}</span>
    </div>
    @error($name)
        <span class="text-red-300">{{$message}}</span>
    @enderror
</div>
