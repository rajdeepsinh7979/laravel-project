<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Farmer Dashboard</title>
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
  background: #ff4757;
  border: 2px solid #ff4757;
  border-radius: 10px;
  margin-top: 15px;
  position: relative;
  overflow: hidden;
  letter-spacing: 0.5px;
  box-shadow: 0 4px 15px rgba(255, 71, 87, 0.3);
}

.sidebar form button:hover {
  background: #ff3742;
  border-color: #ff3742;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(255, 71, 87, 0.6);
}

.sidebar form button:active {
  transform: translateY(0);
  box-shadow: 0 2px 10px rgba(255, 71, 87, 0.4);
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

.header-date {
  text-align: right;
  color: #7f8c8d;
  font-size: 0.9rem;
}

/* Cards */
.cards { 
  display:grid; 
  grid-template-columns:repeat(auto-fit, minmax(300px,1fr)); 
  gap:25px; 
  margin-bottom:30px; 
}

.card {
    background:#fff;
    padding:25px; 
    border-radius:16px; 
    box-shadow:var(--card-shadow); 
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.card::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 5px;
  background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
}

.card:hover { 
  transform: translateY(-5px); 
  box-shadow:var(--card-hover-shadow); 
}

.card h2 { 
  font-weight:600; 
  color: var(--dark-color); 
  margin-bottom:20px; 
  font-size:1.3rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.card h2 i {
  font-size: 1.2rem;
  color: var(--primary-color);
}

.card p { 
  font-size:1rem; 
  margin:12px 0; 
  color:#5d6d7e;
  display: flex;
  justify-content: space-between;
}

.card p strong { 
  color: var(--dark-color);
  font-weight: 600;
}

.card ul {
  margin-top: 10px;
  padding-left: 20px;
}

.card ul li {
  margin: 8px 0;
  color: #5d6d7e;
  display: flex;
  justify-content: space-between;
}

.card ul li strong {
  color: var(--dark-color);
}

.card p span.status { 
  font-weight:600; 
  padding:4px 10px; 
  border-radius:20px; 
  color:#fff; 
  font-size:0.85rem;
  display: inline-block;
}

.status.Pending { 
  background: var(--warning-color); 
}

.status.Delivered { 
  background: var(--primary-color); 
}

.status.Shipped { 
  background: var(--secondary-color); 
}

/* Recent Orders Table */
.table-container { 
  background:#fff; 
  padding:25px; 
  border-radius:16px; 
  box-shadow:var(--card-shadow); 
  margin-bottom:30px; 
}

.table-container h2 { 
  margin-bottom:20px;
  font-size: 1.5rem;
  color: var(--dark-color);
  display: flex;
  align-items: center;
  gap: 10px;
}

.table-container h2 i {
  color: var(--primary-color);
}

table { 
  width:100%; 
  border-collapse:collapse; 
}

th, td { 
  padding:15px 12px; 
  text-align:left; 
  border-bottom:1px solid #f1f3f4;
}

th { 
  background:#f8f9fa; 
  color: var(--dark-color);
  font-weight: 600;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

tr:hover { 
  background:#f8f9fa; 
}

td {
  font-size: 0.95rem;
}

/* Low Stock Alert */
.low-stock { 
  background:#fff8e1; 
  border-left:4px solid var(--warning-color); 
  padding:12px 15px; 
  border-radius:8px; 
  margin-bottom:15px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.low-stock::before {
  content: "⚠️";
  font-size: 1.1rem;
}

/* Buttons */
.btn { 
  padding:10px 20px; 
  border:none; 
  border-radius:8px; 
  font-weight:500; 
  transition: all 0.3s ease;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-primary { 
  background: var(--secondary-color); 
  color:#fff; 
}

.btn-primary:hover { 
  background:#2980b9; 
}

.btn-success { 
  background: var(--primary-color); 
  color:#fff; 
}

.btn-success:hover { 
  background: var(--primary-dark); 
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
    .cards { grid-template-columns:1fr; }
    .header { flex-direction: column; align-items: flex-start; gap: 15px; }
    .header-date { text-align: left; }
    .table-container { overflow-x: auto; }
    table { min-width: 600px; }
}

/* Add active state for current page */
.sidebar a:nth-child(1) {
  background: var(--sidebar-hover);
}

.sidebar a:nth-child(1)::before {
  transform: scaleY(1);
}

/* Notification badge */
.notification-badge {
  position: absolute;
  top: 8px;
  right: 15px;
  background: var(--accent-color);
  color: white;
  font-size: 0.7rem;
  padding: 2px 6px;
  border-radius: 10px;
  min-width: 18px;
  text-align: center;
}

/* Loading animation */
@keyframes pulse {
  0% { opacity: 0.6; }
  50% { opacity: 1; }
  100% { opacity: 0.6; }
}

.loading {
  animation: pulse 1.5s infinite ease-in-out;
}

/* Chart container */
.chart-container {
  height: 200px;
  margin-top: 20px;
  position: relative;
}

.chart-placeholder {
  width: 100%;
  height: 100%;
  background: #f8f9fa;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #7f8c8d;
  font-style: italic;
}

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 2000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(5px);
  -webkit-backdrop-filter: blur(5px);
  justify-content: center;
  align-items: center;
  animation: fadeIn 0.3s ease-out;
}

.modal-content {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  max-width: 400px;
  width: 90%;
  max-height: 90vh;
  overflow-y: auto;
  animation: slideIn 0.3s ease-out;
}

.modal-header {
  padding: 25px 30px 15px;
  border-bottom: 1px solid #ecf0f1;
  display: flex;
  align-items: center;
  gap: 15px;
}

.modal-header i {
  font-size: 1.5rem;
  color: var(--accent-color);
}

.modal-header h3 {
  margin: 0;
  color: var(--dark-color);
  font-size: 1.3rem;
  font-weight: 600;
}

.modal-body {
  padding: 20px 30px;
  text-align: center;
}

.modal-body p {
  margin: 0 0 10px 0;
  color: var(--dark-color);
  font-size: 1rem;
  line-height: 1.5;
}

.modal-note {
  color: #7f8c8d !important;
  font-size: 0.9rem !important;
  font-style: italic;
}

.modal-footer {
  padding: 15px 30px 25px;
  border-top: 1px solid #ecf0f1;
  display: flex;
  justify-content: flex-end;
  gap: 15px;
}

.btn-secondary {
  background: #95a5a6;
  color: #fff;
}

.btn-secondary:hover {
  background: #7f8c8d;
}

.btn-danger {
  background: var(--accent-color);
  color: #fff;
}

.btn-danger:hover {
  background: #c0392b;
  box-shadow: 0 0 15px rgba(231, 76, 60, 0.5);
}

/* Modal Animations */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(-50px) scale(0.9);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

/* Responsive Modal */
@media (max-width: 480px) {
  .modal-content {
    margin: 20px;
    width: calc(100% - 40px);
  }

  .modal-header,
  .modal-body,
  .modal-footer {
    padding-left: 20px;
    padding-right: 20px;
  }

  .modal-footer {
    flex-direction: column;
    gap: 10px;
  }

  .btn {
    width: 100%;
    justify-content: center;
  }
}
</style>
</head>
<body>

<div class="sidebar">
  <h2><span>Farmer</span></h2>
  <a href="{{ route('farmer.dashboard') }}" class="active"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a>
  <a href="{{ route('farmer.addProduct') }}"><i class="fas fa-plus-circle"></i> <span>Add Product</span></a>
  <a href="{{ route('farmer.myProducts') }}"><i class="fas fa-box"></i> <span>My Products</span></a>
  <a href="{{ route('farmer.orders') }}"><i class="fas fa-shopping-cart"></i> <span>Orders</span> @if($orderStats->pending > 0)<span class="notification-badge">{{ $orderStats->pending }}</span>@endif</a>
  <a href="{{ route('farmer.profile') }}"><i class="fas fa-user"></i> <span>Profile</span></a>
  <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" style="background: var(--accent-color); border: 2px solid var(--accent-color); color: #fff; cursor: pointer; padding: 16px 25px; font: inherit; display: flex; align-items: center; width: 100%; border-radius: 10px; font-weight: 600; font-size: 1rem; letter-spacing: 0.5px;"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
  </form>
</div>

<div class="main">
  <div class="header">
    <div class="header-content">
      <h1>Welcome, {{ $farmer_name }}!</h1>
      <p>Track your sales, manage your products, and stay updated with your farm's performance all in one place.</p>
    </div>
    <div class="header-date">
      <p>{{ date('l, F d, Y') }}</p>
      <p>{{ date('h:i A') }}</p>
    </div>
  </div>

  <!-- Overview Cards -->
  <div class="cards">
    <div class="card">
      <h2><i class="fas fa-seedling"></i> Products Overview</h2>
      <p>Total Products: <strong>{{ $totalProducts }}</strong></p>
      @if(!empty($categoryCounts))
        <p>Categories:</p>
        <ul>
          @foreach($categoryCounts as $cat)
            <li>{{ $cat->Category }}: <strong>{{ $cat->count }}</strong></li>
          @endforeach
        </ul>
      @endif
      <div class="chart-container">
        <div class="chart-placeholder">Product distribution chart would appear here</div>
      </div>
    </div>
    <div class="card">
      <h2><i class="fas fa-shopping-bag"></i> Orders Overview</h2>
      <p>Total Orders: <strong>{{ $orderStats->total ?? 0 }}</strong></p>
      <p>Pending: <strong>{{ $orderStats->pending ?? 0 }}</strong></p>
      <p>Delivered: <strong>{{ $orderStats->delivered ?? 0 }}</strong></p>
      <p>Total Earnings: <strong>₹{{ number_format($totalEarnings, 2) }}</strong></p>
      <div class="chart-container">
        <div class="chart-placeholder">Sales trend chart would appear here</div>
      </div>
    </div>
    <div class="card">
      <h2><i class="fas fa-exclamation-triangle"></i> Stock Alerts</h2>
      @if(!empty($lowStock))
        @foreach($lowStock as $prod)
          <div class="low-stock">
            {{ $prod->ProductName }} - Only {{ $prod->Quantity }} left!
          </div>
        @endforeach
      @else
        <p style="display: flex; align-items: center; gap: 10px;">
          <i class="fas fa-check-circle" style="color: var(--primary-color);"></i>
          All products have sufficient stock.
        </p>
      @endif
    </div>
  </div>

  <!-- Recent Orders Table -->
  <div class="table-container">
    <h2><i class="fas fa-receipt"></i> Recent Orders</h2>
    @if($recentOrders->count() > 0)
      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Buyer</th>
            <th>Products</th>
            <th>Status</th>
            <th>Total (₹)</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach($recentOrders as $row)
          <tr>
            <td>#{{ $row->OrderID }}</td>
            <td>{{ $row->BuyerName }}</td>
            <td>{{ $row->Products }}</td>
            <td><span class="status {{ $row->Status }}">{{ $row->Status }}</span></td>
            <td>₹{{ number_format($row->TotalAmount, 2) }}</td>
            <td>{{ date("d M Y", strtotime($row->OrderDate)) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p style="display: flex; align-items: center; gap: 10px; justify-content: center; padding: 20px;">
        <i class="fas fa-inbox" style="font-size: 1.5rem; color: #bdc3c7;"></i>
        No recent orders.
      </p>
    @endif
  </div>

  <div class="footer">
    © 2025 Farmer's Market Dashboard | Powered by FarmConnect
  </div>
</div>

<!-- Custom Logout Confirmation Popup -->
<div id="logoutModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <i class="fas fa-sign-out-alt"></i>
      <h3>Confirm Logout</h3>
    </div>
    <div class="modal-body">
      <p>Are you sure you want to logout from your farmer dashboard?</p>
      <p class="modal-note">You will be redirected to the login page.</p>
    </div>
    <div class="modal-footer">
      <button id="cancelLogout" class="btn btn-secondary">Cancel</button>
      <button id="confirmLogout" class="btn btn-danger">Logout</button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const logoutButton = document.querySelector('.sidebar form button');
  const logoutModal = document.getElementById('logoutModal');
  const cancelLogout = document.getElementById('cancelLogout');
  const confirmLogout = document.getElementById('confirmLogout');
  const logoutForm = document.querySelector('.sidebar form');

  // Show modal on logout button click
  logoutButton.addEventListener('click', function(e) {
    e.preventDefault(); // Prevent form submission
    logoutModal.style.display = 'flex';
  });

  // Hide modal on cancel
  cancelLogout.addEventListener('click', function() {
    logoutModal.style.display = 'none';
  });

  // Submit form on confirm
  confirmLogout.addEventListener('click', function() {
    logoutForm.submit();
  });

  // Hide modal when clicking outside
  logoutModal.addEventListener('click', function(e) {
    if (e.target === logoutModal) {
      logoutModal.style.display = 'none';
    }
  });
});
</script>

</body>
</html>
