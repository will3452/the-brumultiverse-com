@props(['label' => '', 'name' => '', 'help' => '', 'placeholder' => '', 'required' => false])
<div class="form-control w-full">
    <label class="label">
        <span class="label-text">{{$label}}</span>
    </label>
    <input
    name="{{$name}}"
    @if($required)
        required
    @endif
    type="text"
    placeholder="{{$placeholder ?? $label}}"
    class="input input-bordered w-full @error($name) input-error @enderror"
    >
    <div class="label">
        <span class="label-text-alt">{{$help}}</span>
    </div>
    @error($name)
        <span class="text-danger label-text-alt">{{$message}}</span>
    @enderror
</div>
