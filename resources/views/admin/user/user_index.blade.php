@extends('admin.layouts.master')
@section('my_title', '| User')
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Users List</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route("admin_dashboard")}}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Users</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">All Users List</span>
                        </h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-row-bordered rounded table-row-gray-300 align-middle gs-0 gy-2" id="table">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-50px">SN</th>
                                    <th class="min-w-200px">Name</th>
                                    <th class="min-w-150px">Email</th>
                                    <th class="min-w-100px">Phone</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach($users as $key=>$user)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <p class="text-dark fw-bolder fs-6">{{$key+1}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-35px me-5">
                                                    {{-- @if ($admin->profile_photo_path)
                                                        <img src="{{asset(Auth::user()->profile_photo_path) }}" alt="{{ $admin->name }}" />
                                                    @else --}}
                                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                                        @if ($user->UserOnline())
                                                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-2 border-white h-10px w-10px"></div>
                                                        @else
                                                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-danger rounded-circle border border-2 border-white h-10px w-10px"></div>
                                                        @endif
                                                    {{-- @endif --}}
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-dark fw-bolder text-primary fs-6">{{$user->name}}</span>
                                                    @if (!$user->UserOnline())
                                                        <span class="text-muted fw-bolder text-primary fs-8">Last Seen: {{Carbon\Carbon::parse($user->last_seen)->diffForHumans()}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start flex-column">
                                                <p class="text-dark fw-bolder text-primary fs-6">{{$user->email}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start flex-column">
                                                <p class="text-dark fw-bolder text-primary fs-6">{{$user->phone}}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        <!--end::Tables Widget 9-->
    </div>
    <!--end::Container-->
</div>
<!--end::Content-->
@endsection
