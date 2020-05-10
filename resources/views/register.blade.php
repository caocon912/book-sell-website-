@extends('layouts.app')
@section('content')
<!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Register</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->
    @if(Session::has('error-message'))
        <div class="alert alert-danger"> 
            <button type="button" 
                class="close" 
                data-dismiss="alert" 
                aria-hidden="true">&times;</button>
            {{ session()->get('error-message') }} 
        </div>
    @endif
    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Register</h2>
                        <form action="{{route('register-submit')}}" method="post">
                            @csrf
                            <div class="group-input">
                                <label for="username">Username *</label>
                                <input type="text" id="username" name="username">
                                @error ('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="username">Email address *</label>
                                <input type="text" id="email" name="email">
                                @error ('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="password" id="pass" name="pwd">
                                @error ('pwd')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Confirm Password *</label>
                                <input type="password" id="con-pass" name="re-pwd">
                                @error ('re-pwd')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="site-btn register-btn">REGISTER</button>
                        </form>
                        <div class="switch-login">
                            <a href="{{route('login')}}" class="or-login">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
    
    <!-- Partner Logo Section Begin -->
    <!-- Partner Logo Section End -->
    @endsection