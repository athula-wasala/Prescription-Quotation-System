<x-app-layout>

    <div class="p-6 max-w-4xl mx-auto">

        <div class="mb-6">

            <h1 class="text-3xl font-bold">

                Upload Prescription

            </h1>

        </div>

        @if ($errors->any())

            <div class="mb-4 p-4 bg-red-100 rounded">

                <ul class="list-disc pl-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
            method="POST"
            action="{{ route('customer.prescriptions.store') }}"
            enctype="multipart/form-data"
            class="space-y-6">

            @csrf

            <!-- Delivery Address -->
            <div>

                <label class="block mb-2 font-medium">

                    Delivery Address

                </label>

                <textarea
                    name="delivery_address"
                    rows="3"
                    class="w-full rounded border-gray-300"
                    required>{{ old('delivery_address') }}</textarea>

            </div>

            <!-- Delivery Time -->
            <div>

                <label class="block mb-2 font-medium">

                    Delivery Time

                </label>

                <select
                    name="delivery_time"
                    class="w-full rounded border-gray-300"
                    required>

                    <option value="">

                        Select Delivery Time

                    </option>

                    <option value="08:00 - 10:00">

                        08:00 - 10:00

                    </option>

                    <option value="10:00 - 12:00">

                        10:00 - 12:00

                    </option>

                    <option value="12:00 - 14:00">

                        12:00 - 14:00

                    </option>

                    <option value="14:00 - 16:00">

                        14:00 - 16:00

                    </option>

                    <option value="16:00 - 18:00">

                        16:00 - 18:00

                    </option>

                    <option value="18:00 - 20:00">

                        18:00 - 20:00

                    </option>

                </select>

            </div>

            <!-- Note -->
            <div>

                <label class="block mb-2 font-medium">

                    Note

                </label>

                <textarea
                    name="note"
                    rows="4"
                    class="w-full rounded border-gray-300">{{ old('note') }}</textarea>

            </div>

            <!-- Images -->
            <div>

                <label class="block mb-2 font-medium">

                    Prescription Images

                </label>

                <input
                    type="file"
                    name="images[]"
                    multiple
                    accept="image/*"
                    class="w-full"
                    required>

                <p class="text-sm text-gray-500 mt-2">

                    Maximum 5 images allowed.

                </p>

            </div>

            <!-- Submit -->
            <div>

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">

                    Upload Prescription

                </button>

            </div>

        </form>

    </div>

</x-app-layout>