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
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <div class="form-control bg-light">{{ $user->name }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <div class="form-control bg-light">{{ $user->email }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact Number</label>
                                <div class="form-control bg-light">{{ $user->contact_no }}</div>
                            </div>
                            @if($user->isUser())
                            <div class="mb-3">
                                <label class="form-label">Delivery Address</label>
                                <div class="form-control bg-light">{{ $user->address }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - User Stats & Info -->
                <div class="col-lg-4">
                    
                    <!-- Activity Stats Card -->
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4 text-center p-4">
                        <div class="avatar-container mx-auto mb-3">
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
                    @if($user->isUser())
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
                    @else
                    <!-- Only show Account Settings for employees/admins -->
                    <div class="list-group">
                        <a href="{{ route('settings') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-cog me-2"></i> Account Settings
                        </a>
                    </div>
                    @endif
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
