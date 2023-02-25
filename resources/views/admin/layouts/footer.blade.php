<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">2022©</span>
            <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Roshan</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
            <li class="menu-item">
                <a href="" target="_blank" class="menu-link px-2">About</a>
            </li>
            <li class="menu-item">
                <a href="" target="_blank" class="menu-link px-2">Support</a>
            </li>
            <li class="menu-item">
                <a href="" target="_blank" class="menu-link px-2">Purchase</a>
            </li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('custon_js/code.js') }}"></script> --}}


<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset("backend/dist/assets/plugins/global/plugins.bundle.js")}}"></script>
<script src="{{asset("backend/dist/assets/js/scripts.bundle.js")}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>

<script src="{{asset("backend/dist/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js")}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset("backend/dist/assets/js/custom/apps/ecommerce/catalog/save-product.js")}}"></script>
<script src="{{asset("backend/dist/assets/js/widgets.bundle.js")}}"></script>
<script src="{{asset("backend/dist/assets/js/custom/widgets.js")}}"></script>
<script src="{{asset("backend/dist/assets/js/custom/apps/chat/chat.js")}}"></script>
<script src="{{asset("backend/dist/assets/js/custom/utilities/modals/upgrade-plan.js")}}"></script>
<script src="{{asset("backend/dist/assets/js/custom/utilities/modals/users-search.js")}}"></script>
<!--end::Page Custom Javascript-->
<script>
    $(document).ready( function () {
        $('#brand_table').DataTable();
    } );
</script>
<script>
    $(document).ready( function () {
        $('#category_table').DataTable();
    } );
</script>
<script>
    $(document).ready( function () {
        $('#subcategory_table').DataTable();
    } );
</script>
<script>
    $(document).ready( function () {
        $('#product_table').DataTable();
    } );
</script>
<script>
    $(document).ready( function () {
        $('#table').DataTable();
    } );
</script>
<script>
    $(document).ready( function () {
        $('#state_table').DataTable();
    } );
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset("custom_js/code.js")}}"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script> --}}

<script>
    ClassicEditor
        .create( document.querySelector( '#editor_short' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor_long' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

<script>
    ClassicEditor
        .create( document.querySelector( '#post_editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
