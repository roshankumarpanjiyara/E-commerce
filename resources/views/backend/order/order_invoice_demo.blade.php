<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<title>Invoice</title>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="{{public_path("logos/new-logo-small-3.png")}}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{public_path("backend/dist/assets/plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{public_path("backend/dist/assets/plugins/global/plugins.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{public_path("backend/dist/assets/css/style.bundle.css")}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body>
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">
								<!-- begin::Invoice 3-->
								<div class="card">
									<!-- begin::Body-->
									<div class="card-body py-20">
										<!-- begin::Wrapper-->
										<div class="mw-lg-950px mx-auto w-100">
											<!-- begin::Header-->
											<div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
												<h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">INVOICE #{{ $order->invoice_no}}</h4>
												<!--end::Logo-->
												<div class="text-sm-end">
													<!--begin::Logo-->
													<span class="d-block mw-200px ms-sm-auto">
														<img alt="Logo" src="{{public_path("logos/new-logo-bg.png")}}" class="w-200px" />
													</span>
													<!--end::Logo-->
													<!--begin::Text-->
													<div class="text-sm-end fw-bold fs-4 text-muted mt-7">
														<div>Rabindranagar, Ghola, Sodpur</div>
														<div>Kolkata - 700111</div>
														<div>West Bengal</div>
													</div>
													<!--end::Text-->
												</div>
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="pb-12">
												<!--begin::Wrapper-->
												<div class="d-flex flex-column gap-7 gap-md-10">
													<!--begin::Message-->
													<div class="fw-bolder fs-2">Dear {{ $order->name }}
													<span class="fs-6">({{ $order->email }})</span>,
													<br />
													<span class="text-muted fs-5">Here are your order details. We thank you for your purchase.</span></div>
													<!--begin::Message-->
													<!--begin::Separator-->
													<div class="separator"></div>
													<!--begin::Separator-->
													<!--begin::Order details-->
													<div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
														<div class="flex-root d-flex flex-column">
															<span class="text-muted">Order ID</span>
															<span class="fs-5">#{{$order->order_number}}</span>
														</div>
														<div class="flex-root d-flex flex-column">
															<span class="text-muted">Date</span>
															<span class="fs-5">{{ $order->order_date }}</span>
														</div>
														<div class="flex-root d-flex flex-column">
															<span class="text-muted">Invoice ID</span>
															<span class="fs-5">#{{$order->invoice_no}}</span>
														</div>
														<div class="flex-root d-flex flex-column">
															<span class="text-muted">Payment Type</span>
															<span class="fs-5">{{ $order->payment_type }}</span>
														</div>
													</div>
													<!--end::Order details-->
													<!--begin::Billing & shipping-->
													<div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
														<div class="flex-root d-flex flex-column">
															<span class="text-muted">Billing Address</span>
															<span class="fs-6">{{$order->address}},
                                                            <br />{{$order->district->name}} - {{ $order->pincode->pincode }},
                                                            <br />{{ $order->state->name }},
                                                            <br />India.</span>
														</div>
														<div class="flex-root d-flex flex-column">
															<span class="text-muted">Shipping Address</span>
															<span class="fs-6">{{$order->address}},
															<br />{{$order->district->name}} - {{ $order->pincode->pincode }},
															<br />{{ $order->state->name }},
															<br />India.</span>
														</div>
													</div>
													<!--end::Billing & shipping-->
													<!--begin:Order summary-->
													<div class="d-flex justify-content-between flex-column">
														<!--begin::Table-->
														<div class="table-responsive border-bottom mb-9">
															<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
																<thead>
																	<tr class="border-bottom fs-6 fw-bolder text-muted">
																		<th class="min-w-150px pb-2">Products</th>
																		<th class="min-w-70px text-end pb-2">SKU</th>
																		<th class="min-w-80px text-end pb-2">Size</th>
																		<th class="min-w-80px text-end pb-2">QTY</th>
																		<th class="min-w-80px text-end pb-2">Price</th>
																		<th class="min-w-100px text-end pb-2">Total</th>
																	</tr>
																</thead>
																<tbody class="fw-bold text-gray-600">
																	<!--begin::Products-->
                                                                    @foreach ($orderItems as $item)
                                                                        <tr>
                                                                            <!--begin::Product-->
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <!--begin::Thumbnail-->
                                                                                    <span class="symbol symbol-50px">
                                                                                        <span class="symbol-label" style="background-image:url({{public_path($item->product->product_thumbnail)}});"></span>
                                                                                    </span>
                                                                                    <!--end::Thumbnail-->
                                                                                    <!--begin::Title-->
                                                                                    <div class="ms-5">
                                                                                        <div class="fw-bolder">{{ $item->product->product_name }}</div>
                                                                                    </div>
                                                                                    <!--end::Title-->
                                                                                </div>
                                                                            </td>
                                                                            <!--end::Product-->
                                                                            <!--begin::SKU-->
                                                                            <td class="text-end">{{ $item->product->product_sku }}</td>
                                                                            <!--end::SKU-->
                                                                            <!--begin::Quantity-->
                                                                            <td class="text-end">
                                                                                @if($item->size == NULL)
                                                                                ----
                                                                                @else
                                                                                    {{ $item->size }}
                                                                                @endif
                                                                            </td>
                                                                            <!--end::Quantity-->
                                                                            <!--begin::Quantity-->
                                                                            <td class="text-end">{{ $item->qty }}</td>
                                                                            <!--end::Quantity-->
                                                                            <!--begin::Total-->
                                                                            <td class="text-end">${{ $item->price }}</td>
                                                                            <!--end::Total-->
                                                                             <!--begin::Total-->
                                                                             <td class="text-end">${{ $item->price * $item->qty }}</td>
                                                                             <!--end::Total-->
                                                                        </tr>
                                                                    @endforeach
																	<!--end::Products-->
																	<!--begin::Subtotal-->
																	<tr>
																		<td colspan="5" class="text-end">Subtotal</td>
																		<td class="text-end">${{ $order->subtotal }}</td>
																	</tr>
																	<!--end::Subtotal-->
																	<!--begin::VAT-->
																	<tr>
																		<td colspan="5" class="text-end">TAX (18%)</td>
																		<td class="text-end">${{ $order->tax }}</td>
																	</tr>
																	<!--end::VAT-->
                                                                    @if ($order->discount != 0 || $order->discount != NULL)
                                                                        <!--begin::Shipping-->
                                                                        <tr>
                                                                            <td colspan="5" class="text-end">Discount</td>
                                                                            <td class="text-end">${{ $order->discount }}</td>
                                                                        </tr>
                                                                        <!--end::Shipping-->
                                                                    @endif
                                                                    <!--begin::Shipping-->
																	<tr>
																		<td colspan="5" class="text-end">Shipping Rate</td>
																		<td class="text-end">$0.00</td>
																	</tr>
																	<!--end::Shipping-->
																	<!--begin::Grand total-->
																	<tr>
																		<td colspan="5" class="fs-3 text-dark fw-bolder text-end">Grand Total</td>
																		<td class="text-dark fs-3 fw-boldest text-end">${{ $order->amount }}</td>
																	</tr>
																	<!--end::Grand total-->
																</tbody>
															</table>
														</div>
														<!--end::Table-->
													</div>
													<!--end:Order summary-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Body-->
                                            <div class="d-flex flex-stack flex-wrap mt-lg-5 pt-13">
												<!-- begin::Actions-->
												<div class="my-1 me-5">
                                                    <!--begin::Text-->
                                                    <div class="text-sm fw-bold fs-4 text-muted mt-7">
                                                        <div>Ecommerce Head Office</div>
                                                        <div>Email:support@ecommerce.com</div>
                                                        <div>Mob: 1245454545</div>
                                                        <div>Kolkata, West Bengal.</div>
                                                    </div>
                                                    <!--end::Text-->
												</div>
												<!-- end::Actions-->
											</div>
										</div>
										<!-- end::Wrapper-->
									</div>
									<!-- end::Body-->
								</div>
								<!-- end::Invoice 1-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{public_path("backend/dist/assets/plugins/global/plugins.bundle.js")}}"></script>
		<script src="{{public_path("backend/dist/assets/js/scripts.bundle.js")}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{public_path("backend/dist/assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
		<!--end::Page Vendors Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>