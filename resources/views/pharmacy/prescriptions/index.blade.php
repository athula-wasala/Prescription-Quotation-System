<x-app-layout>

    <div class="p-6">

        <!-- TITLE -->
        <div class="mb-6">

            <h1 class="text-2xl font-bold">

                Prescription Management

            </h1>

        </div>

        <!-- FILTER (PDF REQUIREMENT) -->
        <div class="mb-6">

            <form method="GET"
                action="{{ route('pharmacy.prescriptions.index') }}"
                class="flex gap-4 items-center">

                <select name="status"
                    class="border rounded px-3 py-2"
                    onchange="this.form.submit()">

                    <option value="">All</option>

                    <option value="pending"
                        {{ request('status') == 'pending' ? 'selected' : '' }}>

                        Pending

                    </option>

                    <option value="accepted"
                        {{ request('status') == 'accepted' ? 'selected' : '' }}>

                        Accepted

                    </option>

                    <option value="rejected"
                        {{ request('status') == 'rejected' ? 'selected' : '' }}>

                        Rejected

                    </option>

                </select>

            </form>

        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

            <div class="mb-4 p-4 bg-green-100 rounded">

                {{ session('success') }}

            </div>

        @endif

        <!-- LIST -->
        <div class="space-y-6">

            @forelse($prescriptions as $prescription)

                <div class="bg-white shadow rounded-lg p-6">

                    <!-- CUSTOMER INFO -->
                    <div class="mb-4">

                        <p>

                            <strong>Customer:</strong>

                            {{ $prescription->user->name }}

                        </p>

                        <p>

                            <strong>Email:</strong>

                            {{ $prescription->user->email }}

                        </p>

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

                    <!-- IMAGES -->
                    <div class="flex flex-wrap gap-4">

                        @foreach($prescription->images as $image)

                            <img
                                src="{{ asset('storage/' . $image->image_path) }}"
                                class="w-32 h-32 object-cover rounded border">

                        @endforeach

                    </div>

                    <!-- ACTION -->
                    <div class="mt-6">

                        @if(!$prescription->quotation)

                            <a
                                href="{{ route('pharmacy.quotations.create', $prescription) }}"
                                class="bg-green-600 text-white px-4 py-2 rounded">

                                Create Quotation

                            </a>

                        @else

                            <div class="font-semibold text-green-700">

                                Quotation Already Sent

                            </div>

                        @endif

                    </div>

                </div>

            @empty

                <div class="bg-white shadow rounded-lg p-6 text-center">

                    No prescriptions found.

                </div>

            @endforelse

        </div>

        <!-- PAGINATION -->
        <div class="mt-6">

            {{ $prescriptions->links() }}

        </div>

    </div>

</x-app-layout>