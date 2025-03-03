@extends('adminlayout.master')

@section('title', 'Hakkımızda Düzenle')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
            <li class="breadcrumb-item"><a href="">Hakkımızda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hakkımızda Düzenle</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Hakkımızda Düzenle</h6>

                    <ul class="nav nav-tabs" role="tablist">
                        @foreach(config('app.available_locales', ['tr', 'en']) as $locale)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                   id="tab-{{ $locale }}-tab"
                                   data-bs-toggle="tab"
                                   href="#tab-{{ $locale }}"
                                   role="tab">
                                    {{ strtoupper($locale) }} {{ $locale == 'tr' ? '(Türkçe)' : '(English)' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <form id="hakkimizdaDuzenle" method="POST" action="{{ route('hakkimizda-guncelle', $hakkimizda->id ?? 0) }}">
                        @csrf
                        @method('PUT')

                        <div class="tab-content pt-3">
                            @foreach(config('app.available_locales', ['tr', 'en']) as $locale)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                     id="tab-{{ $locale }}"
                                     role="tabpanel">

                                    <input type="hidden"
                                           name="translations[{{ $locale }}][locale]"
                                           value="{{ $locale }}">

                                    <div class="mb-3">
                                        <label for="baslik-{{ $locale }}" class="form-label">Başlık ({{ strtoupper($locale) }})</label>
                                        <input type="text"
                                               class="form-control"
                                               id="baslik-{{ $locale }}"
                                               name="translations[{{ $locale }}][baslik]"
                                               value="{{ old('translations.'.$locale.'.baslik', $hakkimizda->translation($locale)?->baslik) }}"
                                               placeholder="{{ $locale == 'tr' ? 'Türkçe başlık giriniz...' : 'Enter English title...' }}">
                                        <div class="invalid-feedback" id="error-baslik-{{ $locale }}"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="icerik-{{ $locale }}" class="form-label">İçerik ({{ strtoupper($locale) }})</label>
                                        <textarea class="form-control tinymce"
                                                  id="icerik-{{ $locale }}"
                                                  name="translations[{{ $locale }}][icerik]"
                                                  rows="10"
                                                  placeholder="{{ $locale == 'tr' ? 'Türkçe içerik giriniz...' : 'Enter English content...' }}">{{ old('translations.'.$locale.'.icerik', $hakkimizda->translation($locale)?->icerik) }}</textarea>
                                        <div class="invalid-feedback" id="error-icerik-{{ $locale }}"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta-aciklama-{{ $locale }}" class="form-label">Meta Açıklama ({{ strtoupper($locale) }})</label>
                                        <input type="text"
                                               class="form-control"
                                               id="meta-aciklama-{{ $locale }}"
                                               name="translations[{{ $locale }}][meta_aciklama]"
                                               value="{{ old('translations.'.$locale.'.meta_aciklama', $hakkimizda->translation($locale)?->meta_aciklama) }}"
                                               placeholder="{{ $locale == 'tr' ? 'Türkçe meta açıklama giriniz...' : 'Enter English meta description...' }}">
                                        <div class="invalid-feedback" id="error-meta-aciklama-{{ $locale }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-styles')
    <script src="{{ asset('adminassets/assets/plugins/tinymce/tinymce.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            // Form gönderme işlemi
            $('#hakkimizdaDuzenle').submit(function (e) {
                e.preventDefault();

                // TinyMCE içeriğini güncelleyin
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }

                // Formdan verileri al
                let formData = new FormData(this);

                // AJAX ile formu gönder
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı',
                                text: response.message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata',
                                text: response.message,
                            });
                        }
                    },
                    error: function (xhr) {
                        // Reset error messages
                        $('.invalid-feedback').html('');
                        $('.form-control').removeClass('is-invalid');

                        if (xhr.status === 422) {
                            // Validation hatalarını göster
                            var errors = xhr.responseJSON.errors;

                            $.each(errors, function (key, messages) {
                                // Hata mesajlarını ilgili alana ekle
                                var field = key.replace(/\./g, '-');
                                field = field.replace(/\[\d+\]/g, '');

                                // Multilingual fields like translations.tr.baslik
                                if (field.includes('translations-')) {
                                    var parts = field.split('-');
                                    if (parts.length === 3) {
                                        var locale = parts[1];
                                        var fieldName = parts[2];

                                        $('#' + fieldName + '-' + locale).addClass('is-invalid');
                                        $('#error-' + fieldName + '-' + locale).text(messages[0]);
                                    }
                                } else {
                                    $('#' + field).addClass('is-invalid');
                                    $('#error-' + field).text(messages[0]);
                                }
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Doğrulama Hatası',
                                text: 'Lütfen form bilgilerini kontrol ediniz.',
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata',
                                text: 'Bir hata oluştu.',
                            });
                        }
                    }
                });
            });

            // TinyMCE ayarları - tam olarak görseldeki gibi toolbar yapılandırması
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: '.tinymce',
                    height: 400,
                    plugins: 'preview searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
                    toolbar_groups: {
                        formatting: {
                            text: 'Formatting',
                            tooltip: 'Formatting',
                            items: 'bold italic underline | alignleft aligncenter alignright alignjustify'
                        },
                        editing: {
                            text: 'Editing',
                            tooltip: 'Editing',
                            items: 'undo redo'
                        },
                        lists: {
                            text: 'Lists',
                            tooltip: 'Lists',
                            items: 'bullist numlist | outdent indent'
                        },
                        media: {
                            text: 'Media',
                            tooltip: 'Media',
                            items: 'link image'
                        },
                        misc: {
                            text: 'Misc',
                            tooltip: 'Misc',
                            items: 'print preview forecolor backcolor help'
                        }
                    },
                    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image | code',


                    menubar: 'file edit view insert format tools table help',
                    branding: false,
                        statusbar: false,
                    content_css: [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'
                    ],
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                    extended_valid_elements: 'span[*]',
                    image_advtab: true,
                    remove_script_host: false,
                    convert_urls: false,
                    setup: function(editor) {
                        editor.on('init', function() {
                            // Set custom layout spacing to match the screenshot
                            $(editor.getContainer()).find('.tox-toolbar__group').css('margin-right', '8px');
                        });
                    }
                });
            }
        });
    </script>
@endpush
