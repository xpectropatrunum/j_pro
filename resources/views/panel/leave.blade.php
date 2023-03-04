@extends('panel.layouts.master')

@section('title', 'ثبت خروج')

@section('content')
    <div class="main">

        <div class="Gap-Box2"></div>
        <!--باکس لوگو-->
        <div class="Logo-Box">
            <video class="LogoImg" preload="none" autoplay="autoplay" loop="loop" muted="muted" playsinline="">
                <source src="assets/videos/6844394.mp4" type="video/mp4">
            </video>
        </div>
        <!--باکس گپ-->
        <div class="Gap-Box2"></div>
        <!--باکس گزارش-->
        <form action="{{ route('panel.submit_leave') }}" method="POST" class="InputGozaresh">
          @csrf
          <input type="hidden" name="lat">
          <input type="hidden" name="lng">
            <label for="txtMoney" class="inp">
                <input value="{{old("fee")}}" name="fee" type="text" id="txtMoney" onkeyup=" javascript:this.value=itpro(this.value);"
                    placeholder="&nbsp;">
                <span class="label">ایاب و ذهاب (ریال)</span>
                <span class="focus-bg"></span>
            </label>
            <label for="inp2" class="inp">
                <textarea name="note" dir="rtl" name="text" id="inp2" placeholder="&nbsp;" rows="4">{{old("note")}}</textarea>
                <span class="label">گزارش کار</span>
                <span class="focus-bg"></span>
            </label>
        </form>
        <!--باکس دکمه-->
        <div class="InputBTN">
            <div dir="rtl" class="container">
                <a class="btn btn-3">
                    <svg class="svglog" width="26" height="24" viewBox="0 0 26 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 17L25 12M25 12L20 7M25 12L11 12" stroke="#fff6f6" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.704 5C17.3713 5 17.869 4.36871 17.6223 3.74865C16.4518 0.806956 14.0185 4.37403e-08 9.29424 1.00077e-07C1.64048 1.91347e-07 5.91531e-05 2.118 5.92709e-05 12C5.93887e-05 21.882 1.64048 24 9.29425 24C14.0185 24 16.4518 23.193 17.6223 20.2513C17.869 19.6313 17.3713 19 16.704 19V19C16.2515 19 15.8634 19.3009 15.6788 19.714C15.5388 20.0273 15.3879 20.2776 15.2303 20.4811C14.5039 21.4189 13.1179 22 9.29425 22C5.47055 22 4.08457 21.4189 3.35819 20.4811C2.95273 19.9576 2.59125 19.1238 2.34698 17.7047C2.1028 16.2862 2.00006 14.436 2.00006 12C2.00006 9.56404 2.1028 7.71385 2.34698 6.2953C2.59125 4.87622 2.95273 4.04242 3.35819 3.51891C4.08457 2.58107 5.47055 2 9.29424 2C13.1179 2 14.5039 2.58107 15.2303 3.51891C15.3879 3.72237 15.5388 3.97269 15.6788 4.28602C15.8634 4.69912 16.2515 5 16.704 5V5Z"
                            fill="#FF4040FF" />
                    </svg>
                    <span>خروج از شرکت</span></a>
            </div>
        </div>
        <!--دکمه ثانویه/کپی-->
        <div class="forgetpass"><a href="{{ route('panel.main') }}">برگشت</a></div>
    </div>
    <script>
        function itpro(Number) {
            Number += '';
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            x = Number.split('.');
            y = x[0];
            z = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(y))
                y = y.replace(rgx, '$1' + ',' + '$2');
            return y + z;
        }
        $(".InputBTN").click(function(){
          $(".InputGozaresh").submit();

        })
        getLocation()

        function getLocation() {
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
              alert("Geolocation is not supported by this browser.");
            }
          }

          function showPosition(position) {
            $("[name=lat]").val(position.coords.latitude)
            $("[name=lng]").val(position.coords.longitude)

          }
    </script>
@endsection
