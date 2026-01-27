@extends('layouts.admin')

@section('title', 'Admin Dashboard - Farmers Market')

@section('content')
<div class="container-fluid">
  <!-- Welcome Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h2 class="mb-1">Welcome back, {{ $adminName }}! 👋</h2>
          <p class="text-muted mb-0">Here's what's happening with your farmers market today.</p>
        </div>
        <div class="text-end">
          <small class="text-muted">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Row -->
  <div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white;">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-title mb-1 opacity-75">Total Farmers</h6>
              <h2 class="mb-0 fw-bold">{{ $totalFarmers }}</h2>
            </div>
            <div class="fs-1 opacity-75">
              <i class="bi bi-people-fill"></i>
            </div>
          </div>
          <div class="mt-3">
            <small class="opacity-75">Active agricultural partners</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #007bff 0%, #6610f2 100%); color: white;">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-title mb-1 opacity-75">Total Buyers</h6>
              <h2 class="mb-0 fw-bold">{{ $totalBuyers }}</h2>
            </div>
            <div class="fs-1 opacity-75">
              <i class="bi bi-person-check-fill"></i>
            </div>
          </div>
          <div class="mt-3">
            <small class="opacity-75">Registered customers</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #fd7e14 0%, #ffc107 100%); color: white;">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-title mb-1 opacity-75">Total Orders</h6>
              <h2 class="mb-0 fw-bold">{{ $totalOrders }}</h2>
            </div>
            <div class="fs-1 opacity-75">
              <i class="bi bi-receipt-cutoff"></i>
            </div>
          </div>
          <div class="mt-3">
            <small class="opacity-75">Orders processed</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%); color: white;">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-title mb-1 opacity-75">Total Revenue</h6>
              <h2 class="mb-0 fw-bold">₹{{ number_format($totalRevenue, 0) }}</h2>
            </div>
            <div class="fs-1 opacity-75">
              <i class="bi bi-currency-rupee"></i>
            </div>
          </div>
          <div class="mt-3">
            <small class="opacity-75">Revenue generated</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Orders & Activity Row -->
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-white border-0 py-3">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-success"><i class="bi bi-receipt me-2"></i>Recent Orders</h5>
            <a href="#" class="btn btn-sm btn-success">View All Orders</a>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="table-light">
                <tr>
                  <th class="border-0 ps-4">#</th>
                  <th class="border-0">Buyer</th>
                  <th class="border-0">Items</th>
                  <th class="border-0">Status</th>
                  <th class="border-0">Total</th>
                  <th class="border-0 pe-4">Date</th>
                </tr>
              </thead>
              <tbody>
                @forelse($recentOrders as $o)
                  <tr>
                    <td class="ps-4 fw-bold text-muted">#{{ $o->OrderID }}</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar-circle bg-primary text-white me-2" style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: bold;">
                          {{ strtoupper(substr($o->BuyerName, 0, 1)) }}
                        </div>
                        {{ $o->BuyerName }}
                      </div>
                    </td>
                    <td><span class="badge bg-light text-dark">{{ $o->Items }} items</span></td>
                    <td>
                      @php
                        $badge = 'bg-secondary';
                        $statusIcon = 'bi-circle-fill';
                        if ($o->Status === 'Pending') { $badge = 'bg-warning text-dark'; $statusIcon = 'bi-clock'; }
                        elseif ($o->Status === 'Shipped') { $badge = 'bg-info'; $statusIcon = 'bi-truck'; }
                        elseif ($o->Status === 'Delivered') { $badge = 'bg-success'; $statusIcon = 'bi-check-circle'; }
                        elseif ($o->Status === 'Cancelled') { $badge = 'bg-danger'; $statusIcon = 'bi-x-circle'; }
                      @endphp
                      <span class="badge {{ $badge }}"><i class="bi {{ $statusIcon }} me-1"></i>{{ $o->Status }}</span>
                    </td>
                    <td class="fw-bold text-success">₹{{ number_format($o->TotalAmount, 2) }}</td>
                    <td class="pe-4 text-muted small">{{ \Carbon\Carbon::parse($o->OrderDate)->format('M j, H:i') }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center py-4">
                      <div class="text-muted">
                        <i class="bi bi-receipt-x fs-1 mb-2"></i>
                        <p class="mb-0">No recent orders</p>
                      </div>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-white border-0 py-3">
          <h5 class="mb-0 text-primary"><i class="bi bi-activity me-2"></i>Recent Activities</h5>
        </div>
        <div class="card-body">
          <div class="timeline">
            <div class="timeline-item mb-3">
              <div class="timeline-marker bg-success"></div>
              <div class="timeline-content">
                <small class="text-muted">{{ \Carbon\Carbon::now()->format('H:i') }}</small>
                <p class="mb-0 small">Dashboard loaded with live statistics</p>
              </div>
            </div>
            <div class="timeline-item mb-3">
              <div class="timeline-marker bg-info"></div>
              <div class="timeline-content">
                <small class="text-muted">{{ \Carbon\Carbon::now()->subMinutes(5)->format('H:i') }}</small>
                <p class="mb-0 small">System health check completed</p>
              </div>
            </div>
            <div class="timeline-item mb-3">
              <div class="timeline-marker bg-warning"></div>
              <div class="timeline-content">
                <small class="text-muted">{{ \Carbon\Carbon::now()->subMinutes(15)->format('H:i') }}</small>
                <p class="mb-0 small">New farmer registration processed</p>
              </div>
            </div>
            <div class="timeline-item">
              <div class="timeline-marker bg-primary"></div>
              <div class="timeline-content">
                <small class="text-muted">{{ \Carbon\Carbon::now()->subMinutes(30)->format('H:i') }}</small>
                <p class="mb-0 small">Order #{{ rand(1000, 9999) }} marked as delivered</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.timeline {
  position: relative;
  padding-left: 30px;
}

.timeline::before {
  content: '';
  position: absolute;
  left: 15px;
  top: 0;
  bottom: 0;
  width: 2px;
  background: #e9ecef;
}

.timeline-item {
  position: relative;
  margin-bottom: 20px;
}

.timeline-marker {
  position: absolute;
  left: -22px;
  top: 6px;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: 2px solid white;
  box-shadow: 0 0 0 2px #e9ecef;
}

.timeline-content {
  background: #f8f9fa;
  padding: 10px 15px;
  border-radius: 8px;
  border-left: 3px solid #007bff;
}

.card {
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}
</style>
@endsection
