@props(['accept' => '', 'id' => \Str::random(), 'label' => '', 'name' => '', 'help' => '', 'placeholder' => '', 'required' => true])
<div>
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text">
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
        accept="{{$accept}}"
        name="{{$name}}"
        @if($required)
            required
        @endif
        type="file"
        placeholder="{{$placeholder ?? $label}}"
        class="w-full @error($name) input-error @enderror"
        >

        @error($name)
            <span class="text-red-600">{{$message}}</span>
        @enderror
        <div class="label">
            <span class="label-text-alt">{!!$help!!}</span>
        </div>
    <x-scholar.form.copyright-disclaimer/>
    </div>
</div>

<script>
    document.getElementById(`{{$id}}`).addEventListener('change', function(event){
        let file = event.target.files[0]
        if (file.size > 2048576) {
            alert('file must not be greater than 2mb.')
            document.getElementById(`{{$id}}`).value = ''
        }
    })
</script>
