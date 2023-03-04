@extends('panel.layouts.auth')

@section('title', "ورود به حساب")

@section('content')
<div class="main">
 
  

    <div class="Gap-Box12"></div>
    <!--باکس لوگو-->
    <div class="Logo-Box">
      <video class="LogoImg" preload="none" autoplay="autoplay" loop="loop" muted="muted" playsinline="">
        <source src="{{asset('assets/videos/8717908.mp4')}}" type="video/mp4">
      </video>
    </div>
    <!--باکس گپ-->
    <div class="Gap-Box3"></div>
    <!--باکس اینپوت-->
    <form id="form" action="{{route('login.attemp')}}" method="POST"  class="InputBox">
        @csrf
      <label style="margin-bottom: 10px!important;" for="inp" class="inp">
        <input name="username"  value="{{old("username")}}" type="text" id="inp"  placeholder="&nbsp;">
        <span class="label">نام‌کاربری</span>
        <span class="focus-bg"></span>
      </label>
      <label for="inp1" class="inp">
        <input name="password" type="password" id="inp1"  placeholder="&nbsp;">
        <span class="label">رمزعبور</span>
        <span class="focus-bg"></span>
      </label>
    </form>
    <!--باکس دکمه-->
    <div class="InputBTN">
      <div class="container">
        <a class="btn btn-1">ورود به حساب</a>
      </div>
    </div>
    <!--باکس گپ-->
    <div class="Gap-Box5"></div>
    <!--دکمه ثانویه/کپی-->
    <div class="forgetpass"><a href="{{route("forget")}}">بازیابی رمزعبور</a></div>
  </div>
  <script>
 
      document.getElementById('inp1').onkeydown = function(e){
        if(e.keyCode == 13){
          document.getElementById('form').submit()
        }
     };
     document.getElementById('inp').onkeydown = function(e){
      if(e.keyCode == 13){
        document.getElementById('form').submit()
      }
   };
   $(".InputBTN").click(function(){
    $(".InputBox").submit()

  })
  </script>
@endsection
