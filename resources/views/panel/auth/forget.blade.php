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
        <form action="{{route('forget')}}" method="POST" class="InputBox">
          @csrf
            <label for="inp" class="inp">
                <input type="email" name="email" value="{{old('email')}}" id="inp" placeholder="&nbsp;" required>
                <span class="label">ایمیل شما</span>
                <span class="focus-bg"></span>
            </label>
            <label for="inp1" class="inp">
                <input type="password" name="password" id="inp1" placeholder="&nbsp;" required>
                <span class="label">رمزعبور جدید</span>
                <span class="focus-bg"></span>
            </label>
            <label for="inp2" class="inp">
                <input type="password" name="password_confirm" id="inp2" placeholder="&nbsp;" required>
                <span class="label">تکرار رمزعبور</span>
                <span class="focus-bg"></span>
            </label>
            <div type="sumbit" class="InputBTN" style="padding:0">
              <div dir="rtl" class="container">
                  <a class="btn btn-1"><span>تایید</span></a>
              </div>
          </div>
        </form>
       
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
        $(".InputBTN").click(function(){
          $(".InputBox").submit()

        })
    </script>


@endsection
