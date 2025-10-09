<nav x-data="{ open: false }" class="bg-white border-b border-green-600 shadow-lg">
    <!-- Primary Navigation Menu -->

    <div class="max-w-screen-2xl mx-auto">
        <div class="flex justify-between items-center h-16 px-6 lg:px-20">

            <div class="flex items-center justify-between w-full">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <x-application-logo class="block h-16 w-auto" />
                    </a>
                </div>

                <!-- Spacer to push menu to right -->
                <div class="flex-1"></div>

                <!-- Custom Navbar Menu: Separate Dropdowns/Links (right side) -->
                <div class="hidden sm:flex items-center gap-2">
                    <!-- News Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @keydown.escape="open = false" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none" id="newsDropdown" aria-haspopup="true" x-bind:aria-expanded="open">
                            News
                            <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-44 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50" x-cloak>
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="newsDropdown">
                                <!-- Example subcategory, add more as needed -->
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">All News</a>
                            </div>
                        </div>
                    </div>
                    <!-- Products Link -->
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">Products</a>
                    <!-- Services Link -->
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">Services</a>
                    <!-- About Link -->
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">About</a>
                    <!-- Get Quote Button -->
                    <a href="#" class="ml-4 inline-flex items-center px-4 py-2 border border-green-600 text-green-700 font-semibold rounded-md bg-white hover:bg-green-50 transition">Get Quote</a>
                    <!-- Call Now Button -->
                    <a href="tel:+639123456789" class="ml-2 inline-flex items-center px-4 py-2 border border-orange-600 text-orange-700 font-semibold rounded-md bg-white hover:bg-orange-50 transition">Call Now</a>
                </div>
            </div>

            <!-- Cart Icon and User Dropdown on the right (hide cart for employees) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                @if(auth()->check() && auth()->user()->isEmployee())
                <!-- Notification Bell for Employee -->
                <div class="relative group flex items-center ml-2" x-data="{ open: false }">
                    <button @click="open = !open" class="relative focus:outline-none" aria-label="Notifications">
                        <svg class="w-7 h-7 text-green-700 group-hover:text-orange-600 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        @php
                            $employeeNotifs = \App\Helpers\EmployeeNotification::all();
                        @endphp
                        @if(count($employeeNotifs))
                            <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs rounded-full px-1.5 py-0.5">{{ count($employeeNotifs) }}</span>
                        @endif
                    </button>
                    <!-- Dropdown: improved position, max height, scroll, and shadow -->
                    <div x-show="open" @click.away="open = false" style="right:0;left:auto;top:2.5rem;" class="absolute w-80 bg-white border border-gray-200 rounded-lg shadow-2xl z-50 max-h-80 transition-all duration-200" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                        <div class="sticky top-0 bg-white p-2 font-bold text-green-800 border-b z-10 flex items-center justify-between">
                            <span>Notifications</span>
                            <button id="clear-notifications-btn" class="text-xs text-red-600 hover:text-red-800 px-2 py-1 rounded border border-red-200 ml-2" type="button">Clear</button>
                        </div>
                        <ul id="notification-list" class="divide-y divide-gray-100 max-h-56 overflow-y-auto">
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var clearBtn = document.getElementById('clear-notifications-btn');
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            fetch('/notifications/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(r => r.json()).then(res => {
                if (res.success) {
                    // Remove all notifications from the list
                    var notifList = document.getElementById('notification-list');
                    if (notifList) notifList.innerHTML = '<li class="p-3 text-gray-400">No notifications</li>';
                    // Remove badge
                    var badge = document.querySelector('.absolute.-top-2.-right-2.bg-orange-500');
                    if (badge) badge.remove();
                }
            });
        });
    }
});
</script>
@endpush
                            @php
                                $employeeNotifs = \App\Helpers\EmployeeNotification::all();
                            @endphp
                            @forelse (collect($employeeNotifs)->sortByDesc(fn($n) => $n['created_at']) as $notif)
                                <li class="px-3 py-2 hover:bg-green-50 cursor-pointer text-sm">
                                    @if ($notif['type'] === 'order')
                                        <div class="font-semibold text-green-700">New Order</div>
                                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($notif['data']['created_at'])->format('Y-m-d H:i') }}</div>
                                        <div class="mt-1">Order #{{ $notif['data']['reference'] }} by <b>{{ $notif['data']['user'] }}</b> (₱{{ number_format($notif['data']['total'],2) }})</div>
                                    @elseif ($notif['type'] === 'quote')
                                        <div class="font-semibold text-blue-700">New Quote Request</div>
                                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($notif['data']['created_at'])->format('Y-m-d H:i') }}</div>
                                        <div class="mt-1">Quote #{{ $notif['data']['quote_id'] }} by <b>{{ $notif['data']['user'] }}</b> (₱{{ number_format($notif['data']['total'],2) }})</div>
                                    @elseif ($notif['type'] === 'chat')
                                        <div class="font-semibold text-purple-700">New Chat Message</div>
                                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($notif['data']['created_at'])->format('Y-m-d H:i') }}</div>
                                        <div class="mt-1"><b>{{ $notif['data']['user'] ?? 'User' }}</b>: <span class="truncate block">{{ $notif['data']['message'] ?? '' }}</span></div>
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
                        {{-- No need for load more, scroll handles overflow --}}
                    </div>
                </div>
                @endif
                @if(auth()->check() && auth()->user()->isUser())
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
                <!-- View My Quotes Button -->
                <div class="relative group flex items-center ml-2">
                    <a href="{{ url('/dashboard/quotes') }}" class="relative">
                        <svg class="w-7 h-7 text-orange-600 group-hover:text-green-700 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 4h16v16H4z" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 8h8v8H8z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <div class="absolute left-1/2 -translate-x-1/2 mt-10 opacity-0 group-hover:opacity-100 pointer-events-none transition bg-gray-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap z-50 shadow-lg">
                        View My Quotes
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
                <!-- User Dropdown: Hide on landing page -->
                @if (!request()->routeIs('landing'))
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user() ? Auth::user()->name : '' }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-3 px-2 grid gap-1">
                            @if(!auth()->user() || !auth()->user()->isEmployee())
                                <a href="{{ route('orders.index') }}" class="block rounded-md px-5 py-2 text-[15px] font-normal text-gray-700 hover:bg-gray-100 transition">Orders</a>
                                <a href="{{ route('saved.index') }}" class="block rounded-md px-5 py-2 text-[15px] font-normal text-gray-700 hover:bg-gray-100 transition">Saved Items</a>
                            @endif
                            <a href="{{ route('profile.edit') }}" class="block rounded-md px-5 py-2 text-[15px] font-normal text-gray-700 hover:bg-gray-100 transition">Profile</a>
                            <div class="border-t border-gray-200 my-2"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left rounded-md px-5 py-2 text-[15px] font-normal text-gray-700 hover:bg-gray-100 transition">{{ __('Log Out') }}</button>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
                @endif
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
                <div class="font-medium text-base text-gray-800">{{ Auth::user() ? Auth::user()->name : '' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user() ? Auth::user()->email : '' }}</div>
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
