@props(['label' => '', 'id'=> Str::random(8), 'name' => '', 'help' => '', 'placeholder' => '', 'required' => true])
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
    <textarea
    id="{{$id}}"
    name="{{$name}}"
    @if($required)
        required
    @endif
    placeholder="{{$placeholder ?? $label}}"
    class="input input-bordered w-full @error($name) input-error @enderror"
    >{{$slot ?? old($name)}}</textarea>
    <div class="label">
        <span class="label-text-alt">{{$help}}</span>
    </div>
    @error($name)
        <span class="text-red-300">{{$message}}</span>
    @enderror
</div>

@push('body-script')
    <script>
        CKEDITOR.replace( '{{$id}}', {
            customConfig: '/vendor/ckeditor/custom/basic_config.js'
        });
    </script>
@endpush
