<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Add Product - Farmer Panel</title>
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

/* Form Container */
.form-container {
    background:#fff;
    padding:40px;
    border-radius:16px;
    box-shadow:var(--card-shadow);
    max-width:700px;
    margin:0 auto;
    position: relative;
    overflow: hidden;
}

.form-container::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 5px;
  background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
}

/* Form Elements */
.form-group {
  margin-bottom:25px;
  position: relative;
}

.form-group label {
  display:block;
  margin-bottom:8px;
  font-weight:600;
  color: var(--dark-color);
  font-size: 0.95rem;
  display: flex;
  align-items: center;
  gap: 8px;
}

.form-group label i {
  color: var(--primary-color);
  font-size: 1rem;
}

.form-control {
  width:100%;
  padding:14px 16px;
  border:2px solid #e9ecef;
  border-radius:10px;
  font-size:1rem;
  transition: all 0.3s ease;
  background: #f8f9fa;
  color: var(--dark-color);
}

.form-control:focus {
  border-color: var(--secondary-color);
  box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
  outline: none;
  background: #fff;
}

.form-control::placeholder {
  color: #6c757d;
}

select.form-control {
  cursor: pointer;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236c757d' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
  background-position: right 12px center;
  background-repeat: no-repeat;
  background-size: 16px;
  padding-right: 40px;
}

textarea.form-control {
  resize: vertical;
  min-height: 100px;
}

/* File Input Styling */
.file-input-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
  width: 100%;
}

.file-input-wrapper input[type="file"] {
  position: absolute;
  left: -9999px;
}

.file-input-label {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 14px 16px;
  border: 2px dashed #dee2e6;
  border-radius: 10px;
  background: #f8f9fa;
  color: #6c757d;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 1rem;
  gap: 10px;
}

.file-input-label:hover {
  border-color: var(--secondary-color);
  background: rgba(52, 152, 219, 0.05);
  color: var(--secondary-color);
}

.file-input-label i {
  font-size: 1.2rem;
}

/* Alerts */
.alert {
  padding:16px 20px;
  border-radius:10px;
  margin-bottom:25px;
  border: none;
  display: flex;
  align-items: flex-start;
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

.alert-danger ul {
  margin: 8px 0 0 0;
  padding-left: 20px;
}

.alert-danger li {
  margin: 4px 0;
}

/* Buttons */
.btn {
  padding:14px 28px;
  border:none;
  border-radius:10px;
  font-weight:600;
  transition: all 0.3s ease;
  cursor: pointer;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-size: 1rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.btn-success {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  color:#fff;
  box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
}

.btn-success:hover {
  background: linear-gradient(135deg, var(--primary-dark), #229954);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(46, 204, 113, 0.4);
}

.btn-success:active {
  transform: translateY(0);
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
    .form-container { padding:25px; }
    .header { flex-direction: column; align-items: flex-start; gap: 15px; }
}

/* Active state handled by .active class */

/* Form validation styles */
.form-control:invalid {
  border-color: var(--accent-color);
}

.form-control:valid {
  border-color: var(--primary-color);
}

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
  <a href="{{ route('farmer.addProduct') }}" class="active"><i class="fas fa-plus-circle"></i> <span>Add Product</span></a>
  <a href="{{ route('farmer.myProducts') }}"><i class="fas fa-box"></i> <span>My Products</span></a>
  <a href="{{ route('farmer.orders') }}"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a>
  <a href="{{ route('farmer.profile') }}"><i class="fas fa-user"></i> <span>Profile</span></a>
  <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" style="background: var(--accent-color); border: 2px solid var(--accent-color); color: #fff; cursor: pointer; padding: 16px 25px; font: inherit; display: flex; align-items: center; width: 100%; border-radius: 10px; font-weight: 600; font-size: 1rem; letter-spacing: 0.5px;"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
  </form>
</div>

<div class="main">
  <div class="header">
    <div class="header-content">
      <h1>Add New Product</h1>
      <p>Fill in the details below to add a new product to your inventory.</p>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i>
      <div>
        <strong>Success!</strong> {{ session('success') }}
      </div>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <i class="fas fa-exclamation-triangle"></i>
      <div>
        <strong>Please fix the following errors:</strong>
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif

  <div class="form-container">
    <form method="POST" action="{{ route('farmer.storeProduct') }}" enctype="multipart/form-data" id="productForm">
      @csrf

      <div class="form-group">
        <label for="ProductName"><i class="fas fa-tag"></i> Product Name</label>
        <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Enter product name" required>
      </div>

      <div class="form-group">
        <label for="Category"><i class="fas fa-list"></i> Category</label>
        <select class="form-control" id="Category" name="Category" required>
          <option value="">Select a category</option>
          <option value="Fruits">Fruits</option>
          <option value="Vegetables">Vegetables</option>
          <option value="Grains">Grains</option>
          <option value="Dairy">Dairy</option>
          <option value="Other">Other</option>
        </select>
      </div>

      <div class="form-group">
        <label for="Description"><i class="fas fa-align-left"></i> Description (Optional)</label>
        <textarea class="form-control" id="Description" name="Description" rows="4" placeholder="Describe your product..."></textarea>
      </div>

      <div class="form-group">
        <label for="Price"><i class="fas fa-rupee-sign"></i> Price (₹)</label>
        <input type="number" step="0.01" min="0" class="form-control" id="Price" name="Price" placeholder="0.00" required>
      </div>

      <div class="form-group">
        <label for="Quantity"><i class="fas fa-weight"></i> Quantity (kg/ltr/pcs)</label>
        <input type="number" min="0" class="form-control" id="Quantity" name="Quantity" placeholder="Enter quantity" required>
      </div>

      <div class="form-group">
        <label for="Image"><i class="fas fa-camera"></i> Product Image (Optional)</label>
        <div class="file-input-wrapper">
          <input type="file" id="Image" name="Image" accept="image/*" onchange="updateFileLabel()">
          <label for="Image" class="file-input-label" id="fileLabel">
            <i class="fas fa-cloud-upload-alt"></i>
            <span>Choose an image or drag it here</span>
          </label>
        </div>
      </div>

      <div style="text-align: center; margin-top: 30px;">
        <button type="submit" class="btn btn-success" id="submitBtn">
          <i class="fas fa-plus"></i> Add Product
        </button>
      </div>
    </form>
  </div>

  <div class="footer">
    © 2025 Farmer's Market Dashboard | Powered by FarmConnect
  </div>
</div>

<script>
// File input label update
function updateFileLabel() {
  const fileInput = document.getElementById('Image');
  const fileLabel = document.getElementById('fileLabel');
  const span = fileLabel.querySelector('span');

  if (fileInput.files.length > 0) {
    span.textContent = fileInput.files[0].name;
  } else {
    span.textContent = 'Choose an image or drag it here';
  }
}

// Form validation
document.getElementById('productForm').addEventListener('submit', function(e) {
  const submitBtn = document.getElementById('submitBtn');
  submitBtn.disabled = true;
  submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding Product...';
});

// Auto-format price input
document.getElementById('Price').addEventListener('input', function(e) {
  let value = e.target.value;
  if (value && !isNaN(value)) {
    e.target.value = parseFloat(value).toFixed(2);
  }
});
</script>

</body>
</html>
