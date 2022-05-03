<div class="slider ">
    @for ($i = 1; $i < 5; $i++)
        <div style="background:url('/demo-carousel/{{$i}}.jpg')" class="flex justify-center items-center">
            <div class="flex justify-center items-center backdrop-filter backdrop-blur">
                <img src="/demo-carousel/{{$i}}.jpg" alt="" class="w-12 md:w-8/12 "  style=" margin:auto; height:350px;object-fit:cover;">
            </div>
        </div>
    @endfor
</div>
