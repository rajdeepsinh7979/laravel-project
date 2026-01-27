<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Farmer's Market - My Profile</title>
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

.profile-card {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  padding: 30px;
  margin-bottom: 30px;
}
.profile-header {
  text-align: center;
  margin-bottom: 30px;
}
.profile-avatar {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  border: 5px solid #4caf50;
  margin: 0 auto 20px;
  object-fit: cover;
}
.form-control:focus {
  border-color: #4caf50;
  box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
}
.btn-success {
  background: linear-gradient(90deg, #2f7a32, #4caf50);
  border: none;
}
.btn-success:hover {
  background: linear-gradient(90deg, #1b5e20, #2e7d32);
}
.stats-card {
  background: linear-gradient(135deg, #4caf50, #2f7a32);
  color: white;
  border-radius: 10px;
  padding: 20px;
  text-align: center;
}
.stats-card h3 { margin: 0; font-size: 2rem; }
.stats-card p { margin: 5px 0 0 0; opacity: 0.9; }
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
    <li class="active"><a href="{{ route('buyer.profile') }}"><i class="bi bi-person"></i> Profile</a></li>
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
    <div class="col-12">
      <h2 class="text-success fw-bold mb-4"><i class="bi bi-person"></i> My Profile</h2>

      <!-- Profile Stats -->
      <div class="row mb-4">
        <div class="col-md-4">
          <div class="stats-card">
            <h3>{{ $orderCount ?? 0 }}</h3>
            <p>Total Orders</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stats-card">
            <h3>₹{{ number_format($totalSpent ?? 0) }}</h3>
            <p>Total Spent</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stats-card">
            <h3>{{ $cartCount ?? 0 }}</h3>
            <p>Items in Cart</p>
          </div>
        </div>
      </div>

      <!-- Profile Information -->
      <div class="profile-card">
        <div class="profile-header">
          <img src="https://via.placeholder.com/120" alt="Profile Picture" class="profile-avatar">
          <h4>{{ $buyerName }}</h4>
          <p class="text-muted">Buyer Account</p>
        </div>

        <form method="POST" action="{{ route('buyer.updateProfile') }}">
          @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="FullName" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="FullName" name="FullName" value="{{ $user->FullName }}" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="Email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="Email" name="Email" value="{{ $user->Email }}" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="Phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="Phone" name="Phone" value="{{ $user->Phone }}">
            </div>
            <div class="col-md-6 mb-3">
              <label for="Gender" class="form-label">Gender</label>
              <select class="form-control" id="Gender" name="Gender">
                <option value="">Select Gender</option>
                <option value="Male" {{ $user->Gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $user->Gender == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ $user->Gender == 'Other' ? 'selected' : '' }}>Other</option>
              </select>
            </div>
            <div class="col-12 mb-3">
              <label for="About" class="form-label">About Me</label>
              <textarea class="form-control" id="About" name="About" rows="4">{{ $user->About }}</textarea>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">
              <i class="bi bi-save"></i> Update Profile
            </button>
          </div>
        </form>
      </div>

      <!-- Change Password -->
      <div class="profile-card">
        <h4 class="mb-3"><i class="bi bi-shield-lock"></i> Change Password</h4>
        <form method="POST" action="{{ route('buyer.changePassword') }}">
          @csrf
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="current_password" class="form-label">Current Password</label>
              <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="new_password" class="form-label">New Password</label>
              <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="confirm_password" class="form-label">Confirm New Password</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-key"></i> Change Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
