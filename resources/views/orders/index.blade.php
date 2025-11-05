@extends('layouts.ecommerce')
@section('title', 'My Orders | Gemarc Enterprises Inc.')
@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header bg-white py-3">
            <h4 class="card-title mb-0 fw-bold">My Orders</h4>
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success mb-4">{{ session('status') }}</div>
            @endif
            @if($orders->isEmpty())
                <div class="alert alert-info">You have no orders yet.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Reference #</th>
                                <th>Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->reference_number }}</td>
                                <td>{{ $order->created_at->format('F d, Y h:i A') }}</td>
                                <td class="text-center">
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-info text-dark">Processing</span>
                                    @elseif($order->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                        <a href="tel:+639090879416" class="btn btn-sm btn-outline-success" title="Call Marketing Department: +63 909 087 9416">
                                            <i class="fas fa-phone me-1"></i> Call Marketing
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
