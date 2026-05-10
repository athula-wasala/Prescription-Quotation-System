<x-app-layout>

    <div class="p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">

                My Prescriptions

            </h1>

            <a
                href="{{ route('customer.prescriptions.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded">

                Upload Prescription

            </a>

        </div>

        @if(session('success'))

            <div class="mb-4 p-4 bg-green-100 rounded">

                {{ session('success') }}

            </div>

        @endif

        <div class="space-y-6">

            @forelse($prescriptions as $prescription)

                <div class="bg-white shadow rounded-lg p-6">

                    <!-- Prescription Info -->
                    <div class="mb-4">

                        <p>

                            <strong>Status:</strong>

                            {{ ucfirst($prescription->status) }}

                        </p>

                        <p>

                            <strong>Delivery Address:</strong>

                            {{ $prescription->delivery_address }}

                        </p>

                        <p>

                            <strong>Delivery Time:</strong>

                            {{ $prescription->delivery_time }}

                        </p>

                        @if($prescription->note)

                            <p>

                                <strong>Note:</strong>

                                {{ $prescription->note }}

                            </p>

                        @endif

                    </div>

                    <!-- Images -->
                    <div class="flex flex-wrap gap-4 mb-6">

                        @foreach($prescription->images as $image)

                            <img
                                src="{{ asset('storage/' . $image->image_path) }}"
                                class="w-32 h-32 object-cover rounded border">

                        @endforeach

                    </div>

                    <!-- Quotation -->
                    @if($prescription->quotation)

                        <div class="mt-6 border-t pt-6">

                            <h2 class="text-lg font-bold mb-4">

                                Quotation Details

                            </h2>

                            <table class="w-full mb-4">

                                <thead class="bg-gray-100">

                                    <tr>

                                        <th class="text-left p-3">

                                            Drug

                                        </th>

                                        <th class="text-left p-3">

                                            Quantity

                                        </th>

                                        <th class="text-left p-3">

                                            Unit Price

                                        </th>

                                        <th class="text-left p-3">

                                            Total

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach(
                                        $prescription
                                            ->quotation
                                            ->items
                                        as $item
                                    )

                                        <tr class="border-b">

                                            <td class="p-3">

                                                {{ $item->drug_name }}

                                            </td>

                                            <td class="p-3">

                                                {{ $item->quantity }}

                                            </td>

                                            <td class="p-3">

                                                Rs.
                                                {{ number_format($item->unit_price, 2) }}

                                            </td>

                                            <td class="p-3">

                                                Rs.
                                                {{ number_format($item->total_amount, 2) }}

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                            <div class="text-right">

                                <h2 class="text-xl font-bold">

                                    Grand Total:
                                    Rs.
                                    {{ number_format(
                                        $prescription
                                            ->quotation
                                            ->total_amount,
                                        2
                                    ) }}

                                </h2>

                            </div>

                            @if(
                                $prescription->quotation->status === 'pending'
                            )

                                <div class="mt-6 flex gap-4 justify-end">

                                    <!-- Accept -->
                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'customer.quotations.accept',
                                            $prescription->quotation
                                        ) }}">

                                        @csrf

                                        <button
                                            type="submit"
                                            class="bg-green-600 text-white px-4 py-2 rounded">

                                            Accept

                                        </button>

                                    </form>

                                    <!-- Reject -->
                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'customer.quotations.reject',
                                            $prescription->quotation
                                        ) }}">

                                        @csrf

                                        <button
                                            type="submit"
                                            class="bg-red-600 text-white px-4 py-2 rounded">

                                            Reject

                                        </button>

                                    </form>

                                </div>

                            @endif

                        </div>

                    @endif

                </div>

            @empty

                <div class="bg-white shadow rounded-lg p-6 text-center">

                    No prescriptions found.

                </div>

            @endforelse

        </div>

        <div class="mt-6">

            {{ $prescriptions->links() }}

        </div>

    </div>

</x-app-layout>