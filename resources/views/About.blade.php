<x-home-layout>
    <div class="text-center mt-4">
        <h2 class="uppercase text-3xl font-bold mb-8">
            About Us
        </h2>
    </div>
    <x-vspace>
        <x-about-banner-link image="/bru_assets/about/BRU.jpg" href="{{nova_get_setting('bru_link', '/')}}"></x-about-banner-link>
    </x-vspace>
    <x-vspace>
        <x-about-banner-link image="/bru_assets/about/BRUNIVERSITY.jpg" href="{{nova_get_setting('bruniversity_link', '/')}}"></x-about-banner-link>
    </x-vspace>
    <x-vspace>
        <x-about-banner-link image="/bru_assets/about/BRUNITY.jpg" href="/brunity"></x-about-banner-link>
    </x-vspace>
</x-home-layout>
