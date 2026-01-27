<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Farmer's Market - My Cart</title>
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
  margin-left:260px; /* pushes logo beside sidebar */
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

/* Cart */
.cart-item {
  border-radius:15px; overflow:hidden;
  box-shadow:0 3px 8px rgba(0,0,0,0.1); transition:all .3s;
  background:#fff;
}
.cart-item:hover { box-shadow:0 6px 16px rgba(0,0,0,0.15); }
.cart-item img { height:100px; width:100px; object-fit:cover; }
.price { color:#2f7a32; font-size:1.2rem; font-weight:600; }
.btn-remove { background:#dc3545; color:#fff; border-radius:50%; width:30px; height:30px; display:flex; align-items:center; justify-content:center; }
.btn-remove:hover { background:#c82333; }

/* Content */
.content { margin-left:260px; padding:20px; }
@media(max-width:768px){
  .sidebar { left:-260px; }
  .sidebar.active { left:0; }
  .content { margin-left:0; }
}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container-fluid">
    <button class="btn btn-light d-lg-none me-2" id="sidebarToggle"><i class="bi bi-list"></i></button>
    <a class="navbar-brand" href="#">
      <i class="bi bi-shop"></i> Farmer's Market
    </a>
  </div>
</nav>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
  <div class="sidebar-header">
    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle mb-2" width="70" height="70" alt="User">
    <h6>{{ $buyerName }}</h6>
    <small>Buyer Dashboard</small>
  </div>
  <ul class="sidebar-menu">
    <li>
      <a href="{{ route('buyer.dashboard') }}"><i class="bi bi-house-door"></i>Dashboard</a>
    </li>
    <li class="active">
      <a href="{{ route('buyer.cart') }}"><i class="bi bi-cart"></i>My Cart</a>
    </li>
    <li>
      <a href="{{ route('buyer.orders') }}"><i class="bi bi-bag-check"></i>My Orders</a>
    </li>
    <li>
      <a href="{{ route('buyer.profile') }}"><i class="bi bi-person"></i>Profile</a>
    </li>
    <li>
      <a href="{{ route('buyer.support') }}"><i class="bi bi-headset"></i>Support</a>
    </li>
  </ul>
  <div class="logout-section">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-danger w-100"><i class="bi bi-box-arrow-right"></i> Logout</button>
    </form>
  </div>
</div>

<!-- Main Content -->
<div class="content">
  <div class="container">
    <h2 class="text-success fw-bold mb-4"><i class="bi bi-cart"></i> My Cart</h2>

    @if($cartItems->isEmpty())
      <div class="text-center py-5">
        <i class="bi bi-cart-x display-1 text-muted"></i>
        <h4 class="text-muted mt-3">Your cart is empty</h4>
        <p class="text-muted">Start shopping to add items to your cart.</p>
        <a href="{{ route('buyer.dashboard') }}" class="btn btn-success btn-lg">Continue Shopping</a>
      </div>
    @else
      <div class="row">
        <div class="col-lg-8">
          @foreach($cartItems as $item)
            <div class="cart-item p-3 mb-3 d-flex align-items-center">
              <img src="{{ asset('storage/' . $item->product->Image) }}" alt="{{ $item->product->ProductName }}" class="me-3">
              <div class="flex-grow-1">
                <h5 class="mb-1">{{ $item->product->ProductName }}</h5>
                <p class="text-muted mb-1">{{ $item->product->Description }}</p>
                <p class="price mb-0">₹{{ number_format($item->product->Price) }} x {{ $item->Quantity }}</p>
              </div>
              <div class="text-end">
                <p class="price fw-bold mb-2">₹{{ number_format($item->Quantity * $item->product->Price) }}</p>
                <form method="POST" action="{{ route('buyer.removeFromCart', ['cartId' => $item->CartID]) }}" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-remove"><i class="bi bi-trash"></i></button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
        <div class="col-lg-4">
          <div class="bg-white p-4 rounded-3 shadow">
            <h5 class="text-success fw-bold mb-3">Order Summary</h5>
            <div class="d-flex justify-content-between mb-2">
              <span>Subtotal:</span>
              <span>₹{{ number_format($total) }}</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Shipping:</span>
              <span>Free</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold fs-5">
              <span>Total:</span>
              <span>₹{{ number_format($total) }}</span>
            </div>
            <a href="{{ route('buyer.checkout') }}" class="btn btn-success w-100 mt-3">Proceed to Checkout</a>
          </div>
        </div>
      </div>
    @endif
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const sidebar = document.getElementById("sidebar");
const toggle = document.getElementById("sidebarToggle");
toggle?.addEventListener("click", () => {
  sidebar.classList.toggle("active");
});
</script>
</body>
</html>
