<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" placeholder="Phone Number" pattern="[0-9]{9,13}" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <div class="row mt-4">
            <div class="col">
                    <label for="province">Province</label>
                    <select class="form-control" id="province" name="province" onchange="updateCityList()" required>
                        <option value="">Select Province</option>
                        @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="col">
                <label for="city">City</label>
                <select class="form-control" id="city" name="city" required>
                    <option value="" >Select City</option>
                    
                    @foreach ($cities as $city)
                    <option value="{{ $city->id }}" >{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

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
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        function updateCityList() {
            var provinceId = document.getElementById("province").value;
            var cityList = document.getElementById("city");
            cityList.innerHTML = '<option value="" disabled selected>Pilih Sub Kategori</option>';

            @foreach ($cities as $city)
                if ({{ $city->province_id }} == provinceId) {
                    var option = document.createElement("option");
                    option.value = "{{ $city->id }}";
                    option.text = "{{ $city->name }}";
                    cityList.add(option);
                }
            @endforeach

        }
    </script>
</x-guest-layout>
