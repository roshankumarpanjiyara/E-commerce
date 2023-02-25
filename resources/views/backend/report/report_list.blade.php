@extends('admin.layouts.master')
@section('my_title', '| Sales Report List')
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
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Reports</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin_dashboard')}}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">All Report</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Sales Report List</li>
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
            <!--begin::Products-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Sales Report List</span>
                        </h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-150px">Order ID</th>
                                <th class="text-end min-w-70px">Date</th>
                                <th class="text-end min-w-70px">Product Sold</th>
                                <th class="text-end min-w-70px">Amount</th>
                                <th class="text-end min-w-70px">Status</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @forelse ($orders as $order)
                                 <!--begin::Table row-->
                                <tr>
                                    <!--begin::SKU=-->
                                    <td>
                                        <span class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{$order->order_number}}</span>
                                        <span class="text-muted fw-bold text-muted d-block fs-7">INVOICE: {{$order->invoice_no}}</span>
                                    </td>
                                    <!--end::SKU=-->
                                    <!--begin::Qty=-->
                                    <td class="text-end pe-0">
                                        <span class="fw-bolder ms-3">{{$order->order_date}}</span>
                                    </td>
                                    <!--end::Qty=-->
                                    <!--begin::Action=-->
                                    <td class="text-end">
                                        <span class="fw-bolder ms-3">{{App\Models\OrderItem::where('order_id',$order->id)->count()}}</span>
                                    </td>
                                    <!--end::Action=-->
                                    <!--begin::Price=-->
                                    <td class="text-end pe-0">
                                        <span class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">${{$order->amount}}</span>
                                        <span class="text-muted fw-bold text-muted d-block fs-7">Payment: {{$order->payment_type}}</span>
                                    </td>
                                    <!--end::Price=-->
                                    <!--begin::Status=-->
                                    <td class="text-end pe-0">
                                        <!--begin::Badges-->
                                        @if ($order->status == 'Pending')
                                            <div class="badge badge-light-info">{{$order->status}}</div>
                                        @elseif ($order->status == 'Confirmed')
                                            <div class="badge badge-light-primary">{{$order->status}}</div>
                                        @elseif ($order->status == 'Processing')
                                            <div class="badge badge-light-warning">{{$order->status}}</div>
                                        @elseif ($order->status == 'Picked')
                                            <div class="badge badge-light-dark">{{$order->status}}</div>
                                        @elseif ($order->status == 'Shipped')
                                            <div class="badge badge-light-secondary">{{$order->status}}</div>
                                        @elseif ($order->status == 'Delivered')
                                            <div class="badge badge-light-success">{{$order->status}}</div>
                                        @elseif ($order->status == 'Cancel')
                                            <div class="badge badge-light-danger">{{$order->status}}</div>
                                        @endif
                                        <!--end::Badges-->
                                    </td>
                                    <!--end::Status=-->
                                </tr>
                                <!--end::Table row-->
                            @empty

                            @endforelse
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Products-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
<script src="{{asset("backend/dist/assets/js/custom/apps/ecommerce/catalog/products.js")}}"></script>
@endsection
