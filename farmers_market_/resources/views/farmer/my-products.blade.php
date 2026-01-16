<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>My Products - Farmer Panel</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
:root {
  --primary-color: #2ecc71;
  --primary-dark: #27ae60;
  --secondary-color: #3498db;
  --accent-color: #e74c3c;
  --warning-color: #f39c12;
  --dark-color: #2c3e50;
  --light-color: #ecf0f1;
  --sidebar-bg: #2c3e50;
  --sidebar-hover: #34495e;
  --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  --card-hover-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
}

* {
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family: 'Inter', sans-serif;
}

body {
  background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
  display:flex;
  min-height:100vh;
  color: var(--dark-color);
}

/* Sidebar */
.sidebar {
    width: 260px;
    background: var(--sidebar-bg);
    color:#fff;
    position:fixed;
    height:100%;
    display:flex;
    flex-direction:column;
    padding:25px 0;
    transition: all 0.3s ease;
    box-shadow: 5px 0 15px rgba(0,0,0,0.1);
    z-index: 1000;
}

.sidebar h2 {
  text-align:center;
  font-weight:700;
  margin-bottom:40px;
  font-size:1.8rem;
  letter-spacing:1px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.sidebar h2::before {
  content: "🌱";
  font-size: 1.5rem;
}

.sidebar a {
  display:flex;
  align-items:center;
  padding:14px 25px;
  color:#fff;
  text-decoration:none;
  font-weight:500;
  transition: all 0.3s ease;
  border-radius:0;
  margin:0;
  position: relative;
}

.sidebar a::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 4px;
  background: var(--primary-color);
  transform: scaleY(0);
  transition: transform 0.3s ease;
}

.sidebar a:hover, .sidebar a.active {
  background: var(--sidebar-hover);
}

.sidebar a:hover::before, .sidebar a.active::before {
  transform: scaleY(1);
}

.sidebar a i {
  margin-right:15px;
  font-size:1.2rem;
  width: 25px;
  text-align: center;
}

.sidebar form {
  margin-top: auto;
  border-top: 1px solid rgba(255,255,255,0.1);
  padding-top: 15px;
}

