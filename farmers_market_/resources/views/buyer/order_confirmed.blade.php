<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Confirmed - Farmer's Market</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
body { font-family: 'Segoe UI', sans-serif; background:#f9fafb; overflow-x:hidden; }

/* Navbar */
.navbar {
  background: linear-gradient(90deg, #2f7a32, #4caf50);
  box-shadow:0 2px 8px rgba(0,0,0,0.25);
}
.navbar-brand {
  display:flex;
  align-items:center;
  font-size:1.4rem;
  font-weight:800;
  color:#fff;
  letter-spacing:1px;
  margin-left:260px;
  transition:all .3s;
}
.navbar-brand i {
  font-size:1.6rem; margin-right:10px;
  color:#ffeb3b;
}
.navbar-brand:hover {
  text-shadow:0 0 8px rgba(255,255,255,0.8);
}
@media(max-width:768px){
  .navbar-brand { margin-left:0; }
}

/* Sidebar */
.sidebar {
  position: fixed; top: 0; left: 0; width: 250px; height: 100vh;
  background: rgba(47, 122, 50, 0.95); backdrop-filter: blur(10px);
  box-shadow: 2px 0 12px rgba(0,0,0,0.15);
  display:flex; flex-direction:column; z-index:1050; transition:all .3s;
}
.sidebar-header { text-align:center; padding:30px 15px 15px; }
.sidebar-header img { border:3px solid #fff; }
.sidebar-header h6 { margin:10px 0 0; color:#fff; }
.sidebar-header small { color:#ddd; }
.sidebar-menu { list-style:none; padding:0; margin-top:20px; }
.sidebar-menu li { margin:8px 0; }
.sidebar-menu a {
  display:flex; align-items:center; padding:12px 20px;
  color:#f1f1f1; text-decoration:none; font-weight:500;
  border-radius:8px; transition:.3s;
}
.sidebar-menu a i { font-size:20px; margin-right:12px; }
.sidebar-menu li.active a, .sidebar-menu a:hover {
  background:#fff; color:#2f7a32; font-weight:600;
}
.logout-section { margin-top:auto; text-align:center; padding:20px; }

.order-card {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  margin-bottom: 20px;
  padding: 20px;
}
.success-icon {
  font-size: 4rem;
  color: #28a745;
}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('buyer.dashboard') }}">
      <i class="bi bi-shop"></i> Farmer's Market
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <img src="https://via.placeholder.com/60" alt="Profile" class="rounded-circle">
    <h6>{{ $buyerName }}</h6>
    <small>Buyer</small>
  </div>
  <ul class="sidebar-menu">
    <li><a href="{{ route('buyer.dashboard') }}"><i class="bi bi-house-door"></i> Dashboard</a></li>
    <li><a href="{{ route('buyer.cart') }}"><i class="bi bi-cart"></i> My Cart</a></li>
    <li><a href="{{ route('buyer.orders') }}"><i class="bi bi-receipt"></i> My Orders</a></li>
    <li><a href="{{ route('buyer.profile') }}"><i class="bi bi-person"></i> Profile</a></li>
    <li><a href="{{ route('buyer.support') }}"><i class="bi bi-headset"></i> Support</a></li>
  </ul>
  <div class="logout-section">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-outline-light btn-sm">
        <i class="bi bi-box-arrow-right"></i> Logout
      </button>
    </form>
  </div>
</div>

<!-- Main Content -->
<div class="container-fluid" style="margin-left: 250px; padding: 20px;">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="text-center mb-4">
        <i class="bi bi-check-circle-fill success-icon"></i>
        <h2 class="text-success fw-bold mt-3">Order Confirmed!</h2>
        <p class="text-muted">Thank you for your order. Your order has been placed successfully.</p>
      </div>

      <div class="order-card">
        <h5 class="text-success mb-3"><i class="bi bi-receipt"></i> Order Details</h5>
        <div class="row">
          <div class="col-md-6">
            <p><strong>Order ID:</strong> {{ $order->OrderID }}</p>
            <p><strong>Order Date:</strong> {{ $order->OrderDate->format('d M Y, H:i') }}</p>
            <p><strong>Status:</strong> <span class="badge bg-warning">{{ $order->Status }}</span></p>
          </div>
          <div class="col-md-6">
            <p><strong>Delivery Address:</strong> {{ $order->DeliveryAddress }}</p>
            <p><strong>Total Amount:</strong> ₹{{ number_format($order->TotalAmount) }}</p>
          </div>
        </div>
        <hr>
        <h6>Order Items:</h6>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->orderItems as $item)
                <tr>
                  <td>{{ $item->product->ProductName }}</td>
                  <td>{{ $item->Quantity }}</td>
                  <td>₹{{ number_format($item->Price) }}</td>
                  <td>₹{{ number_format($item->Price * $item->Quantity) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="text-center">
        <button onclick="window.print()" class="btn btn-outline-primary me-3">
          <i class="bi bi-printer"></i> Print Receipt
        </button>
        <a href="{{ route('buyer.dashboard') }}" class="btn btn-success">
          <i class="bi bi-shop"></i> Continue Shopping
        </a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


