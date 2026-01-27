<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Support Ticket - Farmer's Market</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
body { font-family: 'Segoe UI', sans-serif; background:#f9fafb; overflow-x:hidden; }

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

.ticket-card {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  padding: 30px;
  margin-bottom: 30px;
}
.ticket-header {
  text-align: center;
  margin-bottom: 30px;
}
.ticket-header h4 { color: #2f7a32; margin-bottom: 10px; }
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
</style>
</head>
<body>

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

<div class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <img src="https://via.placeholder.com/60" alt="Profile" class="rounded-circle">
    <h6>{{ auth()->user()->FullName }}</h6>
    <small>Buyer</small>
  </div>
  <ul class="sidebar-menu">
    <li><a href="{{ route('buyer.dashboard') }}"><i class="bi bi-house-door"></i> Dashboard</a></li>
    <li><a href="{{ route('buyer.cart') }}"><i class="bi bi-cart"></i> My Cart</a></li>
    <li><a href="{{ route('buyer.orders') }}"><i class="bi bi-receipt"></i> My Orders</a></li>
    <li><a href="{{ route('buyer.profile') }}"><i class="bi bi-person"></i> Profile</a></li>
    <li class="active"><a href="{{ route('buyer.support') }}"><i class="bi bi-headset"></i> Support</a></li>
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

<div class="container-fluid" style="margin-left: 250px; padding: 20px;">
  <div class="row">
    <div class="col-12">
      <h2 class="text-success fw-bold mb-4"><i class="bi bi-ticket-perforated"></i> Create Support Ticket</h2>

      <div class="ticket-card">
        <div class="ticket-header">
          <h4><i class="bi bi-headset"></i> Need Help?</h4>
          <p class="text-muted">Submit a support ticket and our team will get back to you soon.</p>
        </div>

        <form method="POST" action="{{ route('buyer.createSupportTicket') }}">
          @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" class="form-control" id="subject" name="subject" required placeholder="Brief description of your issue">
            </div>
            <div class="col-md-6 mb-3">
              <label for="priority" class="form-label">Priority</label>
              <select class="form-control" id="priority" name="priority" required>
                <option value="">Select Priority</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
                <option value="Urgent">Urgent</option>
              </select>
            </div>
            <div class="col-12 mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="6" required placeholder="Please describe your issue in detail..."></textarea>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">
              <i class="bi bi-send"></i> Submit Ticket
            </button>
            <a href="{{ route('buyer.support') }}" class="btn btn-secondary btn-lg ms-2">
              <i class="bi bi-arrow-left"></i> Back to Support
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
