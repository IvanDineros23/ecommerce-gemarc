@extends('layouts.ecommerce')

@section('title', 'Settings | Gemarc Enterprises Inc.')
@section('content')
<div class="container py-4">
    <h2 class="text-center text-success fw-bold mb-4">Settings</h2>
    
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

    <!-- Basic Settings Dropdown -->
    @php $isEmployee = Auth::user()->isEmployee(); $isUser = Auth::user()->isUser(); @endphp
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4" x-data="{ open: true }">
        <div class="card-header bg-white p-0 border-0">
            <button @click="open = !open" class="btn w-100 text-start d-flex justify-content-between align-items-center py-3 px-4 text-success fw-bold">
                Basic Information
                <i class="fas fa-chevron-down" :class="{'fa-rotate-180': open}"></i>
            </button>
        </div>
        <div class="card-body p-4" x-show="open">
            <form x-data="{ email: '', confirm: '', match: true }" @input="match = (email === confirm)" method="POST" action="{{ route('settings.saveBasicInfo') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control bg-light" id="name" value="{{ Auth::user()->name }}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label for="current_email" class="form-label">Current Email</label>
                    <input type="email" class="form-control bg-light" id="current_email" value="{{ Auth::user()->email }}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label for="contact_no" class="form-label">Contact Number</label>
                    <input type="text" name="contact_no" class="form-control" id="contact_no" value="{{ old('contact_no', Auth::user()->contact_no) }}" placeholder="09XXXXXXXXX">
                </div>
                @if(!$isEmployee)
                    <div class="mb-3">
                        <label for="new_email" class="form-label">New Email</label>
                        <input type="email" id="new_email" x-model="email" class="form-control" placeholder="Enter new email">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_email" class="form-label">Confirm New Email</label>
                        <input type="email" id="confirm_email" x-model="confirm" class="form-control" placeholder="Confirm new email">
                        <template x-if="confirm.length > 0">
                            <div class="form-text mt-1" :class="match ? 'text-success' : 'text-danger'">
                                <span x-show="match">✓ Emails match</span>
                                <span x-show="!match">✗ Emails do not match</span>
                            </div>
                        </template>
                    </div>
                    <button type="submit" class="btn btn-success" :disabled="!match || !email || !confirm" :class="{'opacity-50': !match || !email || !confirm}">Save Basic Info</button>
                @endif
            </form>
        </div>
    </div>

    <!-- Change Password Dropdown -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4" x-data="{ open: false }">
        <div class="card-header bg-white p-0 border-0">
            <button @click="open = !open" class="btn w-100 text-start d-flex justify-content-between align-items-center py-3 px-4 text-success fw-bold">
                Change Password
                <i class="fas fa-chevron-down" :class="{'fa-rotate-180': open}"></i>
            </button>
        </div>
        <div class="card-body p-4" x-show="open">
            <form x-data="{ password: '', strength: 0, strengthText: '', strengthColor: 'bg-secondary' }" @input="
                strength = 0;
                strengthText = 'Weak';
                strengthColor = 'bg-danger';
                if (password.length >= 8) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;
                if (strength === 1) { strengthText = 'Weak'; strengthColor = 'bg-danger'; }
                if (strength === 2) { strengthText = 'Fair'; strengthColor = 'bg-warning'; }
                if (strength === 3) { strengthText = 'Good'; strengthColor = 'bg-info'; }
                if (strength === 4) { strengthText = 'Strong'; strengthColor = 'bg-success'; }
            ">
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" id="current_password" class="form-control" placeholder="Current Password">
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" id="new_password" x-model="password" class="form-control" placeholder="New Password">
                    <div class="progress mt-2" style="height: 5px;">
                        <div class="progress-bar transition-all" :class="strengthColor" :style="'width:' + (strength*25) + '%'"></div>
                    </div>
                    <div class="form-text mt-1" :class="{ 
                        'text-danger': strength === 1, 
                        'text-warning': strength === 2, 
                        'text-info': strength === 3, 
                        'text-success': strength === 4 
                    }">
                        Password strength: <span x-text="strengthText"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" id="confirm_password" class="form-control" placeholder="Confirm New Password">
                </div>
                <button type="button" class="btn btn-warning">Change Password</button>
            </form>
        </div>
    </div>

    @if(!$isEmployee)
        <!-- Payment Details Dropdown -->
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4" x-data="{ open: false, method: '{{ old('method', Auth::user()->payment_details['method'] ?? 'card') }}', ewallet: '{{ old('ewallet', Auth::user()->payment_details['ewallet'] ?? 'gcash') }}' }">
            <div class="card-header bg-white p-0 border-0">
                <button @click="open = !open" class="btn w-100 text-start d-flex justify-content-between align-items-center py-3 px-4 text-success fw-bold">
                    Payment Details
                    <i class="fas fa-chevron-down" :class="{'fa-rotate-180': open}"></i>
                </button>
            </div>
            <div class="card-body p-4" x-show="open">
                <form method="POST" action="{{ route('settings.savePaymentDetails') }}" x-data="{ method: '{{ old('method', Auth::user()->payment_details['method'] ?? 'card') }}', ewallet: '{{ old('ewallet', Auth::user()->payment_details['ewallet'] ?? 'gcash') }}' }">
                    @csrf
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select name="method" id="payment_method" x-model="method" class="form-select" required>
                            <option value="card">Card Payment</option>
                            <option value="ewallet">E-Wallet</option>
                            <option value="check">Check Payment</option>
                        </select>
                    </div>
                    <template x-if="method === 'card'">
                        <div>
                            <div class="mb-3">
                                <label for="card_name" class="form-label">Cardholder Name</label>
                                <input type="text" name="card_name" id="card_name" class="form-control" placeholder="Juan Dela Cruz" value="{{ old('card_name', Auth::user()->payment_details['card_name'] ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="card_number" class="form-label">Card Number</label>
                                <input type="text" name="card_number" id="card_number" class="form-control" placeholder="1234 5678 9012 3456" value="{{ old('card_number', Auth::user()->payment_details['card_number'] ?? '') }}">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="expiry" class="form-label">Expiry</label>
                                    <input type="text" name="expiry" id="expiry" class="form-control" placeholder="MM/YY" value="{{ old('expiry', Auth::user()->payment_details['expiry'] ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" name="cvv" id="cvv" class="form-control" placeholder="123" value="{{ old('cvv', Auth::user()->payment_details['cvv'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                    </template>
                    <template x-if="method === 'ewallet'">
                        <div>
                            <div class="mb-3">
                                <label for="ewallet_type" class="form-label">E-Wallet Type</label>
                                <select name="ewallet" id="ewallet_type" x-model="ewallet" class="form-select">
                                    <option value="gcash">GCash</option>
                                    <option value="maya">Maya</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <template x-if="ewallet === 'gcash' || ewallet === 'maya'">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile Number</label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="09xxxxxxxxx" value="{{ old('mobile', Auth::user()->payment_details['mobile'] ?? '') }}">
                                </div>
                            </template>
                            <template x-if="ewallet === 'paypal'">
                                <div class="mb-3">
                                    <label for="paypal_email" class="form-label">PayPal Email</label>
                                    <input type="email" name="paypal_email" id="paypal_email" class="form-control" placeholder="your@email.com" value="{{ old('paypal_email', Auth::user()->payment_details['paypal_email'] ?? '') }}">
                                </div>
                            </template>
                            <template x-if="ewallet === 'other'">
                                <div class="mb-3">
                                    <label for="ewallet_details" class="form-label">E-Wallet Details</label>
                                    <input type="text" name="ewallet_details" id="ewallet_details" class="form-control" placeholder="E-Wallet Name/Number" value="{{ old('ewallet_details', Auth::user()->payment_details['ewallet_details'] ?? '') }}">
                                </div>
                            </template>
                        </div>
                    </template>
                    <template x-if="method === 'check'">
                        <div class="mb-3">
                            <label for="check_payee" class="form-label">Check Payee Name</label>
                            <input type="text" name="check_payee" id="check_payee" class="form-control" placeholder="Payee Name" value="{{ old('check_payee', Auth::user()->payment_details['check_payee'] ?? '') }}">
                        </div>
                    </template>
                    <button type="submit" class="btn btn-success">Save Payment Details</button>
                </form>
            </div>
        </div>
    @endif

    @if(!$isEmployee)
        <!-- Address Dropdown -->
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4" x-data="{ open: false, editing: false }">
            <div class="card-header bg-white p-0 border-0">
                <button @click="open = !open" class="btn w-100 text-start d-flex justify-content-between align-items-center py-3 px-4 text-success fw-bold">
                    Address
                    <i class="fas fa-chevron-down" :class="{'fa-rotate-180': open}"></i>
                </button>
            </div>
            <div class="card-body p-4" x-show="open">
                <!-- Show current address in non-editable display -->
                <div class="mb-4" x-show="!editing">
                    <h5 class="mb-3 fw-bold">Current Address</h5>
                    
                    @php 
                        $savedAddress = Auth::user()->address ?? Auth::user()->delivery_option['address'] ?? '';
                    @endphp
                    
                    @if(!empty($savedAddress))
                        <div class="p-3 border rounded bg-light mb-3">
                            <p class="mb-0">{{ $savedAddress }}</p>
                        </div>
                        <button type="button" @click="editing = true" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-pencil-alt me-1"></i> Edit Address
                        </button>
                    @else
                        <div class="alert alert-info">
                            No address saved. Please add your delivery address.
                        </div>
                        <button type="button" @click="editing = true" class="btn btn-success btn-sm">
                            <i class="fas fa-plus me-1"></i> Add Address
                        </button>
                    @endif
                </div>
                
                <!-- Edit address form -->
                <form method="POST" action="{{ route('settings.saveDeliveryAddress') }}" x-show="editing">
                    @csrf
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="123 Main St, City, Province" value="{{ old('address', Auth::user()->address ?? Auth::user()->delivery_option['address'] ?? '') }}" required>
                        <div class="form-text">Please enter your complete address including building number, street, city, and province/state.</div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">Save Address</button>
                        <button type="button" @click="editing = false" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush

@endsection
