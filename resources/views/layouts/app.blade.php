<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles -->
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/1254/1254741.png?w=740&t=st=1655357647~exp=1655358247~hmac=a8c743d566dec8f5519d3895e92536cd312dd9a921807201baeb83c6ba4b6bc5">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/theme_color.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/breadcrumb.css') }}">
    <link rel="stylesheet" href="{{ asset('css/upload_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_link.css') }}">
    <link rel="stylesheet" href="{{ asset('css/input_box.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filter_search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    @yield('styles')

    <title>@yield('title')</title>

    <style>
        .container {
            max-width: 1320px;
            margin: 0 auto;
        }

        .card_head_title {
            background-image: linear-gradient(to right, #f2f3f2, #12ca8a);
            color: black;
            text-decoration: none;
            display: block;
        }

        .head_title {
            background-image: linear-gradient(to right, #12ca8a, #115A40);
            color: white;
            display: block;
        }

        #btn-back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
        }

        textarea {
            resize: none !important;
        }

        .result {
            color: white;
            background-color: #12ca8a;
            border-radius: 10px;
            padding: 2.5px 5px;
            font-size: 16px;
            margin-right: 5px;
            margin-bottom: 5px;
            width: max-content;
            display: inline-block;
        }


        td,
        th {
            border: solid 1px black;
        }

        .pagination li {
            display: inline;
            padding: 2px;
        }

        .pagination a {
            border: 1px solid #D5D5D5;
            color: #666666;
            border-radius: 50%;
            font-size: 11px;
            font-weight: bold;
            height: 25px;
            padding: 11px 15px;
            text-decoration: none;
            margin: 2px;
        }

        .pagination a:hover,
        .pagination a:active {
            background: #efefef;
        }

        .pagination span.current {
            background-color: #687282;
            border: 1px solid #D5D5D5;
            color: #ffffff;
            font-size: 11px;
            font-weight: bold;
            height: 25px;
            padding: 4px 8px;
            text-decoration: none;
            margin: 2px;
        }

        .pagination span.disabled {
            border: 1px solid #EEEEEE;
            color: #DDDDDD;
            margin: 2px;
            padding: 2px 5px;
        }

        .active .pagispan {
            border: 1px solid #D5D5D5;
            color: white;
            border-radius: 50%;
            background-color: #12ca8a;
            font-size: 11px;
            font-weight: bold;
            height: 25px;
            padding: 11px 15px;
            text-decoration: none;
            margin: 2px;
        }

        li span {
            border: 1px solid #D5D5D5;
            color: #666666;
            border-radius: 50%;
            font-size: 11px;
            font-weight: bold;
            height: 25px;
            padding: 11px 15px;
            text-decoration: none;
            margin: 2px;
        }

        .col-1-5 {
            flex-basis: 12.5%;
            max-width: 12.5%;
        }

        .col-6-5 {
            flex: 0 0 52.17%;
            max-width: 52.17%;
        }








        @media only screen and (min-width: 799px) and (max-width: 991px) {
            .footer {
                display: none;
            }

            .col-6-5 {
                flex: 1 0 60.17%;
                max-width: 54.17%;
            }

        }

        @media only screen and (min-width: 10px) and (max-width: 798px) {
            .footer {
                display: none;
            }

            .col-1-5 {
                flex-basis: 16.5%;
                max-width: 16.5%;
            }

            .col-6-5 {
                flex: 1 0 60.17%;
                max-width: 67.17%;
            }

            .searchBtn {
                flex: 0 0 auto;
                width: 100%;
            }
        }
    </style>
</head>

<body class="theme_bg_gray content-2 m-0 p-0" style="position: relative;">

    @include('components.loader')

    <div id="contents">

        @include('layouts.navbar')

        @yield ('content')
        <!-- Footer--->
        @include('layouts.footer')
        <div class="footer" style="position:fixed; right:8vh; bottom:10vh;">
            <a type="button" href="#" class="color-light button theme_bg_green rounded-circle" style="width: 50px; height: 50px; box-sizing: content-box;" title="Go to Top" id="btn-back-to-top">
                <img src="/images/icons/return_to_top.png" class="center" alt="Back_To_Top_Icon">
            </a>
        </div>

        <!-- Scripts -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            let mybutton = document.getElementById("btn-back-to-top");

        // When the user scrolls down 200px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 200 ||
                document.documentElement.scrollTop > 200
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
          //dropdown search

        new TomSelect('#manufac-search');
        new TomSelect('#year-search');
        new TomSelect('#buildtype-search');
        new TomSelect('#plate-search');

        </script>
        <script src="/js/filter_search.js"></script>
        <script src="/js/flip.js"></script>
        @yield('scripts')
    </div>
</body>

</html>