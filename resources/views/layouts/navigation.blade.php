<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">

                    <a href="{{ route('dashboard') }}">

                        <x-application-logo class="h-9 w-auto" />

                    </a>

                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    @can('manage users')

                        <x-nav-link
                            :href="route('admin.users.index')"
                            :active="request()->routeIs('admin.users.index')">

                            User Management

                        </x-nav-link>

                    @endcan

                    @can('manage prescriptions')

                        <x-nav-link
                            :href="route('pharmacy.prescriptions.index')"
                            :active="request()->routeIs('pharmacy.prescriptions.index')">

                            Prescriptions

                        </x-nav-link>

                    @endcan

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <!-- Trigger -->
                    <x-slot name="trigger">

                        <button class="inline-flex items-center gap-2 px-3 py-2 text-sm">

                            <span>

                                {{ Auth::user()->name }}

                            </span>

                            <svg class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7" />

                            </svg>

                        </button>

                    </x-slot>

                    <!-- Dropdown -->
                    <x-slot name="content">

                        <!-- ONLY ADMIN PROFILE -->
                        @if(auth()->user()->hasRole('admin'))

                            <x-dropdown-link :href="route('profile.edit')">

                                Profile

                            </x-dropdown-link>

                        @endif

                        <!-- LOGOUT (ALL USERS) -->
                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">

                                Log Out

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- MOBILE MENU -->
            <div class="-me-2 flex items-center sm:hidden">

                <button @click="open = ! open">

                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path :class="{ 'hidden': open, 'inline-flex': ! open }"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': ! open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

</nav>