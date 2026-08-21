<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Bootstrap 5 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }

        .error-page {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .error-code {
            border-right: 1px solid #adb5bd;
            padding-right: 1rem;
            color: #495057;
            font-size: 1.25rem;
            font-weight: 400;
            letter-spacing: 0.05em;
        }

        .error-message {
            margin-left: 1rem;
            color: #495057;
            font-size: 1.25rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Dark mode */
        @media (prefers-color-scheme: dark) {
            .error-page {
                background-color: #212529;
            }

            .error-code,
            .error-message {
                color: #dee2e6;
            }

            .error-code {
                border-color: #6c757d;
            }
        }

        /* Mobile */
        @media (max-width: 575.98px) {
            .error-code {
                padding-right: 0.75rem;
            }

            .error-message {
                margin-left: 0.75rem;
            }
        }
    </style>
</head>

<body>

    <div
        class="error-page d-flex justify-content-center align-items-center"
        role="main"
    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">

                    <div class="d-flex align-items-center justify-content-center">

                        <h1 class="error-code mb-0">
                            @yield('code')
                        </h1>

                        <div class="error-message">
                            @yield('message')
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>