.sidebar form button {
  width: 100%;
  text-align: center;
  color: #fff;
  padding: 16px 25px;
  font-weight: 600;
  font-size: 1rem;
  transition: all 0.3s ease;
  background: var(--accent-color);
  border: 2px solid var(--accent-color);
  border-radius: 10px;
  margin-top: 15px;
  position: relative;
  overflow: hidden;
  letter-spacing: 0.5px;
  box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.sidebar form button:hover {
  background: #c0392b;
  border-color: #c0392b;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(231, 76, 60, 0.6);
}

.sidebar form button:active {
  transform: translateY(0);
  box-shadow: 0 2px 10px rgba(231, 76, 60, 0.4);
}

/* Main */
.main {
  margin-left:260px;
  padding:30px;
  flex:1;
  width: calc(100% - 260px);
}

.header {
  background:#fff;
  padding:30px;
  border-radius:16px;
  box-shadow:var(--card-shadow);
  margin-bottom:30px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header-content h1 {
  font-weight:700;
  font-size:2rem;
  color: var(--dark-color);
  margin-bottom: 5px;
}

.header-content p {
  color:#7f8c8d;
  font-size: 1rem;
}

.header-actions {
  display: flex;
  gap: 15px;
}

/* Products Grid */
.products-grid {
  display:grid;
  grid-template-columns:repeat(auto-fill, minmax(320px,1fr));
  gap:25px;
  margin-bottom: 30px;
}

/* Product Card */
.product-card {
    background:#fff;
    border-radius:16px;
    box-shadow:var(--card-shadow);
    overflow:hidden;
    transition: all 0.3s ease;
    position: relative;
}

.product-card::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 5px;
  background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow:var(--card-hover-shadow);
}

.product-image {
  width:100%;
  height:220px;
  overflow:hidden;
  position: relative;
}

.product-image img {
  width:100%;
  height:100%;
  object-fit:cover;
  transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
  transform: scale(1.05);
}

.product-image .no-image {
  height:220px;
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  display:flex;
  align-items:center;
  justify-content:center;
  color:#6c757d;
  font-size:3rem;
}

.product-details {
  padding:20px;
}

.product-details h3 {
  font-weight:600;
  color: var(--dark-color);
  margin-bottom:15px;
  font-size:1.2rem;
  display: flex;
  align-items: center;
  gap: 8px;
}

.product-details h3 i {
  color: var(--primary-color);
  font-size: 1rem;
}

.product-details p {
  margin:8px 0;
  color:#5d6d7e;
  font-size:0.95rem;
  display: flex;
  justify-content: space-between;
}

.product-details p strong {
  color: var(--dark-color);
  font-weight: 600;
}

.product-actions {
  padding:15px 20px;
  background:#f8f9fa;
  border-top:1px solid #e9ecef;
  display: flex;
  gap: 10px;
  justify-content: flex-end;
}

/* Buttons */
.btn {
  padding:10px 20px;
  border:none;
  border-radius:8px;
  font-weight:500;
  transition: all 0.3s ease;
  cursor: pointer;
  text-decoration:none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 0.9rem;
}

.btn-primary {
  background: var(--secondary-color);
  color:#fff;
}

.btn-primary:hover {
  background:#2980b9;
  transform: translateY(-2px);
}

.btn-success {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  color:#fff;
}

.btn-success:hover {
  background: linear-gradient(135deg, var(--primary-dark), #229954);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* Alerts */
.alert {
  padding:16px 20px;
  border-radius:10px;
  margin-bottom:25px;
  border: none;
  display: flex;
  align-items: center;
  gap: 10px;
}

.alert-success {
  background: linear-gradient(135deg, #d4edda, #c3e6cb);
  color: #155724;
}

.alert-info {
  background: linear-gradient(135deg, #d1ecf1, #bee5eb);
  color: #0c5460;
  text-align: center;
  justify-content: center;
  flex-direction: column;
  padding: 30px 20px;
}

.alert-info h4 {
  margin-bottom: 10px;
  font-size: 1.2rem;
}

.alert-info p {
  margin: 0;
  font-size: 1rem;
}

/* Footer */
.footer {
  text-align: center;
  padding: 20px;
  color: #7f8c8d;
  font-size: 0.9rem;
}

/* Responsive */
@media(max-width:768px) {
    .sidebar { width:70px; }
    .sidebar h2 { font-size:1.2rem; }
    .sidebar h2::before { font-size: 1rem; }
    .sidebar h2 span { display:none; }
    .sidebar a span { display:none; }
    .sidebar a { justify-content: center; padding: 15px 0; }
    .sidebar a i { margin: 0; }
    .sidebar form button { justify-content: center; padding: 15px 0; }
    .sidebar form button i { margin: 0; }
    .sidebar form button span { display:none; }
    .main { margin-left:70px; padding:20px; width: calc(100% - 70px); }
    .products-grid { grid-template-columns:1fr; }
    .header { flex-direction: column; align-items: flex-start; gap: 15px; }
    .header-actions { flex-direction: column; width: 100%; }
    .product-actions { flex-direction: column; }
}

/* Active state handled by .active class */
</style>
</head>
<body>

<div class="sidebar">
  <h2><span>Farmer</span></h2>
  <a href="{{ route('farmer.dashboard') }}"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a>
  <a href="{{ route('farmer.addProduct') }}"><i class="fas fa-plus-circle"></i> <span>Add Product</span></a>
  <a href="{{ route('farmer.myProducts') }}" class="active"><i class="fas fa-box"></i> <span>My Products</span></a>
  <a href="{{ route('farmer.orders') }}"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a>
  <a href="{{ route('farmer.profile') }}"><i class="fas fa-user"></i> <span>Profile</span></a>
  <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" style="background: var(--accent-color); border: 2px solid var(--accent-color); color: #fff; cursor: pointer; padding: 16px 25px; font: inherit; display: flex; align-items: center; width: 100%; border-radius: 10px; font-weight: 600; font-size: 1rem; letter-spacing: 0.5px;"></i> <span>Logout</span></button>
  </form>
</div>

<div class="main">
  <div class="header">
    <div class="header-content">
      <h1>My Products</h1>
      <p>Manage your products here. Edit or delete as needed.</p>
    </div>
    <div class="header-actions">
      <a href="{{ route('farmer.addProduct') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add New Product
      </a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i>
      {{ session('success') }}
    </div>
  @endif

  <div class="products-grid">
    @forelse($products as $product)
      <div class="product-card">
        <div class="product-image">
          @if($product->Image)
            <img src="{{ asset('storage/' . $product->Image) }}" alt="{{ $product->ProductName }}">
          @else
            <div class="no-image">
              <i class="fas fa-image"></i>
            </div>
          @endif
        </div>
        <div class="product-details">
          <h3><i class="fas fa-seedling"></i> {{ $product->ProductName }}</h3>
          <p><span>Category:</span> <strong>{{ $product->Category }}</strong></p>
          <p><span>Price:</span> <strong>₹{{ number_format($product->Price, 2) }}</strong></p>
          <p><span>Quantity:</span> <strong>{{ $product->Quantity }}</strong></p>
          @if($product->Description)
            <p><span>Description:</span> <strong>{{ Str::limit($product->Description, 80) }}</strong></p>
          @endif
        </div>
        <div class="product-actions">
          <a href="{{ route('farmer.editProduct', $product->ProductID) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit
          </a>
          <form method="POST" action="{{ route('farmer.deleteProduct', $product->ProductID) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary" style="background: var(--accent-color);" onclick="return confirm('Are you sure you want to delete this product?');">
              <i class="fas fa-trash"></i> Delete
            </button>
          </form>
        </div>
      </div>
    @empty
      <div class="alert alert-info" style="grid-column: 1 / -1;">
        <i class="fas fa-inbox fa-2x" style="margin-bottom: 15px; opacity: 0.7;"></i>
        <h4>No products found</h4>
        <p>You haven't added any products yet.</p>
        <a href="{{ route('farmer.addProduct') }}" class="btn btn-success" style="margin-top: 15px;">
          <i class="fas fa-plus"></i> Add Your First Product
        </a>
      </div>
    @endforelse
  </div>

  <div class="footer">
    © 2025 Farmer's Market Dashboard | Powered by FarmConnect
  </div>
</div>

</body>
</html>
