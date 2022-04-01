@props(['title' => ''])
<div class="p-2 bg-yellow-200 flex text-yellow-900 text-xs mb-2">
    <div>
        <x-student.form.checkbox required="1"/>
    </div>
    <div>
        <span class="font-bold">{{$title}}</span>
        <p>
            {!!$slot!!}
        </p>
    </div>
</div>
