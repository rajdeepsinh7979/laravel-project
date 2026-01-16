<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Orders - Farmer Panel</title>
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
  width:100%;
  text-align:left;
  color: #fff;
  padding: 14px 25px;
  font-weight: 500;
  transition: all 0.3s ease;
  background: rgba(231, 76, 60, 0.1);
  border: 1px solid rgba(231, 76, 60, 0.3);
  border-radius: 8px;
  margin-top: 10px;
}

.sidebar form button:hover {
  background: var(--accent-color);
  border-color: var(--accent-color);
  transform: translateX(5px);
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

/* Orders Grid */
.orders-grid {
  display:grid;
  grid-template-columns:repeat(auto-fill, minmax(400px,1fr));
  gap:25px;
  margin-bottom: 30px;
}

/* Order Card */
.order-card {
    background:#fff;
    border-radius:16px;
    box-shadow:var(--card-shadow);
    overflow:hidden;
    transition: all 0.3s ease;
    position: relative;
}

.order-card::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 5px;
  background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
}

.order-card:hover {
  transform: translateY(-5px);
  box-shadow:var(--card-hover-shadow);
}

.order-header {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  color: white;
  padding: 20px 25px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.order-id {
  font-size: 1.2rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 8px;
}

.order-id i {
  font-size: 1rem;
}

.order-date {
  font-size: 0.95rem;
  opacity: 0.9;
  display: flex;
  align-items: center;
  gap: 5px;
}

.order-date i {
  font-size: 0.9rem;
}

.order-info {
  padding: 25px;
}

.order-info p {
  margin: 12px 0;
  font-size: 1rem;
  color: var(--dark-color);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 0;
  border-bottom: 1px solid #f1f3f4;
}

.order-info p:last-child {
  border-bottom: none;
}

.order-info strong {
  color: var(--dark-color);
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 8px;
}

.order-info strong i {
  color: var(--primary-color);
  font-size: 1rem;
}

.status {
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.status.pending {
  background: linear-gradient(135deg, #f39c12, #e67e22);
  color: white;
}

.status.delivered {
  background: linear-gradient(135deg, #2ecc71, #27ae60);
  color: white;
}

.status.cancelled {
  background: linear-gradient(135deg, #e74c3c, #c0392b);
  color: white;
}

.order-actions {
  padding: 20px 25px;
  background: #f8f9fa;
  border-top: 1px solid #e9ecef;
  display: flex;
  gap: 15px;
  justify-content: center;
}

/* Buttons */
.btn {
  padding:12px 20px;
  border:none;
  border-radius:10px;
  font-weight:600;
  transition: all 0.3s ease;
  cursor: pointer;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.btn-deliver {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  color:#fff;
  box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
}

.btn-deliver:hover:not(:disabled) {
  background: linear-gradient(135deg, var(--primary-dark), #229954);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(46, 204, 113, 0.4);
}

.btn-deliver:disabled {
  background: #bdc3c7;
  cursor: not-allowed;
  transform: none;
  box-shadow: none;
}

.btn-cancel {
  background: linear-gradient(135deg, var(--accent-color), #c0392b);
  color:#fff;
  box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.btn-cancel:hover:not(:disabled) {
  background: linear-gradient(135deg, #c0392b, #a93226);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
}

.btn-cancel:disabled {
  background: #bdc3c7;
  cursor: not-allowed;
  transform: none;
  box-shadow: none;
}

/* Alerts */
.alert {
  padding:16px 20px;
  border-radius:10px;
  margin-bottom:25px;
  border: none;
  display: flex;
  align-items: center;
  gap: 12px;
}

.alert-success {
  background: linear-gradient(135deg, #d4edda, #c3e6cb);
  color: #155724;
}

.alert-danger {
  background: linear-gradient(135deg, #f8d7da, #f5c6cb);
  color: #721c24;
}

.alert-info {
  background: linear-gradient(135deg, #d1ecf1, #bee5eb);
  color: #0c5460;
  text-align: center;
  justify-content: center;
  flex-direction: column;
  padding: 40px 20px;
  grid-column: 1 / -1;
}

.alert-info h4 {
  margin-bottom: 10px;
  font-size: 1.3rem;
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
    .orders-grid { grid-template-columns: 1fr; }
    .header { flex-direction: column; align-items: flex-start; gap: 15px; }
    .order-header { flex-direction: column; align-items: flex-start; gap: 10px; }
    .order-actions { flex-direction: column; }
}

/* Active state handled by .active class */

/* Loading state */
.btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none !important;
}
</style>
</head>
<body>

<div class="sidebar">
  <h2><span>Farmer</span></h2>
  <a href="{{ route('farmer.dashboard') }}"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a>
  <a href="{{ route('farmer.addProduct') }}"><i class="fas fa-plus-circle"></i> <span>Add Product</span></a>
  <a href="{{ route('farmer.myProducts') }}"><i class="fas fa-box"></i> <span>My Products</span></a>
  <a href="{{ route('farmer.orders') }}" class="active"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a>
  <a href="{{ route('farmer.profile') }}"><i class="fas fa-user"></i> <span>Profile</span></a>
  <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" style="background: var(--accent-color); border: 2px solid var(--accent-color); color: #fff; cursor: pointer; padding: 16px 25px; font: inherit; display: flex; align-items: center; width: 100%; border-radius: 10px; font-weight: 600; font-size: 1rem; letter-spacing: 0.5px;"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
  </form>
</div>

<div class="main">
  <div class="header">
    <div class="header-content">
      <h1>Orders</h1>
      <p>View and manage your orders here. Track deliveries and update order status.</p>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i>
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">
      <i class="fas fa-exclamation-triangle"></i>
      {{ session('error') }}
    </div>
  @endif

  <div class="orders-grid">
    @forelse($orders as $order)
      <div class="order-card">
        <div class="order-header">
          <div class="order-id">
            <i class="fas fa-hashtag"></i>
            {{ $order->OrderID }}
          </div>
          <div class="order-date">
            <i class="fas fa-calendar"></i>
            {{ date("d M Y", strtotime($order->OrderDate)) }}
          </div>
        </div>
        <div class="order-info">
          <p><strong><i class="fas fa-user"></i> Buyer:</strong> {{ $order->BuyerName }}</p>
          <p><strong><i class="fas fa-box"></i> Products:</strong> {{ $order->Products }}</p>
          <p><strong><i class="fas fa-rupee-sign"></i> Total:</strong> ₹{{ number_format($order->TotalAmount, 2) }}</p>
          <p><strong><i class="fas fa-info-circle"></i> Status:</strong> <span class="status {{ strtolower($order->Status) }}">{{ $order->Status }}</span></p>
        </div>
        <div class="order-actions">
          @if($order->Status == 'Pending')
            <form method="POST" action="{{ route('farmer.updateOrderStatus') }}" style="display: inline;">
              @csrf
              <input type="hidden" name="order_id" value="{{ $order->OrderID }}">
              <button type="submit" name="action" value="deliver" class="btn btn-deliver">
                <i class="fas fa-truck"></i> Deliver
              </button>
              <button type="submit" name="action" value="cancel" class="btn btn-cancel">
                <i class="fas fa-times"></i> Cancel
              </button>
            </form>
          @else
            <button class="btn btn-deliver" disabled>
              <i class="fas fa-check"></i> {{ $order->Status == 'Delivered' ? 'Delivered' : 'Cancelled' }}
            </button>
          @endif
        </div>
      </div>
    @empty
      <div class="alert alert-info">
        <i class="fas fa-inbox fa-2x" style="margin-bottom: 15px; opacity: 0.7;"></i>
        <h4>No orders found</h4>
        <p>You don't have any orders yet. Start by adding products to attract buyers!</p>
      </div>
    @endforelse
  </div>

  <div class="footer">
    © 2025 Farmer's Market Dashboard | Powered by FarmConnect
  </div>
</div>

</body>
</html>
