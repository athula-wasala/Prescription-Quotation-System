<x-app-layout>

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">

            Pharmacy Dashboard

        </h1>

        @can('manage prescriptions')

            <div class="p-4 bg-white rounded shadow">

                <h2 class="text-lg font-semibold mb-2">

                    Prescription Management

                </h2>

                <p>

                    You can manage prescriptions.

                </p>

            </div>

        @endcan

    </div>

</x-app-layout>