<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment - Farmer's Market</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(135deg, #e0f7e0, #f4f7f6);
    font-family: 'Segoe UI', Arial, sans-serif;
}
.payment-card {
    max-width: 500px;
    margin: 50px auto;
    background: #ffffff;
    border-radius: 15px;
    padding: 30px 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}
.payment-card:hover { transform: translateY(-5px); }
.payment-card h2 { color: #2f7a32; margin-bottom: 25px; font-weight: 600; }
.form-select, .btn { border-radius: 10px; }
.btn-pay {
    background: linear-gradient(90deg, #2f7a32, #4caf50);
    color: white;
    font-weight: bold;
    padding: 12px;
    width: 100%;
    transition: background 0.3s ease;
}
.btn-pay:hover { background: linear-gradient(90deg, #256027, #388e3c); }
.order-summary {
    background: #f1fdf1;
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 20px;
}
.order-summary h5 { margin-bottom: 15px; color: #2f7a32; }
.icon { margin-right: 8px; color: #2f7a32; }
</style>
</head>
<body>

<div class="payment-card">
    <h2><i class="fa-solid fa-money-bill-wave icon"></i>Payment</h2>

    <div class="order-summary">
        <h5>Order Summary</h5>
        <p><strong>Order ID:</strong> {{ $orderId }}</p>
        <p><strong>Total Amount:</strong> ₹{{ number_format($total, 2) }}</p>
        <p><strong>Delivery:</strong> ₹{{ number_format($delivery, 2) }}</p>
        <hr>
        <p><strong>Grand Total:</strong> ₹{{ number_format($grandTotal, 2) }}</p>
    </div>

    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ route('buyer.orderConfirmed') }}">
                @csrf
                <input type="hidden" name="full_name" value="{{ $fullName }}">
                <input type="hidden" name="phone" value="{{ $phone }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="address" value="{{ $address }}">
                <input type="hidden" name="city" value="{{ $city }}">
                <input type="hidden" name="pincode" value="{{ $pincode }}">
                <input type="hidden" name="payment_method" value="cod">
                <button type="submit" class="btn btn-success btn-lg w-100"><i class="fa-solid fa-truck"></i> Cash on Delivery</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
