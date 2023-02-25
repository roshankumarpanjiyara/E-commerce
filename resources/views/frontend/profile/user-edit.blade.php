@extends('frontend.layouts.master')
@section('main_title')
    Profile |
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
                                        <a class="nav-link active" href="{{route('user.profile.edit',[Auth::user()->id,Auth::user()->name])}}"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.password.view',[Auth::user()->id,Auth::user()->name])}}"><i class="fi-rs-user mr-10"></i>Password details</a>
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
                                <div class="tab-pane fade active show" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <form class="form" method="post" action="{{route('user.profile.update',[Auth::user()->id])}}" enctype="multipart/form-data">@csrf
                                                {{METHOD_FIELD('PATCH')}}
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Name <span class="required">*</span></label>
                                                        <input required="" class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{Auth::user()->name}}"/>
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required="" class="form-control @error('email') is-invalid @enderror" name="email" type="email" value="{{Auth::user()->email}}"/>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Phone number <span class="required">*</span></label>
                                                        <input required="" class="form-control  @error('phone') is-invalid @enderror" autocomplete="off" name="phone" type="tel" value="{{Auth::user()->phone}}"/>
                                                        @error('phone')
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
