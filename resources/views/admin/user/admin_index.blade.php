@extends('admin.layouts.master')
@section('my_title', '| Admin')
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
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Admins List</h1>
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
                    <li class="breadcrumb-item text-dark">Admins</li>
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
                <div class="card-header mt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1 me-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Admins</span>
                            </h3>
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#create_admin">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->Add Admin</button>
                        <!--end::Button-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-row-bordered rounded table-row-gray-300 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-50px">SN</th>
                                    <th class="min-w-200px">Name</th>
                                    <th class="min-w-150px">Email</th>
                                    <th class="min-w-100px">Role</th>
                                    <th class="min-w-100px text-end">Actions</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach($admins as $key=>$admin)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <p class="text-dark fw-bolder fs-6">{{$key+1}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-45px me-5">
                                                    @if ($admin->profile_photo_path)
                                                        <img src="{{asset(Auth::user()->profile_photo_path) }}" alt="{{ $admin->name }}" />
                                                    @else
                                                        <img src="{{ $admin->profile_photo_url }}" alt="{{ $admin->name }}" />
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <p class="text-dark fw-bolder text-hover-primary fs-6">{{$admin->name}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start flex-column">
                                                <p class="text-dark fw-bolder text-hover-primary fs-6">{{$admin->email}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start flex-column">
                                                <p class="text-dark fw-bolder text-hover-primary fs-6"><span class="badge badge-success">{{$admin->role->name??''  }}</span></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#edit_admin{{$admin->id}}">
                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                <!--begin::Modal - Edit role-->
                                                <!--begin::Modal - New Target-->
                                                <div class="modal fade" id="edit_admin{{$admin->id}}" tabindex="-1" aria-hidden="true">
                                                    <!--begin::Modal dialog-->
                                                    <div class="modal-dialog modal-dialog-centered mw-950px">
                                                        <!--begin::Modal content-->
                                                        <div class="modal-content rounded">
                                                            <!--begin::Modal header-->
                                                            <div class="modal-header pb-0 border-0 justify-content-end">
                                                                <!--begin::Close-->
                                                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                                    <span class="svg-icon svg-icon-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                </div>
                                                                <!--end::Close-->
                                                            </div>
                                                            <!--begin::Modal header-->
                                                            <!--begin::Modal body-->
                                                            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                                <!--begin:Form-->
                                                                <form id="kt_modal_new_target_form" class="form" action="{{route('admins.update',[$admin->id])}}" method="post" enctype="multipart/form-data">@csrf
                                                                    {{method_field('PATCH')}}
                                                                    <!--begin::Heading-->
                                                                    <div class="mb-13 text-center">
                                                                        <!--begin::Title-->
                                                                        <h1 class="mb-3">Update</h1>
                                                                        <!--end::Title-->
                                                                    </div>
                                                                    <!--end::Heading-->
                                                                    <div class="row g-9 mb-8">
                                                                        <div class="col-md-8 fv-row">
                                                                            <div class="mb-3">
                                                                                <!--begin::Title-->
                                                                                <h3 class="mb-3">General Information</h3>
                                                                                <!--end::Title-->
                                                                            </div>
                                                                            <!--begin::Input group-->
                                                                            <div class="d-flex flex-column mb-8 fv-row">
                                                                                <!--begin::Label-->
                                                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                                    <span class="required">Name</span>
                                                                                </label>
                                                                                <!--end::Label-->
                                                                                <input type="text" class="form-control form-control-solid" placeholder="Enter Name" name="name" value="{{$admin->name}}" autocomplete="off"/>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Input group-->
                                                                            <div class="d-flex flex-column mb-8">

                                                                            </div>
                                                                            <!--end::Input group-->
                                                                        </div>
                                                                        <div class="col-md-4 fv-row">
                                                                            <div class="mb-3">
                                                                                <!--begin::Title-->
                                                                                <h3 class="mb-3">Login Information</h3>
                                                                                <!--end::Title-->
                                                                            </div>
                                                                            <!--begin::Input group-->
                                                                            <div class="d-flex flex-column mb-8 fv-row">
                                                                                <!--begin::Label-->
                                                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                                    <span class="required">Email</span>
                                                                                </label>
                                                                                <!--end::Label-->
                                                                                <input type="text" class="form-control form-control-solid" placeholder="Enter Email" name="email" value="{{$admin->email}}" readonly autocomplete="off"/>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Input group-->
                                                                            <div class="d-flex flex-column mb-8 fv-row">
                                                                                <!--begin::Label-->
                                                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                                    <span class="required">Password</span>
                                                                                </label>
                                                                                <!--end::Label-->
                                                                                <input type="password" class="form-control form-control-solid" placeholder="Enter Password" name="password" autocomplete="off"/>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Input group-->
                                                                            <div class="d-flex flex-column mb-8 fv-row">
                                                                                <label class="required fs-6 fw-bold mb-2">Assign Role</label>
                                                                                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select a Role" name="role_id">
                                                                                        <option value="">Select user...</option>
                                                                                        @foreach(App\Models\Role::all() as $role)
                                                                                            <option value="{{$role->id}}"@if($admin->role_id==$role->id)selected @endif>{{$role->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Input group-->
                                                                            <div class="d-flex flex-column mb-8 fv-row">

                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Actions-->
                                                                            @if(isset(auth()->user()->role->permission['name']['user']['can-view']))
                                                                                <div class="text-center">
                                                                                    <button type="reset" id="edit_user{{$admin->id}}_cancel"  data-bs-dismiss="modal" class="btn btn-light me-3">Cancel</button>
                                                                                    <button type="submit" id="edit_user{{$admin->id}}_submit" class="btn btn-primary">
                                                                                        <span class="indicator-label">Update</span>
                                                                                        <span class="indicator-progress">Please wait...
                                                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                                    </button>
                                                                                </div>
                                                                            @endif
                                                                            <!--end::Actions-->
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <!--end:Form-->
                                                            </div>
                                                            <!--end::Modal body-->
                                                        </div>
                                                        <!--end::Modal content-->
                                                    </div>
                                                    <!--end::Modal dialog-->
                                                </div>
                                                <!--end::Modal - New Target-->
                                                <!--end::Modal - Edit role-->
                                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_user{{$admin->id}}">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="delete_user{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{route('admins.delete',[$admin->id])}}" method="post">@csrf
                                                            {{method_field('DELETE')}}
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Do you want to delete?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!--Modal end-->
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
            <!--begin::Modal - New Target-->
            <div class="modal fade" id="create_admin" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-950px">
                    <!--begin::Modal content-->
                    <div class="modal-content rounded">
                        <!--begin::Modal header-->
                        <div class="modal-header pb-0 border-0 justify-content-end">
                            <!--begin::Close-->
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--begin::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                            <!--begin:Form-->
                            <form id="create_user_form" class="form" action="{{route('admins.store')}}" method="post" enctype="multipart/form-data">@csrf
                                <!--begin::Heading-->
                                <div class="mb-13 text-center">
                                    <!--begin::Title-->
                                    <h1 class="mb-3">Create</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <div class="row g-9 mb-8">
                                    <div class="col-md-8 fv-row">
                                        <div class="mb-3">
                                            <!--begin::Title-->
                                            <h3 class="mb-3">General Information</h3>
                                            <!--end::Title-->
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Name</span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Enter Name" name="name" autocomplete="off"/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8">

                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-md-4 fv-row">
                                        <div class="mb-3">
                                            <!--begin::Title-->
                                            <h3 class="mb-3">Login Information</h3>
                                            <!--end::Title-->
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Email</span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid @error('email') is-invalid @enderror" placeholder="Enter Email" name="email" autocomplete="off"/>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Password</span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="password" class="form-control form-control-solid @error('password') is-invalid @enderror" placeholder="Enter Password" name="password" autocomplete="off"/>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="required fs-6 fw-bold mb-2">Assign Role</label>
                                            <select class="form-select form-select-solid @error('role_id') is-invalid @enderror" data-control="select2" data-hide-search="true" data-placeholder="Select a Role" name="role_id">
                                                <option value="">Select user...</option>
                                                @foreach(App\Models\Role::all() as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        @if(isset(auth()->user()->role->permission['name']['user']['can-view']))
                                            <div class="text-center">
                                                <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Cancel</button>
                                                <button type="submit" id="create_admin_submit" class="btn btn-primary">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                        @endif
                                        <!--end::Actions-->
                                    </div>
                                </div>
                            </form>
                            <!--end:Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - New Target-->
        </div>
        <!--end::Tables Widget 9-->
    </div>
    <!--end::Container-->
</div>
<!--end::Content-->
@endsection
