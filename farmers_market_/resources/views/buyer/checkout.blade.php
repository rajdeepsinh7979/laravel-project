<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Farmer's Market - Checkout</title>
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

.checkout-card {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  padding: 30px;
  margin-bottom: 30px;
}
.checkout-item {
  display: flex;
  align-items: center;
  padding: 15px 0;
  border-bottom: 1px solid #eee;
}
.checkout-item:last-child { border-bottom: none; }
.checkout-item img {
  width: 60px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
  margin-right: 15px;
}
.checkout-item-details { flex: 1; }
.checkout-item h6 { margin: 0 0 5px 0; font-size: 1rem; }
.checkout-item p { margin: 0; color: #666; font-size: 0.9rem; }
.order-summary {
  background: #f8f9fa;
  border-radius: 10px;
  padding: 20px;
  margin-top: 20px;
}
.order-summary h4 { color: #2f7a32; margin-bottom: 15px; }
.order-summary .total { font-size: 1.5rem; font-weight: 700; color: #2f7a32; }
.payment-options {
  margin-top: 20px;
}
.payment-options .form-check { margin-bottom: 10px; }
.btn-success {
  background: linear-gradient(90deg, #2f7a32, #4caf50);
  border: none;
}
.btn-success:hover {
  background: linear-gradient(90deg, #1b5e20, #2e7d32);
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
  <div class="row">
    <div class="col-lg-8">
      <h2 class="text-success fw-bold mb-4"><i class="bi bi-credit-card"></i> Checkout</h2>

      <!-- Order Items -->
      <div class="checkout-card">
        <h4 class="mb-3">Order Items</h4>
        @foreach($cartItems as $item)
          <div class="checkout-item">
            <img src="{{ asset('storage/' . $item->product->Image) }}" alt="{{ $item->product->ProductName }}">
            <div class="checkout-item-details">
              <h6>{{ $item->product->ProductName }}</h6>
              <p>{{ $item->product->Category }} • Quantity: {{ $item->Quantity }}</p>
            </div>
            <div class="text-end">
              <p class="fw-bold">₹{{ number_format($item->Quantity * $item->product->Price) }}</p>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Delivery Address -->
      <div class="checkout-card">
        <h4 class="mb-3"><i class="bi bi-geo-alt"></i> Delivery Address</h4>
        <form id="checkoutForm" method="POST" action="{{ route('buyer.payment') }}">
          @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="full_name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="full_name" name="full_name" value="{{ auth()->user()->FullName }}" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->Phone }}" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->Email }}" required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Full Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your complete delivery address" required></textarea>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="city" class="form-label">City</label>
              <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="pincode" class="form-label">Pincode</label>
              <input type="text" class="form-control" id="pincode" name="pincode" required>
            </div>
          </div>
      </div>

      <!-- Payment Method -->
      <div class="checkout-card">
        <h4 class="mb-3"><i class="bi bi-wallet"></i> Payment Method</h4>
        <div class="payment-options">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
            <label class="form-check-label" for="cod">
              <strong>Cash on Delivery</strong>
              <br><small class="text-muted">Pay when you receive your order</small>
            </label>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <!-- Order Summary -->
      <div class="checkout-card">
        <h4 class="mb-3">Order Summary</h4>
        <div class="order-summary">
          <p>Subtotal: ₹{{ number_format($total) }}</p>
          <p>Delivery: ₹50</p>
          <hr>
          <p class="total">Total: ₹{{ number_format($total + 50) }}</p>
        </div>
        <button type="submit" form="checkoutForm" class="btn btn-success btn-lg w-100 mt-3">
          <i class="bi bi-check-circle"></i> Place Order
        </button>
        </form>
      </div>

      <!-- Order Notes -->
      <div class="checkout-card">
        <h5 class="mb-3"><i class="bi bi-info-circle"></i> Important Notes</h5>
        <ul class="list-unstyled small text-muted">
          <li>• Orders are typically delivered within 2-3 business days</li>
          <li>• Fresh produce delivery may vary based on location</li>
          <li>• Cash on delivery available for all orders</li>
          <li>• Contact support for any delivery concerns</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
