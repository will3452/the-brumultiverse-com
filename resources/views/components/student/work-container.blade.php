@props(['title' => 'Untitled', 'id' => \Str::random(8)])
<h1 class="text-2xl text-left p-4 uppercase tracking-widest mt-4  backdrop-blur-sm">{!!$title!!}</h1>
<div class="">
    <div class="{{$id}} ml-4 ">
        {{$slot}}
    </div>
</div>
@push('head-script')
    <x-vendor.jsmodal/>
@endpush
@push('body-script')
    <script>
        $(document).ready(function(){
            $('.{{$id}}').slick({
                infinite: true,
                adaptiveHeight:true,
                slidesToScroll: 2,
                slidesToShow:5,
                variableWidth: true,
                arrows:false,
            });
        });
    </script>
@endpush
