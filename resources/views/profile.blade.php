@extends('layouts.app')
@section('content')
<!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Profile</h2>
                        <form action="{{route('update-user',['username'=>Auth::user()->USERNAME])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="pi-pic">
                                <img src="{{asset('app-assets/img/products/doremon-shirt.jpg')}}" alt="avatar">
                                <input type="file" id="avatar_file" name="avatar" autofocus>
                            </div>
                            
                            <div class="group-input">
                                <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="{{$user_info->USERNAME}}" autofocus readonly>
                            </div>
                            
                            <div class="group-input">
                                <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="{{$user_info->NAME}}" autofocus>
                            </div>
                            
                            <div class="group-input">
                                <label for="email">Email</label>
                            <input type="text" id="email" name="email" value= "{{$user_info->EMAIL}}" autofocus>
                            </div>

                            <div class="group-input">
                                <label for="phone_number">Phone number</label>
                            <input type="text" id="phone_number" name="phone_number" value ="{{$user_info->PHONE_NUMBER}}"autofocus>
                            </div>

                            <div class="group-input">
                                <label for="address_1">Default address</label>
                            <input type="text" id="address_1" name="address_1" value ="{{$user_info->ADDRESS_1}}" autofocus>
                            </div>

                            <div class="group-input">
                                <label for="address_2">Company address</label>
                                <input type="text" id="address_2" name="address_2" value ="{{$user_info->ADDRESS_2}}" autofocus>
                            </div>

                            <div class="group-input">
                                <label for="new_password">Password *</label>
                                <input type="password" id="new_password" name="new_pwd" autofocus>
                            </div>

                            <div class="group-input">
                                <label for="re_pass">Re-password *</label>
                                <input type="password" id="re_pass" name="re_pwd" autofocus>
                            </div>
                            <button type="submit" class="site-btn login-btn">Submit change</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

    <!-- Partner Logo Section Begin -->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{asset('app-assets/img/logo-carousel/logo-1.png')}}" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{asset('app-assets/img/logo-carousel/logo-2.png')}}" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{asset('app-assets/img/logo-carousel/logo-3.png')}}" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{asset('app-assets/img/logo-carousel/logo-4.png')}}" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{asset('app-assets/img/logo-carousel/logo-5.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Logo Section End -->
@endsection