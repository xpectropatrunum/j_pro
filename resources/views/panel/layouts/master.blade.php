<!DOCTYPE html>
<html dir="ltr" lang="fa">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" media="all" />
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-Variable-font-face.css"
        rel="stylesheet" type="text/css" />
    <title>@yield('title') - تزول</title>
    <meta name="copyright" content="Tzol" />
    <meta name="owner" content="Javad Hasanloo" />
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">
    <script src="{{ asset('assets/js/jquery.js') }}"></script>

    <meta name="apple-mobile-web-app-status-bar-style" content="#fff">
    <meta name="apple-mobile-web-app-status-bar" content="#fff" />
    <meta name="theme-color" content="#fff">
    <meta name="msapplication-navbutton-color" content="#fff">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/icon-tzol72.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/icon-tzol96.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/icon-tzol128.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/icon-tzol144.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/icon-tzol152.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/icon-tzol192.png') }}" />
</head>

<body>

    @yield('content')






    <div class="append-alert"></div>
    @if (session('error'))
        <div dir="rtl" class="textshow alert__">
            <svg class="svglog1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1 12C1 14.4477 1.13246 16.3463 1.46153 17.827C1.78807 19.2963 2.29478 20.2921 3.00136 20.9986C3.70794 21.7052 4.70365 22.2119 6.17298 22.5385C7.65366 22.8675 9.55232 23 12 23C14.4477 23 16.3463 22.8675 17.827 22.5385C19.2963 22.2119 20.2921 21.7052 20.9986 20.9986C21.7052 20.2921 22.2119 19.2963 22.5385 17.827C22.8675 16.3463 23 14.4477 23 12C23 9.55232 22.8675 7.65366 22.5385 6.17298C22.2119 4.70365 21.7052 3.70794 20.9986 3.00136C20.2921 2.29478 19.2963 1.78807 17.827 1.46153C16.3463 1.13246 14.4477 1 12 1C9.55232 1 7.65366 1.13246 6.17298 1.46153C4.70365 1.78807 3.70794 2.29478 3.00136 3.00136C2.29478 3.70794 1.78807 4.70365 1.46153 6.17298C1.13246 7.65366 1 9.55232 1 12Z"
                    stroke="#F2994A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M13 17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17V11C11 10.4477 11.4477 10 12 10C12.5523 10 13 10.4477 13 11V17ZM12 9C11.4477 9 11 8.55229 11 8C11 7.44772 11.4477 7 12 7C12.5523 7 13 7.44772 13 8C13 8.55229 12.5523 9 12 9Z"
                    fill="#F2994A" />
            </svg>


            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div dir="rtl" class="textshow alert__">
            <svg class="svglog1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1 12C1 14.4477 1.13246 16.3463 1.46153 17.827C1.78807 19.2963 2.29478 20.2921 3.00136 20.9986C3.70794 21.7052 4.70365 22.2119 6.17298 22.5385C7.65366 22.8675 9.55232 23 12 23C14.4477 23 16.3463 22.8675 17.827 22.5385C19.2963 22.2119 20.2921 21.7052 20.9986 20.9986C21.7052 20.2921 22.2119 19.2963 22.5385 17.827C22.8675 16.3463 23 14.4477 23 12C23 9.55232 22.8675 7.65366 22.5385 6.17298C22.2119 4.70365 21.7052 3.70794 20.9986 3.00136C20.2921 2.29478 19.2963 1.78807 17.827 1.46153C16.3463 1.13246 14.4477 1 12 1C9.55232 1 7.65366 1.13246 6.17298 1.46153C4.70365 1.78807 3.70794 2.29478 3.00136 3.00136C2.29478 3.70794 1.78807 4.70365 1.46153 6.17298C1.13246 7.65366 1 9.55232 1 12Z"
                    stroke="#F2994A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M13 17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17V11C11 10.4477 11.4477 10 12 10C12.5523 10 13 10.4477 13 11V17ZM12 9C11.4477 9 11 8.55229 11 8C11 7.44772 11.4477 7 12 7C12.5523 7 13 7.44772 13 8C13 8.55229 12.5523 9 12 9Z"
                    fill="#F2994A" />
            </svg>

            <span>{{ $errors->all()[0] }}</span>
        </div>
    @endif


    @if (session('success'))
        <div dir="rtl" class="textshow alert__">

            @if (session('icon') && session('icon') == 'login')
                <svg class="svglog1" width="22" height="24" viewBox="0 0 22 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 7L15 12M15 12L10 17M15 12L1 12" stroke="#F6FFF8FF" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.296 19C4.62866 19 4.13099 19.6313 4.37771 20.2513C5.54824 23.193 7.98146 24 12.7057 24C20.3595 24 21.9999 21.882 21.9999 12C21.9999 2.118 20.3595 -7.01394e-07 12.7057 -3.66838e-07C7.98146 -1.60332e-07 5.54824 0.806956 4.37771 3.74865C4.13099 4.36871 4.62866 5 5.296 5V5C5.74846 5 6.13662 4.69912 6.32119 4.28602C6.46119 3.97269 6.61212 3.72237 6.7697 3.51891C7.49607 2.58107 8.88205 2 12.7057 2C16.5294 2 17.9154 2.58107 18.6418 3.51891C19.0472 4.04241 19.4087 4.87622 19.653 6.2953C19.8972 7.71385 19.9999 9.56404 19.9999 12C19.9999 14.436 19.8972 16.2861 19.653 17.7047C19.4087 19.1238 19.0472 19.9576 18.6418 20.4811C17.9154 21.4189 16.5294 22 12.7057 22C8.88206 22 7.49607 21.4189 6.7697 20.4811C6.61212 20.2776 6.46119 20.0273 6.32119 19.714C6.13662 19.3009 5.74846 19 5.296 19V19Z"
                        fill="#00ff66"></path>
                </svg>
            @else
                <svg class="svglog1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 10L11 15L9 13" stroke="#6FCF97" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M10.1909 1.89863C11.0994 0.700456 12.9006 0.700456 13.8091 1.89863L14.9438 3.39506C15.1917 3.72195 15.5966 3.88968 16.003 3.8338L17.8635 3.578C19.3531 3.37318 20.6268 4.64685 20.422 6.13651L20.1662 7.99698C20.1103 8.40339 20.2781 8.80832 20.6049 9.05618L22.1014 10.1909C23.2995 11.0994 23.2995 12.9006 22.1014 13.8091L20.6049 14.9438C20.2781 15.1917 20.1103 15.5966 20.1662 16.003L20.422 17.8635C20.6268 19.3531 19.3531 20.6268 17.8635 20.422L16.003 20.1662C15.5966 20.1103 15.1917 20.2781 14.9438 20.6049L13.8091 22.1014C12.9006 23.2995 11.0994 23.2995 10.1909 22.1014L9.05618 20.6049C8.80832 20.2781 8.40339 20.1103 7.99698 20.1662L6.13651 20.422C4.64685 20.6268 3.37318 19.3531 3.578 17.8635L3.8338 16.003C3.88968 15.5966 3.72195 15.1917 3.39506 14.9438L1.89863 13.8091C0.700456 12.9006 0.700456 11.0994 1.89863 10.1909L3.39506 9.05618C3.72195 8.80832 3.88968 8.40339 3.8338 7.99698L3.578 6.13651C3.37318 4.64685 4.64685 3.37318 6.13651 3.578L7.99698 3.8338C8.40339 3.88968 8.80832 3.72195 9.05618 3.39506L10.1909 1.89863Z"
                        stroke="#6FCF97" stroke-width="2" />
                </svg>
            @endif


            <span>{{ session('success') }}</span>
        </div>
    @endif
    <script>
        setTimeout(() => {
            $(".alert__").hide(500)
        }, 5000)
    </script>

</body>

</html>
