<x-app-layout>

    <div class="p-6 max-w-5xl mx-auto">

        <div class="mb-6">

            <h1 class="text-2xl font-bold">

                Create Quotation

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

        <!-- Prescription Details -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">

            <h2 class="text-lg font-semibold mb-4">

                Prescription Details

            </h2>

            <p>

                <strong>Customer:</strong>

                {{ $prescription->user->name }}

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

        <!-- Quotation Form -->
        <form
            method="POST"
            action="{{ route('pharmacy.quotations.store', $prescription) }}">

            @csrf

            <div class="bg-white shadow rounded-lg p-6">

                <table class="w-full">

                    <thead class="border-b">

                        <tr>

                            <th class="text-left p-3">
                                Drug Name
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

                    <tbody id="quotation-items">

                        <tr class="border-b">

                            <td class="p-3">

                                <input
                                    type="text"
                                    name="drug_name[]"
                                    class="w-full rounded border-gray-300"
                                    required>

                            </td>

                            <td class="p-3">

                                <input
                                    type="number"
                                    name="quantity[]"
                                    class="quantity w-full rounded border-gray-300"
                                    min="1"
                                    value="1"
                                    required>

                            </td>

                            <td class="p-3">

                                <input
                                    type="number"
                                    step="0.01"
                                    name="unit_price[]"
                                    class="unit-price w-full rounded border-gray-300"
                                    min="0"
                                    value="0"
                                    required>

                            </td>

                            <td class="p-3">

                                <input
                                    type="text"
                                    class="row-total w-full rounded border-gray-300 bg-gray-100"
                                    value="0.00"
                                    readonly>

                            </td>

                        </tr>

                    </tbody>

                </table>

                <div class="mt-4">

                    <button
                        type="button"
                        id="add-row"
                        class="bg-blue-600 text-white px-4 py-2 rounded">

                        Add Drug

                    </button>

                </div>

                <div class="mt-6 text-right">

                    <h2 class="text-xl font-bold">

                        Grand Total:
                        Rs.
                        <span id="grand-total">

                            0.00

                        </span>

                    </h2>

                </div>

                <div class="mt-6">

                    <button
                        type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded">

                        Send Quotation

                    </button>

                </div>

            </div>

        </form>

    </div>

    <script>

        function calculateTotals()
        {
            let grandTotal = 0;

            document.querySelectorAll('#quotation-items tr')
                .forEach((row) => {

                    const quantity = parseFloat(
                        row.querySelector('.quantity').value
                    ) || 0;

                    const unitPrice = parseFloat(
                        row.querySelector('.unit-price').value
                    ) || 0;

                    const total = quantity * unitPrice;

                    row.querySelector('.row-total').value =
                        total.toFixed(2);

                    grandTotal += total;
                });

            document.getElementById('grand-total')
                .innerText = grandTotal.toFixed(2);
        }

        document.addEventListener(
            'input',
            calculateTotals
        );

        document.getElementById('add-row')
            .addEventListener('click', function () {

                const row = `
                    <tr class="border-b">

                        <td class="p-3">

                            <input
                                type="text"
                                name="drug_name[]"
                                class="w-full rounded border-gray-300"
                                required>

                        </td>

                        <td class="p-3">

                            <input
                                type="number"
                                name="quantity[]"
                                class="quantity w-full rounded border-gray-300"
                                min="1"
                                value="1"
                                required>

                        </td>

                        <td class="p-3">

                            <input
                                type="number"
                                step="0.01"
                                name="unit_price[]"
                                class="unit-price w-full rounded border-gray-300"
                                min="0"
                                value="0"
                                required>

                        </td>

                        <td class="p-3">

                            <input
                                type="text"
                                class="row-total w-full rounded border-gray-300 bg-gray-100"
                                value="0.00"
                                readonly>

                        </td>

                    </tr>
                `;

                document.getElementById('quotation-items')
                    .insertAdjacentHTML(
                        'beforeend',
                        row
                    );
            });

    </script>

</x-app-layout>