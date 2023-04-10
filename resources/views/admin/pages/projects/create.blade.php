@extends('admin.layouts.master')

@section('title', __('Create new project'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Create new project') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb @if (app()->getLocale() == 'fa') float-sm-left @else float-sm-right @endif">
                <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">{{ __('List projects') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create new project') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/mapp.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fa/style.css') }}" />

    <style>
        #app {
            width: 100%;
            height: 500px;
        }
    </style>
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create new project') }}</h3>
            </div>
            <form action="{{ route('admin.projects.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-lg-3">
                            <label>{{ __('Name') }}</label>
                            <input type="text" value="{{ old('name') }}" name="name"
                                class="form-control @error('name') is-invalid @enderror" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>{{ __('Company') }}</label>

                            <input type="text" value="{{ old('company_name') }}" name="company_name"
                                class="form-control @error('company_name') is-invalid @enderror" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>{{ __('max distance in meter') }}</label>

                            <input type="text" value="{{ old('area') }}" name="area"
                                class="form-control @error('area') is-invalid @enderror" required>
                        </div>


                        <div class="form-group col-lg-3">
                            <label>{{ __('Status') }}</label>

                            <select name="status" class="form-control @error('area') is-invalid @enderror">
                                <option value="0">{{ __('Processing') }}</option>
                                <option value="1">{{ __('Done') }}</option>
                                <option value="2">شروع نشده</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-3">
                            <label>{{ __('Lat') }}</label>

                            <input class="form-control" type="text" name="x" value="35.69522525087309" required>
                        </div>

                        <div class="form-group col-lg-3">
                            <label>{{ __('Lng') }}</label>

                            <input class="form-control" type="text" name="y" value="51.286239624023445" required>

                        </div>
                        <div class="form-group col-lg-12">
                            <label>{{ __('Address') }}</label>

                            <div id="app"></div>
                        </div>


                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-left">
                    <button type="button" class="submit btn btn-primary">{{ __('admin.add') }}</button>
                </div>
            </form>
            <script type="text/javascript"></script>
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection

@push('admin_css')
@endpush

@push('admin_js')
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>

    <script>
        var marker;
        $(".submit").click(function() {
            $("[name=x]").val(marker.getLatLng().lat);
            $("[name=y]").val(marker.getLatLng().lng);
            $("form").submit();

        });
        $("[name=x]").change(function() {

            marker.setLatLng({
                lng: $("[name=y]").val(),
                lat: $("[name=x]").val(),
            })
        })
        $("[name=y]").change(function() {
            marker.setLatLng({
                lat: $("[name=x]").val(),
                lng: $("[name=y]").val(),

            })

        })
        var app;
        $(document).ready(function() {

            app = new Mapp({
                element: '#app',
                presets: {
                    latlng: {
                        lat: "35.69522525087309",
                        lng: "51.286239624023445",
                    },
                    zoom: 6
                },
                i18n: {
                    fa: {
                        'marker-title': 'مکان انتخاب شده',
                        'marker-description': '--',
                    },
                    en: {
                        'marker-title': 'Title',
                        'marker-description': 'Description',
                    },
                },
                locale: 'en',
                apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImNiZTA1YWY0OWYyNWM0OTU5NDE2ZmI2YmI4ODk1ZGQ4NTU5ZjExYWY4ZDBiY2YwYjc1MjhjOGRiM2YzNGNiMmM5M2ZmNGEzZjNiY2NiZWU3In0.eyJhdWQiOiIyMTMzOSIsImp0aSI6ImNiZTA1YWY0OWYyNWM0OTU5NDE2ZmI2YmI4ODk1ZGQ4NTU5ZjExYWY4ZDBiY2YwYjc1MjhjOGRiM2YzNGNiMmM5M2ZmNGEzZjNiY2NiZWU3IiwiaWF0IjoxNjc3Nzc5MTk2LCJuYmYiOjE2Nzc3NzkxOTYsImV4cCI6MTY4MDE5ODM5Niwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.lXVgHpKUJ6p_Lcdnyr6JkVdzYN8voi3MWRknj4KSX0OF9M84Jgy_H5pMJcymI4UmEMm7pxvVo6_eH8puGG6ERlqlqomMvRBluayYHqsflMj7MRwJCCZ1Kx3UK8PV7A03I6MevVV7k_etCQVjgTFCCG3_9JXznWVoHrK6UdX8lnLHZ3ZCyX0OyssP8-CTEqcSwYG6ohR43twAhwjbQaiq0SVfSoVjVXqgDrobjNEm8GEIzJOxfqliGmH8W5YLYZzw4QZyMSlv8VoQ-cNKExNpBcSwtCxQzwlFhtp-ZJcfu2Qnd8tcZNZgRLPKwz2ygTr6dUfJPD9P9TeJd0i_WDgzkQ'
            });
            app.addLayers();
            marker = app.addMarker({
                name: 'advanced-marker',
                latlng: {
                    lat: "35.69522525087309",
                    lng: "51.286239624023445",
                },
                icon: app.icons.red,
                popup: {
                    title: {
                        i18n: 'marker-title',
                    },
                    description: {
                        i18n: 'marker-description',
                    },
                    // custom: 'Custom popup',
                    class: 'marker-class',
                    open: true,
                },
                pan: false,
                draggable: true,
                history: false,
                on: {
                    click: function() {
                        $("[name=x]").val(marker.getLatLng().lat);
                        $("[name=y]").val(marker.getLatLng().lng);
                    },
                    contextmenu: function() {
                        console.log('Contextmenu callback');
                    },

                },
            });

        });
    </script>
@endpush
