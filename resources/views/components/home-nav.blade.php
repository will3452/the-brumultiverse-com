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
    <ul class="text-white md:flex items-center">
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
    </ul>
</nav>
