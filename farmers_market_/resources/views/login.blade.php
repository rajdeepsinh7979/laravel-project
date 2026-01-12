<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Farmers Website</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-image:url("{{ asset('storage/uploads/loginformback.jpg') }}");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
    }
    .login-card h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #2e7d32;
      font-weight:bold;
    }
    .btn-custom {
      background-color:  #388e3c;
      color: white;
      border-radius: 30px;
    }
    .btn-custom:hover {
      background-color: #4caf50;
    }
    .form-label{
      font-weight:bold;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2>Login</h2>
    @if($errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $error)
          {{ $error }}
        @endforeach
      </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-2">
        <label class="form-label">Email / Username</label>
        <input type="text" name="Email" class="form-control" placeholder="Enter your email" value="{{ old('Email') }}">
      </div>

      <div class="mb-2">
        <label class="form-label">Password</label>
        <input type="password" name="Password" class="form-control" placeholder="Enter your password">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-custom">Login</button>
      </div>
    </form>

    <p class="text-center mt-3">New here? <a href="{{ route('register') }}" style="color:white;font-weight:bold">Register Now</a></p>
  </div>

</body>
</html>
