@extends('panel.layouts.master')

@section('title', 'درحال فعالیت')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/js/jalalidatepicker/persian-datepicker.min.css') }}">

    <div class="main">

        <div class="Gap-Box10"></div>
        <!--باکس نامه-->
        <form action="{{ route('panel.submit_letter') }}" method="POST" class="InputBoxN">
            @csrf
            <select name="title" dir="rtl" class="form-select" aria-label="Default select example">
                <option value="0">موضوع نامه</option>
                @foreach (auth()->user()->supervisor()->first()->letter_subjects()->where("enable", 1)->get() as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
            <label for="datadasti" class="inp">
                <input name="date" type="text" id="datadasti" x placeholder="&nbsp;">
                <input  type="text" id="datadasti-alt-field">
                <span class="label1">تاریخ</span>
                <span class="focus-bg"></span>
            </label>
            <div dir="rtl" class="container InputBTN__">
                <a class="btn btn-1"><svg class="svglog" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 1C14.4525 1 16.3618 1.11137 17.855 1.39866C19.3432 1.68498 20.3438 2.13251 21.0445 2.75018C22.4367 3.97734 23 6.19513 23 10.6667C23 13.5482 22.7413 15.6685 22.0447 17.0498C21.7104 17.7127 21.2871 18.1797 20.7543 18.4903C20.2159 18.8042 19.494 19 18.5002 19C17.2191 19 16.2575 19.2877 15.5056 19.7971C14.7717 20.2944 14.329 20.9455 13.9997 21.4637C13.9499 21.542 13.9032 21.6161 13.8591 21.6862C13.583 22.1245 13.4043 22.4082 13.1562 22.6307C12.9352 22.8291 12.6262 23 12.0003 23C11.3744 23 11.0654 22.8291 10.8443 22.6307C10.5963 22.4081 10.4176 22.1245 10.1415 21.6862C10.0974 21.6161 10.0507 21.542 10.0009 21.4636C9.67154 20.9454 9.22884 20.2944 8.4949 19.7971C7.74298 19.2877 6.7814 19 5.50024 19C4.51174 19 3.79218 18.7993 3.25388 18.4789C2.71963 18.1609 2.29353 17.6832 1.95707 17.0102C1.25807 15.612 1 13.488 1 10.6667C1 6.25195 1.56175 4.02841 2.95861 2.78674C3.66142 2.16203 4.66352 1.70608 6.14984 1.41246C7.64154 1.11777 9.54955 1 12 1Z"
                            stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="8" cy="11" r="1" fill="#fff" />
                        <circle cx="12" cy="11" r="1" fill="#fff" />
                        <circle cx="16" cy="11" r="1" fill="#fff" />
                    </svg><span>دریافت شماره نامه</span></a>
            </div>
        </form>
    <!--باکس گپ-->
    <div class="Gap-Box4"></div>
    <!--باکس دکمه-->
    <div class="InputBTN">
        <div dir="rtl" class="container">
            <a href="{{ route('panel.leave') }}" class="btn btn-1"><span>پایان کار</span></a>
        </div>
    </div>
    <!--باکس گپ-->
    <div class="Gap-Box2"></div>
    <!--دکمه ثانویه/کپی-->
    <div class="joboffer"><a href="{{ route('panel.off') }}">ثبت مرخصی</a></div>
    <!--دکمه ثانویه/کپی-->
    <div class="forgetpass"><a href="{{ route('forget') }}">تغییر رمزعبور</a></div>
    <div class="forgetpass ExitA"><a href="{{ route('panel.logout') }}">خروج از حساب کاربری</a></div>
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
        });
        $(".InputBTN__").click(function() {
            if ($("[name=title]").val() == "0") {
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
      
      
                  <span>لطفا موضوع مورد نظر را انتخاب نمایید</span>
              </div>`);
                setTimeout(() => {
                    $(".append-alert").hide(500)
                }, 5000);
                return;
            }

            $(".InputBoxN").submit()

        })
    </script>
@endsection
