@extends("admin.layouts.master")
@section('my_title', '| Brands')
@section('content')
@error('name')
    <?php toast($message,'error')->autoClose(5000)->width('450px')->timerProgressBar(); ?>
@enderror
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Add Brand</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{url("admin/dashboard")}}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Brand</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Brand List</li>
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
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Aside column-->
                <form class="form" action="{{route("brands.store")}}" method="post" enctype="multipart/form-data">@csrf
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::Thumbnail settings-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Brand logo</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body text-center pt-0">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url({{asset("backend/dist/assets/media/svg/files/blank-image.svg")}})">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-150px h-150px"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                            <!--begin::Icon-->
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--end::Icon-->
                                            <!--begin::Inputs-->
                                            <input type="file" name="image" class="@error('image') is-invalid @enderror" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Description-->
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="text-muted fs-7">Set the brand thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Thumbnail settings-->
                            <!--begin::Status-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="required">Brand Name</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input-->
                                    <input type="text" name="name" class="form-control mb-2 @error('name') is-invalid @enderror" placeholder="Brand name" required value="" autocomplete="off"/>
                                    <!--end::Input-->
                                    <!--begin::Description-->

                                    <div class="text-muted fs-7">A brand name is required and recommended to be unique.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Status-->
                            <div class="d-flex justify-content-end py-4">
                                <!--begin::Button-->
                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">Add Brand</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                    </div>
                </form>
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Brand List</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-0">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle gs-0 gy-3" id="brand_table">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bolder text-muted bg-light">
                                            <th class="ps-4 min-w-200px rounded-start">Brand</th>
                                            <th class="min-w-125px text-end">Created at</th>
                                            <th class="min-w-200px text-end rounded-end">Action</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @forelse ($brands as $brand)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-60px symbol-2by3 me-5">
                                                            <img src="{{asset("$brand->image")}}" class="" alt="" />
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <span class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{$brand->name}}</span>
                                                            <span class="text-muted fw-bold text-muted d-block fs-7">{{$brand->created_by}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <span class="text-dark fw-bolder d-block fs-7">{{$brand->created_at->format('D, d F Y')}}</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#edit_brand{{$brand->slug}}" data-bs-placement="top" data-bs-trigger="hover" title="edit">
                                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
                                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </a>
                                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_brand{{$brand->slug}}" data-bs-placement="top" data-bs-trigger="hover" title="delete">
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
                                                    <a href="{{route('brands.destroy',[$brand->slug])}}" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" id="delete">
                                                        {{-- {{method_field('DELETE')}} --}}
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
                                                </td>
                                                <!--begin::Modal - Edit role-->
                                                <div class="modal fade" id="edit_brand{{$brand->slug}}" tabindex="-1" aria-hidden="true">
                                                    <!--begin::Modal dialog-->
                                                    <div class="modal-dialog modal-dialog-centered mw-650px">
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
                                                                <form id="kt_modal_new_target_form" class="form" action="{{route('brands.update',[$brand->id])}}" method="post" enctype="multipart/form-data">@csrf
                                                                    {{method_field('PATCH')}}
                                                                    <!--begin::Heading-->
                                                                    <div class="mb-13 text-center">
                                                                        <!--begin::Title-->
                                                                        <h1 class="mb-3">Update Brand</h1>
                                                                        <!--end::Title-->
                                                                    </div>
                                                                    <!--end::Heading-->
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="required form-label mb-3">Brand Name</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror" autocomplete="off" name="name" placeholder="Brand name" value="{{$brand->name}}" />
                                                                        <!--end::Input-->
                                                                        <!--begin::Description-->
                                                                        <div class="text-muted fs-7">A brand name is required and recommended to be unique.</div>
                                                                        <!--end::Description-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-10">
                                                                        <!--begin::Label-->
                                                                        <label class="d-block fw-bold fs-6 mb-5">
                                                                            <span class="required">Brand Logo</span>
                                                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="E.g. Select a logo to represent the brand."></i>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Image input-->
                                                                        <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url({{asset($brand->image)}})">
                                                                            <!--begin::Preview existing avatar-->
                                                                            <div class="image-input-wrapper w-150px h-150px"></div>
                                                                            <!--end::Preview existing avatar-->
                                                                            <!--begin::Label-->
                                                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                                                                <!--begin::Icon-->
                                                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                                                <!--end::Icon-->
                                                                                <!--begin::Inputs-->
                                                                                <input type="file" name="image" class="@error('image') is-invalid @enderror" />
                                                                                <!--end::Inputs-->
                                                                            </label>
                                                                            <!--end::Label-->
                                                                            <!--begin::Cancel-->
                                                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                                                                <i class="bi bi-x fs-2"></i>
                                                                            </span>
                                                                            <!--end::Cancel-->
                                                                        </div>
                                                                        <!--end::Image input-->
                                                                        <!--begin::Description-->
                                                                        @error('image')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        <div class="text-muted fs-7">Set the brand thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                                                        <!--end::Description-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Actions-->
                                                                    <div class="text-center">
                                                                        <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Cancel</button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            <span class="indicator-label">Update</span>
                                                                            <span class="indicator-progress">Please wait...
                                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                        </button>
                                                                    </div>
                                                                    <!--end::Actions-->
                                                                </form>
                                                                <!--end:Form-->
                                                            </div>
                                                            <!--end::Modal body-->
                                                        </div>
                                                        <!--end::Modal content-->
                                                    </div>
                                                    <!--end::Modal dialog-->
                                                </div>
                                                <!--end::Modal - Edit role-->
                                                <!-- Modal -->
                                                <div class="modal fade" id="delete_brand{{$brand->slug}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{route('brands.destroy',[$brand->slug])}}" method="get">@csrf
                                                            {{method_field('DELETE')}}
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                                                                </div>
                                                                <div class="modal-body">

                                                                Do you want to delete?
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!--Modal end-->
                                            </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::General options-->
                </div>
                <!--end::Main column-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
