<nav x-data="{ open: false }" class="bg-white border-b border-green-600 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links (no cart icon here) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                </div>
            </div>

            <!-- Cart Icon and User Dropdown on the right (hide cart for employees) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                @if(auth()->user()->isEmployee())
                <!-- Notification Bell for Employee -->
                <div class="relative group flex items-center ml-2" x-data="{ open: false }">
                    <button @click="open = !open" class="relative focus:outline-none" aria-label="Notifications">
                        <svg class="w-7 h-7 text-green-700 group-hover:text-orange-600 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        @if(isset($notifications) && count($notifications))
                            <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs rounded-full px-1.5 py-0.5">{{ count($notifications) }}</span>
                        @endif
                    </button>
                    <!-- Dropdown: improved position, max height, scroll, and shadow -->
                    <div x-show="open" @click.away="open = false" style="right:0;left:auto;top:2.5rem;" class="absolute w-80 bg-white border border-gray-200 rounded-lg shadow-2xl z-50 max-h-[260px] overflow-y-auto transition-all duration-200" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                        <div class="sticky top-0 bg-white p-3 font-bold text-green-800 border-b z-10">Notifications</div>
                        <ul class="divide-y divide-gray-100 max-h-80 overflow-y-auto">
                            @forelse (collect($notifications)->sortByDesc('created_at')->take(10) as $notif)
                                <li class="p-3 hover:bg-green-50 cursor-pointer">
                                    @if ($notif['type'] === 'chat')
                                        <div class="font-semibold">{{ $notif['user'] }}</div>
                                        <div class="text-xs text-gray-500">{{ $notif['created_at']->format('Y-m-d H:i') }}</div>
                                        <div class="mt-1">{{ $notif['message'] }}</div>
                                    @elseif ($notif['type'] === 'cart')
                                        <div class="font-semibold text-orange-700">Add to Cart Activity</div>
                                        <div class="text-xs text-gray-500">{{ $notif['created_at']->format('Y-m-d H:i') }}</div>
                                        <div class="mt-1">{{ $notif['user'] }} added <b>{{ $notif['qty'] }}</b> of <b>{{ $notif['product'] }}</b> to cart.</div>
                                    @endif
                                </li>
                            @empty
                                <li class="p-3 text-gray-400">No notifications</li>
                            @endforelse
                        </ul>
                        @if(count($notifications) > 10)
                            <div class="text-center p-2 bg-white sticky bottom-0 z-10">
                                <a href="#" class="text-green-700 hover:underline text-sm">Load more</a>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
                @if(auth()->user()->isUser())
                <!-- Cart Icon with Tooltip -->
                <div class="relative group flex items-center">
                    <a href="{{ route('cart.index') }}" class="relative">
                        <svg class="w-7 h-7 text-green-700 group-hover:text-orange-600 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="9" cy="21" r="1"/>
                            <circle cx="20" cy="21" r="1"/>
                        </svg>
                        @if(isset($cartItemCount) && $cartItemCount > 0)
                            <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs rounded-full px-1.5 py-0.5">{{ $cartItemCount }}</span>
                        @endif
                    </a>
                    <div class="absolute left-1/2 -translate-x-1/2 mt-10 opacity-0 group-hover:opacity-100 pointer-events-none transition bg-gray-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap z-50 shadow-lg">
                        See your cart
                    </div>
                </div>
                <!-- Chat/Messages Button -->
                <div class="relative group flex items-center ml-2">
                    <a href="{{ route('chat.page') }}" class="relative">
                        <svg class="w-7 h-7 text-green-700 group-hover:text-orange-600 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4-4.03 7-9 7-1.18 0-2.31-.13-3.36-.38-.37-.09-.77-.08-1.12.07l-2.13.85a1 1 0 01-1.32-1.32l.85-2.13c.15-.35.16-.75.07-1.12A7.96 7.96 0 013 12c0-4 4.03-7 9-7s9 3 9 7z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <div class="absolute left-1/2 -translate-x-1/2 mt-10 opacity-0 group-hover:opacity-100 pointer-events-none transition bg-gray-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap z-50 shadow-lg">
                        Chat with Employee
                    </div>
                </div>
                @endif
                <!-- User Dropdown -->
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-3 px-2 grid gap-1">
                            <a href="{{ route('orders.index') }}" class="block rounded-md px-5 py-2 text-[15px] font-normal text-gray-700 hover:bg-gray-100 transition">Orders</a>
                            <a href="{{ route('saved.index') }}" class="block rounded-md px-5 py-2 text-[15px] font-normal text-gray-700 hover:bg-gray-100 transition">Saved Items</a>
                            <a href="{{ route('settings') }}" class="block rounded-md px-5 py-2 text-[15px] font-normal text-gray-700 hover:bg-gray-100 transition">Settings</a>
                            <div class="border-t border-gray-200 my-2"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left rounded-md px-5 py-2 text-[15px] font-normal text-gray-700 hover:bg-gray-100 transition">{{ __('Log Out') }}</button>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
