<x-app-layout>

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">

            Admin Dashboard

        </h1>

        @can('manage users')

            <div class="p-4 bg-white rounded shadow">

                <h2 class="text-lg font-semibold mb-2">

                    User Management

                </h2>

                <p>

                    You have permission to manage users.

                </p>

            </div>

        @endcan

    </div>

</x-app-layout>