<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Farmer's Market - Dashboard</title>
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

.hero {
  position: relative;
  border-radius: 15px;
  color: #fff;
  padding: 80px 30px;
  margin: 25px 0;
  text-align: center;
  overflow: hidden;
  font-weight:bold;
}
.hero::before {
  content:"";
  position:absolute;
  inset:0;
  background:rgba(0,0,0,0.4);
  border-radius:15px;
  z-index:1;
}
.hero h1, .hero p, .hero a {
  position:relative;
  z-index:2;
}

/* Products */
.category-btns { overflow-x:auto; white-space:nowrap; padding-bottom:10px; }
.category-btns a { border-radius:30px; padding:8px 18px; margin:4px; }
.product-card {
  border-radius:15px; overflow:hidden;
  box-shadow:0 3px 8px rgba(0,0,0,0.1); transition:all .3s;
}
.product-card:hover { transform:translateY(-5px); box-shadow:0 6px 16px rgba(0,0,0,0.15); }
.product-card img { height:200px; object-fit:cover; }
.price { color:#2f7a32; font-size:1.2rem; font-weight:600; }
.btn-cart { background:#2f7a32; color:#fff; border-radius:30px; padding:8px 15px; }
.btn-cart:hover { background:#256027; }

/* Toast */
.toast-container { position:fixed; top:20px; right:20px; z-index:2000; }

/* Footer */
footer { background:#2f7a32; color:#fff; text-align:center; padding:20px; margin-top:40px; }
footer i { margin:0 8px; }

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
    <li class="active">
      <a href="{{ route('buyer.dashboard') }}"><i class="bi bi-house-door"></i>Dashboard</a>
    </li>
    <li>
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
    @if ($addedToCart)
      <div class="toast-container">
        <div class="toast align-items-center text-bg-success border-0 show">
          <div class="d-flex">
            <div class="toast-body">✅ Product added to cart successfully!</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
          </div>
        </div>
      </div>
    @endif

    <!-- Hero -->
    <div class="hero text-white" style="background: url('{{ asset('assets/buyerback.jpg') }}') center/cover no-repeat;">
      <h1>Welcome, {{ $buyerName }} 👋</h1>
      <p>Shop fresh produce directly from trusted farmers.</p>
      <a href="#products" class="btn btn-light btn-lg">Start Shopping</a>
    </div>

    <!-- Categories -->
    <div class="text-center category-btns mb-4">
      @php
        $categories = ["All","Fruits","Vegetables","Grains","Dairy"];
      @endphp
      @foreach($categories as $cat)
        <a href="{{ $cat === 'All' ? route('buyer.dashboard') : route('buyer.dashboard', $cat) }}" class="btn {{ $categoryFilter == $cat ? 'btn-success' : 'btn-outline-success' }}">
          {{ $cat }}
        </a>
      @endforeach
    </div>

    <!-- Products -->
    <h3 id="products" class="text-success fw-bold mb-4 text-center">Fresh Arrivals</h3>
    <div class="row g-4">
      @if (!empty($products))
        @foreach ($products as $product)
          <div class="col-6 col-md-4 col-lg-3">
            <div class="card product-card">
              <a href="{{ route('buyer.productDetail', $product->ProductID) }}">
                @if($product->Image)
                  <img src="{{ asset('storage/' . $product->Image) }}" class="card-img-top" alt="{{ $product->ProductName }}">
                @else
                  <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                  </div>
                @endif
              </a>
              <div class="card-body text-center">
                <h6 class="card-title fw-bold">{{ $product->ProductName }}</h6>
                <p class="price">₹{{ number_format($product->Price) }}</p>
                <form method="post" action="{{ route('buyer.addToCart') }}">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->ProductID }}">
                  <input type="number" name="quantity" value="1" min="1" max="{{ $product->Quantity }}" class="form-control mb-2">
                  <button type="submit" class="btn btn-cart w-100"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <p class="text-center text-muted">No products found in this category.</p>
      @endif
    </div>
  </div>
</div>

<!-- Footer -->
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
toggle?.addEventListener("click", () => {
  sidebar.classList.toggle("active");
});
</script>
</body>
</html>
