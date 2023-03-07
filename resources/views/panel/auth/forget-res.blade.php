@extends('panel.layouts.auth')

@section('title', 'فراموشی رمزعبور')

@section('content')
    <div class="main">
        
        <!--باکس گپ-->
        <div class="Gap-Box8"></div>
        <!--باکس لوگو-->
        <div class="Logo-Box">
            <video class="LogoImg" preload="none" autoplay="autoplay" loop="loop" muted="muted" playsinline="">
                <source src="assets/videos/7920885.mp4" type="video/mp4">
            </video>
        </div>
        <!--باکس تایتل-->
        <div class="Logo-Title">
            <h1>بازیابی / ویرایش رمزعبور</h1>
        </div>
        <!--باکس گپ-->
        <div class="Gap-Box2"></div>
        <!--باکس اینپوت-->
        <div class="InputBox">
            <div style="text-align: center">{{$msg}}</div>
          
        </div>
       
        <div class="Gap-Box2"></div>
        <!--دکمه ثانویه/کپی-->
        <div class="joboffer"><a href="{{ route('login') }}">برگشت</a></div>
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
   
    </script>


@endsection
