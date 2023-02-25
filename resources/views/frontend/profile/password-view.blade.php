@extends('frontend.layouts.master')
@section('main_title')
    Password |
@endsection
@section('content')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route("dashboard")}}"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route("myorder")}}"><i class="fi-rs-shopping-bag mr-10"></i>My Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route("wishlist")}}"><i class="fi fi-rs-heart mr-10"></i>Wishlist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href=""><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href=""><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.profile.edit',[Auth::user()->id,Auth::user()->name])}}"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{route('user.password.view',[Auth::user()->id,Auth::user()->name])}}"><i class="fi-rs-user mr-10"></i>Password details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="password-detail" role="tabpanel" aria-labelledby="password-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Password Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <form class="form" action="{{route('user.password.change')}}" method="post" enctype="multipart/form-data">@csrf
                                                {{method_field('PATCH')}}
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="current_password">Current Password <span class="required">*</span></label>
                                                        <input required="" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password" type="password" />
                                                        @error('current_password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="password">New Password <span class="required">*</span></label>
                                                        <input required="" class="form-control @error('password') is-invalid @enderror" name="password" id="password" type="password" />
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                                                        <input required="" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" type="password" />
                                                        @error('password_confirmation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
