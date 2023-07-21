<x-guest-layout>
    <form method="POST" action="/store-reset-password">
        @csrf @method('put')
        <p class="font-medium mb-3">
            {{__('You can update your password.')}}
        </p>
        <div class="text-danger mx-4">
            @if ($errors->count() > 0)
              @foreach ($errors->all() as $error)
                <li><b>{{$error}}</b></li>
              @endforeach
            @endif
        </div>
        
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="rounded bg-blue-500 hover:bg-blue-600 px-3 py-2 text-white">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
