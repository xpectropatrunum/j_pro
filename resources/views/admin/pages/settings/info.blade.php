@extends('admin.layouts.master')

@section('title', 'Popup info')
@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Popup info

            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb @if (app()->getLocale() == 'fa') float-sm-left @else float-sm-right @endif">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard') }}</a></li>
                <li class="breadcrumb-item active">Popup info

                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Background items info popup (EN)</h5>
                </div>
                <form action="{{ route('admin.settings.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="background">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>about</label>
                                <input type="hidden" name="settings[modal_info][about]"
                                    value="{{ $items['modal_info']['about'] ?? '' }}">
                                <div class="custom-file mb-2">
                                    <input type="file" name="settings[modal_info][about]" onchange="readURL(this)"
                                        class="custom-file-input" id="customFile2">
                                    <label class="custom-file-label"
                                        for="customFile2">{{ $items['modal_info']['about'] ?? 'Choose file' }}</label>
                                </div>
                                <img class="img-fluid img-rounded pic-preview bg-light object-fit-cover"
                                    @if (!empty($items['modal_info']['about'])) src="{{ asset($items['modal_info']['about']) }}" @endif
                                    width="150" height="150">
                            </div>

                            <div class="form-group col-lg-4">
                                <label>faq</label>
                                <input type="hidden" name="settings[modal_info][faq]"
                                    value="{{ $items['modal_info']['faq'] ?? '' }}">
                                <div class="custom-file mb-2">
                                    <input type="file" name="settings[modal_info][faq]" onchange="readURL(this)"
                                        class="custom-file-input" id="customFile1">
                                    <label class="custom-file-label"
                                        for="customFile1">{{ $items['modal_info']['faq'] ?? 'Choose file' }}</label>
                                </div>
                                <img class="img-fluid img-rounded pic-preview bg-light object-fit-cover"
                                    @if (!empty($items['modal_info']['faq'])) src="{{ asset($items['modal_info']['faq']) }}" @endif
                                    width="150" height="150">
                            </div>

                            <div class="form-group col-lg-4">
                                <label>api</label>
                                <input type="hidden" name="settings[modal_info][api]"
                                    value="{{ $items['modal_info']['api'] ?? '' }}">
                                <div class="custom-file mb-2">
                                    <input type="file" name="settings[modal_info][api]" onchange="readURL(this)"
                                        class="custom-file-input" id="customFile1">
                                    <label class="custom-file-label"
                                        for="customFile1">{{ $items['modal_info']['api'] ?? 'Choose file' }}</label>
                                </div>
                                <img class="img-fluid img-rounded pic-preview bg-light object-fit-cover"
                                    @if (!empty($items['modal_info']['api'])) src="{{ asset($items['modal_info']['api']) }}" @endif
                                    width="150" height="150">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit"
                            class="btn btn-primary">{{ __('admin.apply') . ' ' . __('admin.changes') }}</button>
                    </div>
                </form>
            </div>
        </div>




        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Background items info popup (FA)</h5>
                </div>
                <form action="{{ route('admin.settings.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="background">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>about</label>
                                <input type="hidden" name="settings[modal_info_fa][about]"
                                    value="{{ $items['modal_info_fa']['about'] ?? '' }}">
                                <div class="custom-file mb-2">
                                    <input type="file" name="settings[modal_info_fa][about]" onchange="readURL(this)"
                                        class="custom-file-input" id="customFile2">
                                    <label class="custom-file-label"
                                        for="customFile2">{{ $items['modal_info_fa']['about'] ?? 'Choose file' }}</label>
                                </div>
                                <img class="img-fluid img-rounded pic-preview bg-light object-fit-cover"
                                    @if (!empty($items['modal_info_fa']['about'])) src="{{ asset($items['modal_info_fa']['about']) }}" @endif
                                    width="150" height="150">
                            </div>

                            <div class="form-group col-lg-4">
                                <label>faq</label>
                                <input type="hidden" name="settings[modal_info_fa][faq]"
                                    value="{{ $items['modal_info_fa']['faq'] ?? '' }}">
                                <div class="custom-file mb-2">
                                    <input type="file" name="settings[modal_info_fa][faq]" onchange="readURL(this)"
                                        class="custom-file-input" id="customFile1">
                                    <label class="custom-file-label"
                                        for="customFile1">{{ $items['modal_info_fa']['faq'] ?? 'Choose file' }}</label>
                                </div>
                                <img class="img-fluid img-rounded pic-preview bg-light object-fit-cover"
                                    @if (!empty($items['modal_info_fa']['faq'])) src="{{ asset($items['modal_info_fa']['faq']) }}" @endif
                                    width="150" height="150">
                            </div>

                            <div class="form-group col-lg-4">
                                <label>api</label>
                                <input type="hidden" name="settings[modal_info_fa][api]"
                                    value="{{ $items['modal_info_fa']['api'] ?? '' }}">
                                <div class="custom-file mb-2">
                                    <input type="file" name="settings[modal_info_fa][api]" onchange="readURL(this)"
                                        class="custom-file-input" id="customFile1">
                                    <label class="custom-file-label"
                                        for="customFile1">{{ $items['modal_info_fa']['api'] ?? 'Choose file' }}</label>
                                </div>
                                <img class="img-fluid img-rounded pic-preview bg-light object-fit-cover"
                                    @if (!empty($items['modal_info_fa']['api'])) src="{{ asset($items['modal_info_fa']['api']) }}" @endif
                                    width="150" height="150">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit"
                            class="btn btn-primary">{{ __('admin.apply') . ' ' . __('admin.changes') }}</button>
                    </div>
                </form>
            </div>



        </div>
    @endsection

    @push('admin_css')
    @endpush

    @push('admin_js')
        <script>
            $(function() {

                $('.editor-translate').each(function() {
                    CKEDITOR.replace(this.id, {
                        filebrowserUploadUrl: baseUrl() + "admin/upload-image?_token=" + $(
                            'meta[name="csrf-token"]').attr('content'),
                        filebrowserUploadMethod: 'form'
                    });
                });

                var counterTranslate = $(".table-translates .tbody form").length || 0;
                $(".btn-add-new-translate").on("click", function() {
                    html = $("#template-translate-item").html();

                    c = counterTranslate++;
                    html = html.replace(/{ID}/g, c);

                    $(".table-translates .tbody").append(html);

                    setTimeout(function() {
                        CKEDITOR.replace('cont-' + c, {
                            filebrowserUploadUrl: baseUrl() + "admin/upload-image?_token=" + $(
                                'meta[name="csrf-token"]').attr('content'),
                            filebrowserUploadMethod: 'form'
                        });
                    }, 100);
                });
                $(document).on("click", ".btn-remove-translate", function() {
                    id = $(this).closest('form').find('input[name="id"]').val();

                    elem = $(this);

                    if (id.length) {
                        $.ajax({
                            url: "{{ route('admin.settings.messages.remove_alt', 100) }}",
                            type: 'post',
                            data: {
                                'id': id,
                                "_token": "{{ csrf_token() }}",
                            },
                            dataType: 'json',
                            beforeSend: function() {
                                // $("#beforeAfterLoading").addClass("spinner-border");
                            },
                            complete: function() {
                                // $("#beforeAfterLoading").removeClass("spinner-border");
                            },
                            success: function(res) {
                                elem.closest(".tr").fadeOut(function() {
                                    elem.remove();
                                });
                                Toast.fire({
                                    icon: 'success',
                                    'title': 'Record remove successfully'
                                })
                            }
                        });
                    } else {
                        elem.closest(".tr").fadeOut(function() {
                            elem.remove();
                        });
                    }
                });
                $('body').on('submit', '.frmSaveTranslate', function(e) {
                    e.preventDefault();
                    form = $(this);
                    $button = $(this).find('.btn-save-translate');
                    data = $(this).serializeArray();
                    data.push({
                        name: "_token",
                        value: "{{ csrf_token() }}"
                    });
                    $.ajax({
                        url: "{{ route('admin.settings.messages.save_alt', 100) }}",
                        type: 'post',
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $button.find(".spinner-border").css('display', 'inline-block');
                        },
                        complete: function() {
                            $button.find(".spinner-border").hide();
                        },
                        success: function(res) {
                            if (res.status) {
                                form.find('input[name="id"]').val(res.id);
                                Toast.fire({
                                    icon: 'success',
                                    'title': res.message
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    'title': res.message
                                })
                            }
                        }
                    });
                });

            })
        </script>
    @endpush
