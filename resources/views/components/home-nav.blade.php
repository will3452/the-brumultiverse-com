<nav class="md:flex bg-black items-center justify-center md:justify-between shadow">
    <img src="/bru_assets/textlogo.png" alt="text logo" class="mx-auto md:mx-0" style="width:300px;">
    <ul class="text-white md:flex items-center">
        <x-home-nav-link href="/" :isActive="url()->current() === route('welcome')">
            Home
        </x-home-nav-link>
        <x-home-nav-link href="/about" :isActive="url()->current() === route('about')">
            About
        </x-home-nav-link>
        <x-home-nav-link href="/contact" :isActive="url()->current() === route('contact')">
            Contact
        </x-home-nav-link>
        <x-home-nav-link href="{{route('register.scholar')}}" :isActive="url()->current() === route('register.scholar') || url()->current() === route('register')">
            Sign Up
        </x-home-nav-link>
        <x-home-nav-link href="{{Nova::path()}}" :isActive="url()->current() === route('login')">
            Sign In
        </x-home-nav-link>
    </ul>
</nav>
