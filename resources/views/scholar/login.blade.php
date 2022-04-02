<x-scholar.layout>
    <div class="flex justify-center">
        <form action="{{route('scholar.login')}}" method="POST" class="w-full md:w-4/12 sm:w-6/12 mt-4">
            <h1 class="text-2xl mb-4 uppercase font-bold">Login</h1>
            @if (session()->get('error'))
                <p class="font-bold text-red-600 text-xs text-center">
                    These credentials do not match our records.
                </p>
            @endif
            @csrf
            <x-scholar.form.input name="email" label="Email"/>
            <x-scholar.form.password name="password" label="Password"/>
            <x-scholar.form.submit extra="btn-block">
                Login
            </x-scholar.form.submit>
        </form>
    </div>
    <x-vendor.alpinejs/>
</x-scholar.layout>
