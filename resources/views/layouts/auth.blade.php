<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/1254/1254741.png?w=740&t=st=1655357647~exp=1655358247~hmac=a8c743d566dec8f5519d3895e92536cd312dd9a921807201baeb83c6ba4b6bc5">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="Styles/home.css">

    <link rel="stylesheet" href="{{ asset('css/theme_color.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/upload_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_link.css') }}">


    <title>@yield('title')</title>

    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        .theme_gray {
            color: #f2f3f2;
        }

        .theme_green {
            color: #12ca8a;
        }


        .theme_bg_gray {
            background-color: #f2f3f2;
        }

        .theme_bg_green {
            background-color: #12ca8a;
        }

        .button:hover {
            background-color: #12ca8a;
        }

        .form-select:focus {
            box-shadow: 0 0 0 0.25rem #93f9b9;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem #93f9b9;
        }

        @media only screen and (min-width: 992px) {
            body {
                background-image: url("/images/login_background.svg");
                background-size: cover;
                background-repeat: no-repeat;
                height: 100vh;
                padding: 0px 20px;
            }

            .mobile {
                height: 85vh;
            }
        }

        @media only screen and (min-width: 576px) and (max-width: 991px) {
            .mobile {
                background-image: url("/images/login_background.svg");
                background-size: cover;
                background-repeat: no-repeat;
                height: 70vh;
            }

            .margin_bot {
                margin-bottom: 40px;
            }

            .none {
                display: none;
            }

            .custom_container {
                padding: 0px 60px;
            }
        }

        @media only screen and (min-width: 10px) and (max-width: 575px) {
            .mobile {
                background-image: url("/images/login_mobile.svg");
                background-size: cover;
                background-repeat: no-repeat;
                height: 60vh;
            }

            .margin_bot {
                margin-bottom: 40px;
            }

            .none {
                display: none;
            }
        }
    </style>
</head>

<body>
    @yield ('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/login.js"></script>
</body>

</html>