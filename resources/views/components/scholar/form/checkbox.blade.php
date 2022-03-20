@props(['label' => '', 'name' => '', 'checked' => false])
<div class="form-control">
    <div class="flex">
        <div>
            <input value="1" {{!$checked ?:"checked"}} type="checkbox" name="{{$name}}" class="checkbox checkbox-md mr-2">
        </div>
        <div class="font-bold">
            {{$label}}
        </div>
    </div>
    @error($name)
        <span class="text-red-300">{{$message}}</span>
    @enderror
</div>
