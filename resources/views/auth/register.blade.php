<x-guest-layout>
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full"
                src="{{ asset('images/create-account-office.jpeg') }}" alt="Office" />
        </div>

        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700">
                    Create account
                </h1>

                <x-auth-validation-errors :errors="$errors" />

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4">
                        <x-label for="name" :value="__('Name')" />
                        <x-input type="text" id="name" name="name" class="block w-full" value="{{ old('name') }}"
                            required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="username" :value="__('Username')" />
                        <x-input name="username" type="text" class="block w-full" value="{{ old('username') }}" />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
                        <x-input name="email" type="email" class="block w-full" value="{{ old('email') }}" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />
                        <x-input type="password" name="password" class="block w-full" required />
                    </div>

                    <div class="mt-4">
                        <x-label id="password_confirmation" :value="__('Confirm Password')" />
                        <x-input type="password" name="password_confirmation" class="block w-full" required />
                    </div>


                    <div class="mt-4">
                        <x-label id="zip" :value="__('Zip')" />
                        <x-input type="text" name="zip" class="block w-full" required />
                    </div>


                    <div class="mt-4">
                        <x-label id="address" :value="__('Address')" />
                        <x-input type="text" name="address" class="block w-full" required />
                    </div>

                    <div class="mt-4">
                        <x-label id="state" :value="__('State')" />
                        <x-input type="text" name="state" class="block w-full" required />
                    </div>
                    <div class="mt-4">
                        <x-label id="city" :value="__('City')" />
                        <x-input type="text" name="city" class="block w-full" required />
                    </div>
                    <div class="mt-4">
                        <x-label id="country" :value="__('Country')" />
                        <x-input type="text" name="country" class="block w-full" required />
                    </div>

                    <div class="mt-3">
                        <p>Photo:</p>
                        <input name="photo" type="file" accept="image/png, image/jpeg, image/jpg">
                    </div>
                    <div class="mt-3">
                        <p>Front ID:</p>
                        <input name="front" type="file" accept="image/png, image/jpeg, image/jpg">
                    </div>
                    <div class="mt-3 ">
                        <p>Back ID:</p>
                        <input name="back" type="file" accept="image/png, image/jpeg, image/jpg">
                    </div>

                    <div class="mt-4">
                        <x-button class="block w-full">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>

                <p class="mt-4">
                    <a class="text-sm font-medium text-primary-600 hover:underline" href="{{ route('login') }}">
                        {{ __('Login') }}
                    </a>
                </p>

                <hr class="my-8" />

                <p class="mt-4">
                    <a class="text-sm font-medium text-primary-600 hover:underline"
                        href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                </p>
            </div>
        </div>
</x-guest-layout>