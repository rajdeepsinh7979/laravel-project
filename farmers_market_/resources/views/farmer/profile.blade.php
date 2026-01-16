<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>My Profile - Farmer Panel</title>
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

/* Profile Cards */
.profile-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
  gap: 25px;
  margin-bottom: 30px;
}

/* Profile Card */
.profile-card {
    background:#fff;
    border-radius:16px;
    box-shadow:var(--card-shadow);
    overflow:hidden;
    transition: all 0.3s ease;
    position: relative;
}

.profile-card::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 5px;
  background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
}

.profile-card:hover {
  transform: translateY(-5px);
  box-shadow:var(--card-hover-shadow);
}

.profile-header {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  color: white;
  padding: 30px 25px;
  text-align: center;
}

.profile-avatar {
  width: 100px;
  height: 100px;
  background: rgba(255, 255, 255, 0.2);
  border: 4px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2.5rem;
  font-weight: 700;
  margin: 0 auto 15px;
  backdrop-filter: blur(10px);
}

.profile-header h3 {
  margin: 0;
  font-size: 1.5rem;
  font-weight: 600;
}

.profile-header p {
  margin: 5px 0 0 0;
  opacity: 0.9;
  font-size: 0.95rem;
}

.profile-details {
  padding: 25px;
}

.detail-group {
  margin-bottom: 20px;
  padding: 15px;
  background: #f8f9fa;
  border-radius: 10px;
  border-left: 4px solid var(--secondary-color);
}

.detail-group h4 {
  margin: 0 0 10px 0;
  font-size: 0.9rem;
  color: #6c757d;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 600;
}

.detail-group p {
  margin: 0;
  font-size: 1rem;
  color: var(--dark-color);
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 8px;
}

.detail-group p i {
  color: var(--primary-color);
  font-size: 1rem;
}

.profile-actions {
  padding: 20px 25px;
  background: #f8f9fa;
  border-top: 1px solid #e9ecef;
  display: flex;
  gap: 15px;
  justify-content: center;
}

/* Buttons */
.btn {
  padding:12px 24px;
  border:none;
  border-radius:10px;
  font-weight:600;
  transition: all 0.3s ease;
  cursor: pointer;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 0.95rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.btn-primary {
  background: var(--secondary-color);
  color:#fff;
  box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
}

.btn-primary:hover {
  background:#2980b9;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
}

.btn-secondary {
  background: var(--warning-color);
  color:#fff;
  box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
}

.btn-secondary:hover {
  background:#e67e22;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4);
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
    .profile-grid { grid-template-columns: 1fr; }
    .header { flex-direction: column; align-items: flex-start; gap: 15px; }
    .profile-actions { flex-direction: column; }
}

/* Active state handled by .active class */
</style>
</head>
<body>

<div class="sidebar">
  <h2><span>Farmer</span></h2>
  <a href="{{ route('farmer.dashboard') }}"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a>
  <a href="{{ route('farmer.addProduct') }}"><i class="fas fa-plus-circle"></i> <span>Add Product</span></a>
  <a href="{{ route('farmer.myProducts') }}"><i class="fas fa-box"></i> <span>My Products</span></a>
  <a href="{{ route('farmer.orders') }}"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a>
  <a href="{{ route('farmer.profile') }}" class="active"><i class="fas fa-user"></i> <span>Profile</span></a>
  <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" style="background: var(--accent-color); border: 2px solid var(--accent-color); color: #fff; cursor: pointer; padding: 16px 25px; font: inherit; display: flex; align-items: center; width: 100%; border-radius: 10px; font-weight: 600; font-size: 1rem; letter-spacing: 0.5px;"></i> <span>Logout</span></button>
  </form>
</div>

<div class="main">
  <div class="header">
    <div class="header-content">
      <h1>My Profile</h1>
      <p>Manage your personal information and account settings.</p>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i>
      {{ session('success') }}
    </div>
  @endif

  <div class="profile-grid">
    <div class="profile-card">
      <div class="profile-header">
        <div class="profile-avatar">
          {{ strtoupper(substr($user->FullName, 0, 1)) }}
        </div>
        <h3>{{ $user->FullName }}</h3>
        <p>{{ $user->Role }}</p>
      </div>

      <div class="profile-details">
        <div class="detail-group">
          <h4>Personal Information</h4>
          <p><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $user->Email }}</p>
          <p><i class="fas fa-phone"></i> <strong>Phone:</strong> {{ $user->Phone ?? 'Not provided' }}</p>
          <p><i class="fas fa-venus-mars"></i> <strong>Gender:</strong> {{ $user->Gender ?? 'Not specified' }}</p>
        </div>

        <div class="detail-group">
          <h4>Farm Information</h4>
          <p><i class="fas fa-tractor"></i> <strong>Farm Name:</strong> {{ $user->FarmName ?? 'Not provided' }}</p>
          <p><i class="fas fa-info-circle"></i> <strong>About:</strong> {{ $user->About ?? 'Not provided' }}</p>
        </div>
      </div>

      <div class="profile-actions">
        <a href="{{ route('farmer.updateProfile') }}" class="btn btn-primary">
          <i class="fas fa-edit"></i> Edit Profile
        </a>
        <a href="{{ route('farmer.changePassword') }}" class="btn btn-secondary">
          <i class="fas fa-key"></i> Change Password
        </a>
      </div>
    </div>

    <div class="profile-card">
      <div class="profile-details" style="padding-top: 30px;">
        <div class="detail-group">
          <h4>Account Statistics</h4>
          <p><i class="fas fa-calendar"></i> <strong>Member Since:</strong> {{ date('F Y', strtotime($user->created_at ?? 'now')) }}</p>
          <p><i class="fas fa-shield-alt"></i> <strong>Account Status:</strong> Active</p>
          <p><i class="fas fa-star"></i> <strong>Account Type:</strong> {{ ucfirst($user->Role) }}</p>
        </div>

        <div class="detail-group">
          <h4>Quick Actions</h4>
          <p><i class="fas fa-bell"></i> <strong>Notifications:</strong> Enabled</p>
          <p><i class="fas fa-lock"></i> <strong>Security:</strong> Secure</p>
          <p><i class="fas fa-cog"></i> <strong>Preferences:</strong> Configured</p>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    © 2025 Farmer's Market Dashboard | Powered by FarmConnect
  </div>
</div>

</body>
</html>
