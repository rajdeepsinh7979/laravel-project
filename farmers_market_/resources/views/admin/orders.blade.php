@extends('layouts.admin')

@section('title', 'Orders - Admin Panel')

@section('content')
<h3 class="mb-4">🧾 Manage Orders</h3>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card p-3">
  <table class="table table-hover">
    <thead class="table-success">
      <tr>
        <th>#</th>
        <th>Buyer</th>
        <th>Items</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($orders as $order)
      <tr>
        <td>{{ $order->OrderID }}</td>
        <td>{{ $order->buyer->FullName ?? 'N/A' }}</td>
        <td>{{ $order->Items }}</td>
        <td>₹{{ number_format($order->TotalAmount, 2) }}</td>
        <td>
          @php
            $badgeClass = match($order->Status) {
              'Pending' => 'bg-warning',
              'Shipped' => 'bg-info',
              'Delivered' => 'bg-success',
              'Cancelled' => 'bg-danger',
              default => 'bg-secondary'
            };
          @endphp
          <span class="badge {{ $badgeClass }}">{{ $order->Status }}</span>
        </td>
        <td>{{ $order->OrderDate->format('d-M-Y H:i') }}</td>
        <td>
          <form method="post" action="{{ route('admin.orders.updateStatus') }}" class="d-flex gap-2 align-items-center">
            @csrf
            <input type="hidden" name="OrderID" value="{{ $order->OrderID }}">
            <select name="Status" class="form-select form-select-sm" style="width:auto">
              @foreach(['Pending', 'Shipped', 'Delivered', 'Cancelled'] as $status)
              <option value="{{ $status }}" {{ $order->Status === $status ? 'selected' : '' }}>
                {{ $status }}
              </option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-success">Update</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="7" class="text-center text-muted">No orders found</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
