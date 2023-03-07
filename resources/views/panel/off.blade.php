@extends('panel.layouts.master')

@section('title', 'ثبت مرخصی')

@section('content')
<link rel="stylesheet" href="{{asset('assets/js/jalalidatepicker/persian-datepicker.min.css')}}">
    <div class="main">

        <div class="Gap-Box12"></div>
        <!--باکس مرخصی-->
        <form action="{{route("panel.submit_off")}}" method="POST" class="InputBoxN">
            @csrf
            <label for="datadasti" class="inp">
                <input name="date" type="text" id="datadasti" placeholder="&nbsp;">
                <input type="text" id="datadasti-alt-field">
                <span class="label1">تاریخ مرخصی</span>
                <span class="focus-bg"></span>
            </label>
            <label for="Fimehandi" class="inp">
                <input name="time" type="time" id="Fimehandi" value="none" placeholder="&nbsp;">
                <span class="label1">مرخصی ساعتی</span>
                <span class="focus-bg"></span>
            </label>
            <div class="Logo-Title">
                <p>در صورتی که می‌خواهید "یک روز کامل" مرخصی ثبت کنید، ساعت را خالی بگذارید!</p>
            </div>
            <div dir="rtl" class="container submit_off">
                <a class="btn btn-4"><svg class="svglog" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.00317 9C4.00317 11 4.00317 11 6.00473 11C8.00628 11 8.00628 11 8.00628 9C8.00628 7 8.00628 7 6.00473 7C4.00317 7 4.00317 7 4.00317 9Z"
                            fill="#F2F2F2" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.00472 0.292219C5.65672 0.355091 5.32334 0.429493 5.00472 0.516722C1.07902 1.59144 -0.607247 4.61302 0.195039 12C1.28112 22 3.88284 24 10.0003 24C14.9198 24 17.5646 22.7066 18.9836 16.9995C18.9941 16.9998 19.0045 17 19.015 17C20.4627 17 21.6301 16.5442 22.4762 15.6079C23.2848 14.713 23.696 13.491 23.9126 12.1607C24.1477 10.7166 23.906 9.41547 23.1668 8.45327C22.4195 7.48052 21.2745 7 20.0156 7C19.99 7 19.9646 7.00097 19.9394 7.00286C19.3968 1.29375 15.9656 0 10.0003 0C8.91293 0 7.91031 0.0429859 6.99437 0.147865C6.65237 0.187027 6.32245 0.234816 6.00472 0.292219ZM20.0139 8.99999C20.0027 9.90965 19.9375 10.907 19.8173 12C19.6979 13.0864 19.5607 14.0784 19.4032 14.9837C20.1686 14.9164 20.6503 14.6454 20.9923 14.2671C21.4261 13.787 21.7481 13.009 21.9386 11.8393C22.1105 10.7834 21.8979 10.0845 21.5808 9.67173C21.2718 9.26948 20.7582 9 20.0156 9C20.015 9 20.0144 8.99999 20.0139 8.99999ZM10.0003 2C8.86237 2 7.86928 2.04969 7.00472 2.16129V7C7.00472 7.55228 6.557 8 6.00472 8C5.45243 8 5.00472 7.55228 5.00472 7V2.61053C3.90383 3.00563 3.23711 3.59585 2.7975 4.41288C2.11137 5.68806 1.76141 7.89907 2.18335 11.7841C2.72343 16.7568 3.60881 19.1835 4.70771 20.4235C5.67038 21.5098 7.09742 22 10.0003 22C12.9027 22 14.3301 21.51 15.2943 20.4229C16.3949 19.182 17.2826 16.7544 17.8293 11.7814C18.3686 6.87563 17.6635 4.69052 16.6533 3.6284C15.621 2.54319 13.6961 2 10.0003 2Z"
                            fill="#F2F2F2" />
                    </svg>

                    <span>ثبت مرخصی</span></a>
            </div>
        </form>
        <!--باکس گپ-->
        <div class="Gap-Box5"></div>
        <!--دکمه ثانویه/کپی-->
        <div class="joboffer"><a href="{{ route('panel.main') }}">مرخصی نیاز ندارم</a></div>
    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('assets/js/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datadasti').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#datadasti-alt-field',
            });
            $('#datadasti').val("")
        });
    </script>
    <script>
        $(".submit_off").click(function() {
            $(".InputBoxN").submit()

        })
    </script>
@endsection
