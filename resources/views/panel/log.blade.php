@extends('panel.layouts.master')

@section('title', 'ثبت ورود')

@section('content')
    <div class="main">
       
        <div class="Gap-Box8"></div>
        <!--باکس لوگو-->
        <div class="Logo-Box">
            <video class="LogoImg" preload="none" autoplay="autoplay" loop="loop" muted="muted" playsinline="">
                <source src="{{ asset('assets/videos/6839006.mp4') }}" type="video/mp4">
            </video>
        </div>
        <!--باکس گپ-->
        <div class="Gap-Box2"></div>
        <!--باکس اینپوت-->
        <form action="{{route("panel.log_submit")}}" method="POST" class="InputBox">
            @csrf
            <input type="hidden" name="lat">
            <input type="hidden" name="lng">
            <select name="project" dir="rtl" class="form-select" aria-label="Default select example">
                <option value="0">انتخاب پروژه</option>
               @foreach (auth()->user()->supervisor()->first()?->projects()->where("status", 0)->get() ?? [] as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                   
               @endforeach
            </select>
            <label for="Fimehandi" class="inp">
                <input name="time" type="time" id="Fimehandi" placeholder="&nbsp;">
                <span class="label1">تایم ورود دستی</span>
                <span class="focus-bg"></span>
            </label>
        </form>
        <!--باکس دکمه-->
        <div class="InputBTN">
            <div dir="rtl" class="container">
                <a class="btn btn-2"><svg class="svglog" width="22" height="24" viewBox="0 0 22 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 7L15 12M15 12L10 17M15 12L1 12" stroke="#F6FFF8FF" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.296 19C4.62866 19 4.13099 19.6313 4.37771 20.2513C5.54824 23.193 7.98146 24 12.7057 24C20.3595 24 21.9999 21.882 21.9999 12C21.9999 2.118 20.3595 -7.01394e-07 12.7057 -3.66838e-07C7.98146 -1.60332e-07 5.54824 0.806956 4.37771 3.74865C4.13099 4.36871 4.62866 5 5.296 5V5C5.74846 5 6.13662 4.69912 6.32119 4.28602C6.46119 3.97269 6.61212 3.72237 6.7697 3.51891C7.49607 2.58107 8.88205 2 12.7057 2C16.5294 2 17.9154 2.58107 18.6418 3.51891C19.0472 4.04241 19.4087 4.87622 19.653 6.2953C19.8972 7.71385 19.9999 9.56404 19.9999 12C19.9999 14.436 19.8972 16.2861 19.653 17.7047C19.4087 19.1238 19.0472 19.9576 18.6418 20.4811C17.9154 21.4189 16.5294 22 12.7057 22C8.88206 22 7.49607 21.4189 6.7697 20.4811C6.61212 20.2776 6.46119 20.0273 6.32119 19.714C6.13662 19.3009 5.74846 19 5.296 19V19Z"
                            fill="#00ff66" />
                    </svg><span>ورود به شرکت</span></a>
            </div>
        </div>
        <!--باکس گپ-->
        <div class="Gap-Box2"></div>
        <!--دکمه ثانویه/کپی-->
        <div class="joboffer"><a href="{{route('panel.off')}}">ثبت مرخصی</a></div>
        <!--دکمه ثانویه/کپی-->
        <div class="forgetpass"><a href="{{route('forget')}}">تغییر رمزعبور</a></div>
        <div class="forgetpass ExitA"><a href="{{route('panel.logout')}}">خروج از حساب کاربری</a></div>
    </div>


    <script>
        
        $(".InputBTN").click(function() {
            if($("[name=project]").val() == "0"){
                $(".alert__").hide(500)
                $(".append-alert").html(` <div dir="rtl" class="textshow alert__">
                    <svg class="svglog1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1 12C1 14.4477 1.13246 16.3463 1.46153 17.827C1.78807 19.2963 2.29478 20.2921 3.00136 20.9986C3.70794 21.7052 4.70365 22.2119 6.17298 22.5385C7.65366 22.8675 9.55232 23 12 23C14.4477 23 16.3463 22.8675 17.827 22.5385C19.2963 22.2119 20.2921 21.7052 20.9986 20.9986C21.7052 20.2921 22.2119 19.2963 22.5385 17.827C22.8675 16.3463 23 14.4477 23 12C23 9.55232 22.8675 7.65366 22.5385 6.17298C22.2119 4.70365 21.7052 3.70794 20.9986 3.00136C20.2921 2.29478 19.2963 1.78807 17.827 1.46153C16.3463 1.13246 14.4477 1 12 1C9.55232 1 7.65366 1.13246 6.17298 1.46153C4.70365 1.78807 3.70794 2.29478 3.00136 3.00136C2.29478 3.70794 1.78807 4.70365 1.46153 6.17298C1.13246 7.65366 1 9.55232 1 12Z"
                            stroke="#F2994A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M13 17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17V11C11 10.4477 11.4477 10 12 10C12.5523 10 13 10.4477 13 11V17ZM12 9C11.4477 9 11 8.55229 11 8C11 7.44772 11.4477 7 12 7C12.5523 7 13 7.44772 13 8C13 8.55229 12.5523 9 12 9Z"
                            fill="#F2994A" />
                    </svg>
        
        
                    <span>لطفا پروژه مورد نظر را انتخاب نمایید</span>
                </div>`);
                setTimeout(() => {
                    $(".append-alert").hide(500)
                }, 5000);
                return;
            }
          
            $(".InputBox").submit()

        })
        getLocation()

        function getLocation() {
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
              alert("Geolocation is not supported by this browser.");
            }
          }
          $('input').keypress(function (e) {
            if (e.which == 13) {
              $('.InputBox').submit();
              return false;    
            }
          });
          function showPosition(position) {
            $("[name=lat]").val(position.coords.latitude)
            $("[name=lng]").val(position.coords.longitude)

          }
    </script>
@endsection
