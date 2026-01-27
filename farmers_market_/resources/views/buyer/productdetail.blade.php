<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $product->ProductName }} - Farmer's Market</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
body { font-family: 'Segoe UI', sans-serif; background:#f8faf5; overflow-x:hidden; }

.sidebar {
  position: fixed; top: 0; left: 0; width: 260px; height: 100vh;
  background: rgba(47, 122, 50, 0.95); backdrop-filter: blur(10px);
  box-shadow: 2px 0 12px rgba(0,0,0,0.15); display:flex; flex-direction:column;
  z-index:1050; transition:all .3s;
}
.sidebar-header { text-align:center; padding:30px 15px 15px; }
.sidebar-header img { border:3px solid #fff; border-radius:50%; }
.sidebar-header h6 { margin:10px 0 0; color:#fff; }
.sidebar-header small { color:#ddd; }
.sidebar-menu { list-style:none; padding:0; margin-top:20px; }
.sidebar-menu li { margin:8px 0; }
.sidebar-menu a { display:flex; align-items:center; padding:12px 20px; color:#f1f1f1; text-decoration:none; font-weight:500; border-radius:8px; transition:.3s; }
.sidebar-menu a i { font-size:20px; margin-right:12px; }
.sidebar-menu li.active a, .sidebar-menu a:hover { background:#fff; color:#2f7a32; font-weight:600; }
.logout-section { margin-top:auto; text-align:center; padding:20px; }

.navbar {
  background: linear-gradient(90deg, #2f7a32, #4caf50);
  box-shadow:0 2px 8px rgba(0,0,0,0.25); height:60px;
}
.navbar .container-fluid { margin-left:260px; }
.navbar-brand { color:#fff; font-weight:700; font-size:1.3rem; }
.navbar-brand i { margin-right:10px; color:#ffeb3b; }

.content { margin-left:260px; padding:20px; }
.product-section { background: #fff; border-radius:20px; padding:30px; box-shadow:0 8px 20px rgba(0,0,0,0.1); }
.product-img { width:100%; max-height:400px; object-fit:cover; border-radius:15px; box-shadow:0 4px 10px rgba(0,0,0,0.15); }
.product-title { font-size:2rem; font-weight:700; color:#2f7a32; }
.price { font-size:1.5rem; font-weight:700; color:#e65100; }
.related-card img { height:180px; object-fit:cover; border-radius:12px; }
.related-card .card-body { text-align:center; }
.btn-cart { background:#2f7a32; color:#fff; border-radius:30px; padding:6px 12px; transition:.3s; }
.btn-cart:hover { background:#256027; }

footer { background:#2f7a32; color:#fff; text-align:center; padding:20px; margin-top:40px; }
footer i { margin:0 8px; }

@media(max-width:768px){
  .sidebar { left:-260px; }
  .sidebar.active { left:0; }
  .content { margin-left:0; }
  .navbar .container-fluid { margin-left:0; }
}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container-fluid">
    <button class="btn btn-light d-lg-none me-2" id="sidebarToggle"><i class="bi bi-list"></i></button>
    <a class="navbar-brand" href="{{ route('buyer.dashboard') }}"><i class="bi bi-shop"></i> Farmer's Market</a>
    <div class="ms-auto d-flex align-items-center">
      <a class="nav-link me-3" href="{{ route('buyer.cart') }}"><i class="bi bi-cart fs-5"></i> My Cart</a>
      <div class="dropdown">
        <a class="d-flex align-items-center dropdown-toggle" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-person-circle fs-4 me-2"></i>
          <span>{{ auth()->user()->FullName }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="{{ route('buyer.dashboard') }}">Dashboard</a></li>
          <li><a class="dropdown-item" href="{{ route('buyer.orders') }}">My Orders</a></li>
          <li><a class="dropdown-item" href="{{ route('buyer.profile') }}">Profile</a></li>
          <li><a class="dropdown-item" href="{{ route('buyer.support') }}">Support</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item text-danger">Logout</button>
            </form></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div id="sidebar" class="sidebar">
  <div class="sidebar-header">
    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" width="70" height="70" alt="User">
    <h6>{{ auth()->user()->FullName }}</h6>
    <small>Buyer Dashboard</small>
  </div>
  <ul class="sidebar-menu">
    <li><a href="{{ route('buyer.dashboard') }}"><i class="bi bi-house-door"></i> Dashboard</a></li>
    <li><a href="{{ route('buyer.cart') }}"><i class="bi bi-cart"></i> My Cart</a></li>
    <li><a href="{{ route('buyer.orders') }}"><i class="bi bi-bag-check"></i> My Orders</a></li>
    <li><a href="{{ route('buyer.profile') }}"><i class="bi bi-person"></i> Profile</a></li>
    <li><a href="{{ route('buyer.support') }}"><i class="bi bi-headset"></i> Support</a></li>
  </ul>
  <div class="logout-section">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-danger w-100"><i class="bi bi-box-arrow-right"></i> Logout</button>
    </form>
  </div>
</div>

<div class="content container">
  <div class="row product-section g-4">
    <div class="col-md-6">
      @if($product->Image)
        <img src="{{ asset('storage/' . $product->Image) }}" alt="{{ $product->ProductName }}" class="product-img">
      @else
        <div class="product-img d-flex align-items-center justify-content-center bg-light">
          <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
        </div>
      @endif
    </div>
    <div class="col-md-6">
      <h2 class="product-title">{{ $product->ProductName }}</h2>
      <p class="text-muted"><strong>Category:</strong> {{ $product->Category }}</p>
      <p>{{ $product->Description }}</p>
      <p><strong>Available Stock:</strong> {{ $product->Quantity }} units</p>
      <p class="price">₹{{ $product->Price }} / unit</p>
      <div class="d-flex gap-3 mt-4">
        <form method="POST" action="{{ route('buyer.addToCart') }}" class="d-inline">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->ProductID }}">
          <input type="number" name="quantity" value="1" min="1" max="{{ $product->Quantity }}" class="form-control d-inline w-auto me-2">
          <button type="submit" class="btn btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</button>
        </form>
        <a href="{{ route('buyer.dashboard') }}" class="btn btn-outline-success"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
      </div>
    </div>
  </div>

  <div class="mt-5">
    <h4 class="text-success fw-bold mb-3">Related Products</h4>
    <div class="row g-3">
      @forelse($relatedProducts as $rel)
        <div class="col-6 col-md-3">
          <div class="card related-card">
            <a href="{{ route('buyer.productDetail', $rel->ProductID) }}">
              @if($rel->Image)
                <img src="{{ asset('storage/' . $rel->Image) }}" alt="{{ $rel->ProductName }}" class="card-img-top">
              @else
                <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 180px;">
                  <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                </div>
              @endif
            </a>
            <div class="card-body">
              <h6 class="fw-bold text-truncate">{{ $rel->ProductName }}</h6>
              <p class="text-muted">₹{{ $rel->Price }} / unit</p>
              <a href="{{ route('buyer.productDetail', $rel->ProductID) }}" class="btn btn-sm btn-cart w-100">View</a>
            </div>
          </div>
        </div>
      @empty
        <p class="text-muted">No related products found.</p>
      @endforelse
    </div>
  </div>
</div>

<footer>
  <p>© 2025 Farmer's Market | Connecting Farmers & Buyers</p>
  <div>
    <i class="bi bi-facebook"></i>
    <i class="bi bi-instagram"></i>
    <i class="bi bi-twitter"></i>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const sidebar = document.getElementById("sidebar");
const toggle = document.getElementById("sidebarToggle");
toggle?.addEventListener("click", () => sidebar.classList.toggle("active"));
</script>
</body>
</html>
