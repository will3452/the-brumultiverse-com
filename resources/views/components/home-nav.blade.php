<nav class="md:flex bg-black items-center justify-center md:justify-between shadow">
    <img id="logo" onclick="logoClick()" src="/bru_assets/textlogo.png" alt="text logo" class="mx-auto md:mx-0" style="width:300px;">
    <script>
        let click = 0;
        function logoClick() {
            click ++;
            if (click === 3) {
                window.location.href = `{{Nova::path()}}`;
            }
        }
    </script>
    <ul class="text-white md:flex items-center relative" x-data="{show:true}">
        <template x-if="show">
            <div class="text-white md:flex items-center relative">
                <x-home-nav-link href="/" :isActive="url()->current() === route('welcome')">
                    Home
                </x-home-nav-link>
                <x-home-nav-link href="/about" :isActive="url()->current() === route('about')">
                    About
                </x-home-nav-link>
                <x-home-nav-link href="/contact" :isActive="url()->current() === route('contact')">
                    Contact Us
                </x-home-nav-link>
                <x-home-nav-link href="{{route('scholar.register')}}" :isActive=" url()->current() === route('scholar.register')">
                    Sign Up
                </x-home-nav-link>
                <x-home-nav-link href="{{route('scholar.login')}}" :isActive="url()->current() === route('scholar.login')">
                    Sign In
                </x-home-nav-link>
            </div>
        </template>
        <button x-on:click="show = ! show" class="block md:hidden cursor-pointer bg-white border-4 border-black rounded-full rotate-90 absolute -bottom-4 right-3">
            <img src="/img/icons/crud/switch_up_down.svg" class="w-8 h-8" alt="">
        </button>
    </ul>
</nav>

<x-vendor.alpinejs/>
