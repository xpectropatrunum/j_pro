@extends('admin.layouts.master')

@section('title', 'User Login Message')
@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Login Message

            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb @if (app()->getLocale() == 'fa') float-sm-left @else float-sm-right @endif">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard') }}</a></li>
                <li class="breadcrumb-item active">User Login Message

                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-basic-tab" data-toggle="pill"
                                href="#custom-basic-home" role="tab" aria-controls="custom-basic-home"
                                aria-selected="true">Translates</a>
                        </li>



                    </ul>
                </div>

                <div class="tab-content card-body" id="custom-tabs-four-tabContent">
                    <div class="tab-pane active show" id="custom-basic-home" role="tabpanel"
                        aria-labelledby="custom-tabs-basic-tab">

                        <button type="button" class="btn btn-outline-info btn-add-new-translate mb-4"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path
                                    d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z" />
                            </svg> Add new</button>
                        <div class="table-translates px-3">
                            <div class="row mb-3 pb-1 border-bottom">
                                <div class="col-lg-6">Message</div>
                                <div class="col-lg-4">Language</div>
                                <div class="col-lg-2">Action</div>
                            </div>

                            <div class="tbody">
                                @foreach ($items as $item)
                                    <form class="frmSaveTranslate tr mb-4">
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <div class="form-row align-items-center">
                                            <div class="col-lg-6">
                                                <textarea name="message" id="content-{{ $item->id }}" class="editor-translate form-control" required>{{ $item->value }}</textarea>
                                            </div>
                                            <div class="col-lg-4">
                                                <select name="language_id" class="form-control">
                                                    @foreach ($languages as $language)
                                                        <option value="{{ $language->id }}"
                                                            @if ($language->id == $item->language_id) selected @endif>
                                                            {{ $language->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>



                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-success btn-sm btn-save-translate"
                                                    data-toggle="tooltip" title="Save">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                                                    </svg>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm btn-remove-translate">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                        <template id="template-translate-item">

                            <form class="frmSaveTranslate tr mb-4">
                                <input type="hidden" name="id" value="">
                                <div class="form-row align-items-center">
                                    <div class="col-lg-6">
                                        <textarea name="message" id="cont-{ID}" class="editor-translate form-control" required></textarea>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="language_id" class="form-control">
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}">
                                                    {{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-success btn-sm btn-save-translate"
                                            data-toggle="tooltip" title="Save">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm btn-remove-reason">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>


                        </template>
                    </div>
                </div>
            </div>
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
