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
