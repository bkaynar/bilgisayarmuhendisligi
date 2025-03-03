@extends('adminlayout.master')
@section('title', 'Hedefler')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hedefler</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Hedefler</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Türkçe Başlık</th>
                                <th>İngilizce Başlık</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hedeflerimiz as $hedef)
                                <tr>
                                    <td>{{ $hedef->id }}</td>
                                    <td>{{ $hedef->getTranslation('tr')->hedef_baslik }}</td>
                                    <td>{{ $hedef->getTranslation('en')->hedef_baslik }}</td>
                                    <td>
                                        <a href="{{ route('hedefler.edit', $hedef->id) }}" class="btn btn-primary">Düzenle</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger sil">Sil</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        $('.sil').click(function () {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu işlemi geri alamayacaksınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sil',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).closest('tr').find('td:first').text();
                    let tr = $(this).closest('tr');
                    $.ajax({
                        type: "DELETE",
                        url: "/admin/hedefler/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function (response) {
                            tr.remove();
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                    Swal.fire(
                        'Silindi!',
                        'Hedef başarıyla silindi.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush
