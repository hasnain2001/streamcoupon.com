<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon -->
     <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">

    <!-- ✅ DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- ✅ jQuery UI (for drag & drop + autocomplete) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- ✅ Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- ✅ Custom employee CSS -->
    <link rel="stylesheet" href="{{ asset('employee/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('employee/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('employee/css/app.css') }}">

    @stack('styles')

    <style>
        /* ✨ Optional styling for sortable handle hover */
        .handle {
            cursor: grab;
        }
        .handle:active {
            cursor: grabbing;
        }
        tr.ui-sortable-helper {
            background: #f8f9fa;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <div class="overlay"></div>

    <!-- ✅ Sidebar -->
    @include('employee.layouts.sidebar')

    <!-- ✅ Main Content -->
    <div class="main-content">
        @include('employee.layouts.navigation')

        <div class="page-content">
            @yield('content')

            {{-- <!-- ✅ Footer -->
            <footer class="footer mt-auto py-3 bg-light border-top">
                <div class="container-fluid d-flex justify-content-between text-muted small">
                    <span>&copy; {{ date('Y') }} Ubold. All rights reserved.</span>
                    <span>Design & Developed by Themesbrand</span>
                </div>
            </footer> --}}
        </div>
    </div>

    <!-- ✅ Load JS in correct order -->

    <!-- jQuery FIRST -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI SECOND (for sortable + autocomplete) -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- Bootstrap Bundle THIRD -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- ✅ CKEditor (optional for forms) -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
    <script src="{{ asset('employee/js/ck-editor.js') }}"></script>

    <!-- ✅ Custom App JS -->
    <script src="{{ asset('employee/js/app.js') }}"></script>

    <!-- ✅ Global Scripts -->
    <script>
        // 🔍 Autocomplete Search (optional)
        $(function() {
            $('#searchInput').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '{{ route("employee.search") }}',
                        dataType: 'json',
                        data: { query: request.term },
                        success: function(data) {
                            response(data.stores || []);
                        }
                    });
                },
                minLength: 1
            });
        });
    </script>

    <!-- ✅ DataTables Initialization (Optional global setup) -->
    <script>
      
                    function sendOrderToServer() {
                var order = [];
                var token = '{{ csrf_token() }}';

                $('#tablecontents tr').each(function (index, element) {
                    order.push({
                        id: $(this).data("id"),
                        position: index + 1
                    });
                });

                $.ajax({
                    url: "{{ route('employee.coupon.update-order') }}",
                    method: "POST",
                    data: {
                        order: order,
                        _token: token
                    },
                    success: function (response) {
                        if (response.status === "success") {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr) {
                        toastr.error("Error while updating order.");
                        console.error(xhr.responseText);
                    }
                });
            }
    </script>

    @stack('scripts')
</body>
</html>
