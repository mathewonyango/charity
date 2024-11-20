<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta name="author" content="{{config('app.name')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{config('app.name')}}">
    <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/png">
    <title>Login | {{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('css/bill-recon.css')}}">
    <link rel="stylesheet" href="{{asset('css/skins/theme-bill-recon.css')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('css/custom.css')}}">
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

    	<script>
        //disable right click

</script>
</head>

<body class="nk-body npc-crypto ui-clean pg-auth">
<div class="nk-app-root">
    <div class="nk-split nk-split-page nk-split-md">
        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container w-lg-45">
            <div class="nk-block  nk-auth-body mt-4">
                <div class="nk-block-head left">
                    <div class="nk-block-head-content mt-4 p-">
                        {{-- <img class="mb-5" style="height: 90px; width: 220px;" src="{{asset('img/charity.jpg')}}"
                             alt="logo"> --}}
                        @include('partials.alerts')
                        <h5 class="nk-block-title">Sign In</h5>
                    </div>
                </div>
                <form method="post" action="{{route('login')}}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="text">Username</label>
                        <input type="text" name="email_or_phone" class="form-control form-control-lg" id="text"
                               placeholder="Email Address" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="form-control-wrap">
                            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch"
                               data-target="password" id="togglePassword" onclick="myFunction()">
                               <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input
                                   name="password" type="password" class="form-control form-control-lg" id="password"
                                   placeholder="Password" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>

            <div class="nk-blockx nk-auth-footer">
                <div class="mt-3">
                    <p>&copy; {{date('Y')}} {{config('app.firm_name')}}. All Rights Reserved.</p>
                </div>
            </div>
        </div>
        <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right"
             data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
            <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                <div class="slider-init slick-initialized slick-slider slick-dotted"
                     data-slick='{"dots":true, "arrows":false}'>
                    <div class="slick-list draggable">
                        <div class="slick-track">
                            <div class="slider-item slick-slide slick-current slick-active" data-slick-index="0"
                                 id="slick-slide00" aria-describedby="slick-slide-control00" aria-hidden="false" tabindex="0">
                                <div class="nk-feature nk-feature-center">
                                    <div class="nk-feature-img" align="center">
                                        <img class="round" src="{{asset('img/donate.jpg')}}"
                                             srcset="{{asset('img/donate.jpg')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="slick-dots" role="tablist">
                        <li class="slick-active" role="presentation">
                            <button type="submit" role="tab" id="slick-slide-control00" aria-controls="slick-slide00"
                                    aria-label="1 of 3" tabindex="0" aria-selected="true">1
                            </button>
                        </li>
                        <li role="presentation">
                            <button type="submit" role="tab" id="slick-slide-control01" aria-controls="slick-slide00"
                                    aria-label="2 of 3" tabindex="0" aria-selected="true">2
                            </button>
                        </li>
                        <li role="presentation">
                            <button type="submit" role="tab" id="slick-slide-control02" aria-controls="slick-slide00"
                                    aria-label="3 of 3" tabindex="0" aria-selected="true">3
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="slider-dots"></div>
                <div class="slider-arrows"></div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/bundle.js?ver=1.4.0')}}"></script>
<script src="{{asset('js/scripts.js?ver=1.4.0')}}"></script>
<script>
    // const togglePassword = document.querySelector('#togglePassword');
    // const password = document.querySelector('#password');

    // togglePassword.addEventListener('click', function(e) {
    //     const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    //     password.setAttribute('type', type);
    // });
    function myFunction() {
        var x = document.getElementById('password');

        if (x.type === 'password') {
            x.type = 'text';
        } else {
            x.type = 'password';
        }
    }
</script>
</body>

</html>
