<x-home-layout>
    <form
    class="bg-40 shadow p-8 max-w-login mx-auto md:w-4/12 mx-auto"
    method="POST"
    action="{{ route('nova.login') }}"
>
    {{ csrf_field() }}

    @if ($errors->any())
    <p class="text-center font-semibold text-danger my-3">
        @if ($errors->has('email'))
            {{ $errors->first('email') }}
        @else
            {{ $errors->first('password') }}
        @endif
        </p>
    @endif
    <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="email">{{ __('Email Address') }}</label>
        <input class="p-2 w-full text-black" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="password">{{ __('Password') }}</label>
        <input class="p-2 w-full text-black" id="password" type="password" name="password" required>
    </div>

    <div class="flex mb-6">
        <label class="flex items-center text-xl font-bold">
            <input class="" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <span class="text-base ml-2">{{ __('Remember Me') }}</span>
        </label>


        @if (\Laravel\Nova\Nova::resetsPasswords())
        <div class="ml-auto">
            <a class="text-primary dim font-bold no-underline" href="{{ route('nova.password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </div>
        @endif
    </div>

    <button class="bg-purple-900 text-white font-bold p-2 w-full uppercase" type="submit">
        {{ __('Login') }}
    </button>
</form>
</x-home-layout>
