<head>
    <meta charset="utf-8">
    <meta name="author" content="{{config('app.name')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{config('app.name')}}">
    <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/png">
    <title>@yield('title') | {{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('css/bill-recon.css')}}">
    <link rel="stylesheet" href="{{asset('css/skins/theme-bill-recon.css')}}">
{{--    <link rel="stylesheet" href="{{asset('css/dataTable/jquery.dataTables.min.css')}}">--}}
    <link id="skin-default" rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <style id="antiClickjack">
        body {
            display: none !important;
        }

    </style>
    <style>
        /* Add these styles to your global CSS or component styles */
        .nk-tb-col-tools {
            width: 200px !important;
            min-width: 200px !important;
        }

        /* Ensure buttons maintain consistent size */
        .nk-tb-col-tools .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            white-space: nowrap;
        }

        /* Improve button icon alignment */
        .nk-tb-col-tools .btn em {
            font-size: 14px;
            vertical-align: middle;
            margin-right: 2px;
        }

        /* Ensure proper spacing between buttons */
        .nk-tb-col-tools .gap-2 {
            gap: 0.5rem !important;
        }

        /* Prevent text wrapping in status column */
        .nk-tb-col .badge {
            white-space: nowrap;
        }

        /* Ensure table stays responsive */
        .datatable-init {
            width: 100%;
            overflow-x: auto;
        }

        /* Optional: Add horizontal scrolling for smaller screens */
        @media (max-width: 991px) {
            .card-inner {
                overflow-x: auto;
            }

            .datatable-init {
                min-width: 800px;
            }
        }
        </style>
    <script type="text/javascript">
        if (self === top) {
            var antiClickjack = document.getElementById("antiClickjack");
            antiClickjack.parentNode.removeChild(antiClickjack);
        } else {
            top.location = self.location;
        }
    </script>

{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.body.style.transform = "scale(0.85)";
        document.body.style.transformOrigin = "0 0";
        document.body.style.width = "133.33%"; // Adjust the width to avoid horizontal scrollbars
    });
</script> --}}



</head>
