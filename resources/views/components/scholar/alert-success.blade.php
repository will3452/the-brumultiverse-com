@props(['fade' => true, 'id' => \Str::random(16)])
<div class="bg-green-300 text-green-900 p-2" id="{{$id}}">
    <div class="flex">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span class="ml-2">{{$slot}}</span>
    </div>
</div>
@if ($fade)
    @push('body-script')
    <script>
        window.onload = function () {
            setTimeout(() => {
                document.getElementById('{{$id}}').classList.add('hidden');
            }, 3000);
        }
    </script>
    @endpush
@endif
