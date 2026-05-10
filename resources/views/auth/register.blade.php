<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">

        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" class="block mt-1 w-full"
                type="text" name="name"
                value="{{ old('name') }}"
                required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email"
                value="{{ old('email') }}"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" value="Address" />
            <x-text-input id="address" class="block mt-1 w-full"
                type="text" name="address"
                value="{{ old('address') }}"
                required />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Contact Number -->
        <div class="mt-4">
            <x-input-label for="contact_number" value="Contact Number" />
            <x-text-input id="contact_number" class="block mt-1 w-full"
                type="text" name="contact_number"
                value="{{ old('contact_number') }}"
                required />
            <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
        </div>

        <!-- Date of Birth -->
        <div class="mt-4">
            <x-input-label for="date_of_birth" value="Date of Birth" />
            <x-text-input id="date_of_birth" class="block mt-1 w-full"
                type="date" name="date_of_birth"
                value="{{ old('date_of_birth') }}"
                required />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" value="Role" />

            <select name="role"
                class="block mt-1 w-full border-gray-300 rounded-md"
                required>

                <option value="customer">

                    Customer

                </option>

                <option value="pharmacy">

                    Pharmacy

                </option>

            </select>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password"
                required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation"
                required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end mt-4">

            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}">

                Already registered?

            </a>

            <x-primary-button class="ms-4">

                Register

            </x-primary-button>

        </div>

    </form>

</x-guest-layout>