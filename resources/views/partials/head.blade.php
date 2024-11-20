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
    <script type="text/javascript">
        if (self === top) {
            var antiClickjack = document.getElementById("antiClickjack");
            antiClickjack.parentNode.removeChild(antiClickjack);
        } else {
            top.location = self.location;
        }
    </script>


</head>
