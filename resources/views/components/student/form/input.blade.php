@props(['model' => '', 'id' => \Str::random(8), 'ref' => 'ref', 'label' => '', 'value'=> null, 'readonly' => false, 'name' => '', 'help' => '', 'placeholder' => '', 'required' => true, 'type' => 'text'])
<div class="form-control w-full">
    <label class="label -mb-2 -ml-1" for="{{$id}}">
        <span class="label-text text-white">
                {{$label}}
                @if ($required)
                    <span class="text-red-600">
                        *
                    </span>
                @else
                    <span class="text-sm">(optional)</span>
                @endif
        </span>
    </label>
    <input
    id="{{$id}}"
    x-ref="{{$ref}}"
    x-model="{{$model}}"
    value="{{$value ?? old($name)}}"
    name="{{$name}}"
    @if($required)
        required
    @endif
    type="{{$type}}"
    placeholder="{{$placeholder ?? $label}}"
    class="input text-black input-bordered input-sm rounded-none w-full @error($name) input-error @enderror"
    @if ($readonly)
        disabled
    @endif
    >
    <div class="label">
        <span class="label-text-alt">{!!$help!!}</span>
    </div>
    @error($name)
        <span class="text-red-600">{{$message}}</span>
    @enderror
</div>
