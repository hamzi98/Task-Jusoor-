@extends('layouts.app')
@section('content')

<div class="container" style="margin-top: 100px">
  @auth('admin')
  <h3 style="text-align: center">Welcome Admin</h3>

  @else
<h3 style="text-align: center">Login Admin</h3>
    
<form id="LoginAdmin">
    @csrf
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
      <span style="font-size:14px" class="text-danger  float-right error-text username_err"></span>

    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
      <span style="font-size:14px" class="text-danger  float-right error-text password_err"></span>

    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
  @endauth
</div>
<script src="{{ asset('js/login.js') }}" defer></script>
@endsection