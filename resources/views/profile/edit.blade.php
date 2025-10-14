@extends('layouts.ecommerce')

@section('title', 'My Profile | Gemarc Enterprises Inc.')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="text-center text-success fw-bold mb-4">My Profile</h2>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="row">
                <!-- Left Column - Profile Details -->
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
                        <div class="card-header bg-white p-0 border-0">
                            <div class="py-3 px-4 text-success fw-bold d-flex align-items-center">
                                <i class="fas fa-user me-2"></i> Profile Information
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $user->name) }}" required autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                        <div class="alert alert-warning mt-2 p-2">
                                            Your email address is unverified.
                                            <form method="post" action="{{ route('verification.send') }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-decoration-none">
                                                    Click here to resend verification email
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="mb-3">
                                    <label for="contact_no" class="form-label">Contact Number</label>
                                    <input id="contact_no" name="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror" 
                                           value="{{ old('contact_no', $user->contact_no) }}" placeholder="09xxxxxxxxx">
                                    @error('contact_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="address" class="form-label">Delivery Address</label>
                                    <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" rows="2" 
                                              placeholder="Enter your complete delivery address">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-1"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Password Update Section -->
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="card-header bg-white p-0 border-0">
                            <div class="py-3 px-4 text-success fw-bold d-flex align-items-center">
                                <i class="fas fa-lock me-2"></i> Change Password
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')
                                
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input id="current_password" name="current_password" type="password" 
                                           class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" required>
                                    @error('current_password', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input id="password" name="password" type="password" 
                                           class="form-control @error('password', 'updatePassword') is-invalid @enderror" required>
                                    @error('password', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-key me-1"></i> Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - User Stats & Info -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4 text-center p-4">
                        <div class="avatar-container mx-auto mb-3">
                            <!-- Removed profile image display -->
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                                <span class="display-4 text-success">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <h5 class="fw-bold text-success">{{ $user->name }}</h5>
                        <p class="text-muted mb-0">{{ $user->email }}</p>
                        <p class="text-muted small">{{ $user->isUser() ? 'Customer' : ($user->isAdmin() ? 'Administrator' : 'Employee') }}</p>
                        <div class="border-top pt-3 mt-3">
                            <p class="mb-1">Member since</p>
                            <p class="fw-bold text-secondary">{{ $user->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                    
                    <!-- Activity Stats Card -->
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
                        <div class="card-header bg-white p-3 border-0">
                            <div class="text-success fw-bold">Your Activity</div>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span>Total Orders</span>
                                <span class="fw-bold">{{ \App\Models\Order::where('user_id', $user->id)->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span>Saved Items</span>
                                <span class="fw-bold">{{ \App\Models\SavedListItem::whereHas('savedList', function($q) use ($user) {
                                    $q->where('user_id', $user->id);
                                })->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between py-2">
                                <span>Pending Orders</span>
                                <span class="fw-bold">{{ \App\Models\Order::where('user_id', $user->id)->where('status', 'pending')->count() }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Links -->
                    <div class="list-group">
                        <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-shopping-bag me-2"></i> My Orders
                        </a>
                        <a href="{{ route('saved.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-heart me-2"></i> Saved Items
                        </a>
                        <a href="{{ route('settings') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-cog me-2"></i> Account Settings
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Delete Account Section -->
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden mt-4">
                <div class="card-header bg-white p-0 border-0">
                    <div class="py-3 px-4 text-danger fw-bold d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2"></i> Delete Account
                    </div>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                    
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                        <i class="fas fa-trash me-1"></i> Delete Account
                    </button>
                    
                    <!-- Delete Account Modal -->
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger" id="confirmDeleteModalLabel">Delete Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="{{ route('profile.destroy') }}">
                                    @csrf
                                    @method('delete')
                                    
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" name="password" type="password" class="form-control" required 
                                                   placeholder="Enter your password to confirm">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
