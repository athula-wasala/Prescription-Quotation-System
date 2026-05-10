<x-app-layout>

    <div class="p-6">

        <div class="mb-6">

            <h1 class="text-2xl font-bold">

                User Management

            </h1>

        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">
                            ID
                        </th>

                        <th class="text-left p-4">
                            Name
                        </th>

                        <th class="text-left p-4">
                            Email
                        </th>

                        <th class="text-left p-4">
                            Roles
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                        <tr class="border-t">

                            <td class="p-4">

                                {{ $user->id }}

                            </td>

                            <td class="p-4">

                                {{ $user->name }}

                            </td>

                            <td class="p-4">

                                {{ $user->email }}

                            </td>

                            <td class="p-4">

                                {{ $user->getRoleNames()->implode(', ') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="p-4 text-center">

                                No users found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $users->links() }}

        </div>

    </div>

</x-app-layout>