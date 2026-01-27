@extends('layouts.admin')

@section('title', 'Products - Admin Panel')

@section('content')
<h3 class="mb-4">📦 Manage Products</h3>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Add Product Button -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">All Products ({{ $products->count() }})</h5>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="bi bi-plus-circle me-2"></i>Add Product
    </button>
</div>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Farmer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->ProductID }}</td>
                    <td>
                        @if($product->Image)
                            <img src="{{ asset('storage/' . $product->Image) }}" alt="{{ $product->ProductName }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 5px;">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $product->ProductName }}</td>
                    <td>{{ $product->Category ?? 'N/A' }}</td>
                    <td>₹{{ number_format($product->Price, 2) }}</td>
                    <td>{{ $product->Quantity }}</td>
                    <td>{{ $product->farmer->FullName ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->ProductID }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.products.destroy', $product->ProductID) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?');">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Product Modal -->
                <div class="modal fade" id="editProductModal{{ $product->ProductID }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.products.update', $product->ProductID) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Product Name</label>
                                                <input type="text" class="form-control" name="ProductName" value="{{ $product->ProductName }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Category</label>
                                                <input type="text" class="form-control" name="Category" value="{{ $product->Category }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Price</label>
                                                <input type="number" class="form-control" name="Price" step="0.01" value="{{ $product->Price }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" class="form-control" name="Quantity" value="{{ $product->Quantity }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Farmer</label>
                                                <select class="form-control" name="FarmerID" required>
                                                    @foreach($farmers as $farmer)
                                                        <option value="{{ $farmer->UserID }}" {{ $product->FarmerID == $farmer->UserID ? 'selected' : '' }}>
                                                            {{ $farmer->FullName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Image</label>
                                                @if($product->Image)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $product->Image) }}" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                                                    </div>
                                                @endif
                                                <input type="file" class="form-control" name="Image" accept="image/*">
                                                @if($product->Image)
                                                    <small class="text-muted">Leave empty to keep current image</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="Description" rows="3">{{ $product->Description }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No products found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="ProductName" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" name="Category">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="Price" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="Quantity" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Farmer</label>
                                <select class="form-control" name="FarmerID" required>
                                    @foreach($farmers as $farmer)
                                        <option value="{{ $farmer->UserID }}">{{ $farmer->FullName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="Image" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="Description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
