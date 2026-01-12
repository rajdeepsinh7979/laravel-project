<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Farmers Website</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
  background-image:url("{{ asset('storage/uploads/loginformback.jpg') }}");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;

  display: flex;
  align-items: center;
  justify-content: center;
  height: 150vh;
}
.register-card {
  padding: 2rem;
  border-radius: 15px;
  box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
  width: 100%;
  max-width: 550px;
}
.register-card h2 {
  text-align: center;
  color: #2e7d32;
  margin-bottom: 1rem;
  font-weight:bold;
}
.btn-custom {
  background-color: #4caf50;
  color: white;
  border-radius: 30px;
}
.btn-custom:hover {
  background-color: #388e3c;
}
.error {
  color:red;
  text-align:center;
  margin-bottom:10px;
}
</style>
</head>
<body>

<div class="register-card">
  <h2>Register</h2>

  @if($errors->any())
    <div class="error">
      @foreach($errors->all() as $error)
        {{ $error }}<br>
      @endforeach
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success text-center">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-2">
      <label class="form-label">Full Name</label>
      <input type="text" name="FullName" class="form-control" placeholder="Enter your name" value="{{ old('FullName') }}" required>
    </div>

    <div class="mb-2">
      <label class="form-label">Email</label>
      <input type="email" name="Email" class="form-control" placeholder="Enter your email" value="{{ old('Email') }}" required>
    </div>

    <div class="mb-2">
      <label class="form-label">Phone</label>
      <input type="text" name="Phone" class="form-control" placeholder="Enter your mobile number" value="{{ old('Phone') }}">
    </div>

    <div class="mb-2">
      <label class="form-label">Password</label>
      <input type="password" name="Password" class="form-control" placeholder="Create a password" required>
    </div>

    <div class="mb-2">
      <label class="form-label">Gender</label>
      <select name="Gender" class="form-control">
        <option value="">Select Gender</option>
        <option value="Male" {{ old('Gender') == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ old('Gender') == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ old('Gender') == 'Other' ? 'selected' : '' }}>Other</option>
      </select>
    </div>

    <div class="mb-2">
      <label class="form-label">Farm Name</label>
      <input type="text" name="FarmName" class="form-control" placeholder="Enter your farm name" value="{{ old('FarmName') }}">
    </div>

    <div class="mb-2">
      <label class="form-label">User Type</label>
      <select name="Role" class="form-control" required>
        <option value="Farmer" {{ old('Role') == 'Farmer' ? 'selected' : '' }}>Farmer</option>
        <option value="Buyer" {{ old('Role') == 'Buyer' ? 'selected' : '' }}>Buyer</option>
      </select>
    </div>

    <div class="mb-2">
      <label class="form-label">About</label>
      <textarea name="About" class="form-control" placeholder="Tell us about yourself" rows="3" required>{{ old('About') }}</textarea>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-custom">Register</button>
    </div>
  </form>

  <p class="text-center mt-3">Already have an account? <a href="{{ route('login') }}" style="color:#FFFFFF;font-weight:bold;">Login</a></p>
</div>

</body>
</html>
