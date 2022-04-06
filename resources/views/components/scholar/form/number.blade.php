@props(['model' => '', 'id' => \Str::random(8), 'ref' => 'ref', 'label' => '', 'value'=> null, 'readonly' => false, 'name' => '', 'help' => '', 'placeholder' => '', 'required' => true, 'type' => 'number', 'min' => 0])

<div class="form-control w-full"
    x-data="{
        checkIfMin() {
            if (this.$refs.ref.value < {{$min}}) {
                this.$refs.ref.value = {{$min}};
            }
        }
    }"
>
    <label class="label" for="{{$id}}">
        <span class="label-text text-gray-900 dark:text-white">
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
    x-on:keyup="checkIfMin"
    x-on:change="checkIfMin"
    x-ref="{{$ref}}"
    x-model="{{$model}}"
    value="{{$value ?? old($name)}}"
    name="{{$name}}"
    @if($required)
        required
    @endif
    type="{{$type}}"
    placeholder="{{$placeholder ?? $label}}"
    class="input text-black input-bordered w-full @error($name) input-error @enderror"
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
