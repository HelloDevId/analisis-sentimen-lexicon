@extends('admin2.layout.main')

@section('title', 'Sentimen - ')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin2/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin2/buttons/2.4.2/css/buttons.dataTables.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-titles mb-7 mb-md-5">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-12 align-self-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb align-items-center">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="/dashboard">
                                    <i class="ti ti-home fs-5"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Sentimen</li>
                        </ol>
                    </nav>
                    <h2 class="mb-0 fw-bolder fs-8">Sentimen</h2>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-center justify-content-end mt-3 mt-md-0">
                    <a data-bs-toggle="modal" data-bs-target="#importModal"
                        class="btn btn-success d-flex align-items-center ms-2">
                        <i class="ti ti-plus me-1"></i>
                        Import Excel
                    </a>

                    <a data-bs-toggle="modal" data-bs-target="#deleteModal"
                        class="btn btn-danger d-flex align-items-center ms-2">
                        <i class="ti ti-plus me-1"></i>
                        Delete All
                    </a>
                </div>
            </div>
        </div>
        <div class="datatables">
            <div class="card">
                <div class="card-body">
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>


                            <?php

                            $nomer = 1;

                            ?>

                            @foreach ($errors->all() as $error)
                                <li>{{ $nomer++ }}. {{ $error }}</li>
                            @endforeach
                        </div>
                    @endif --}}
                    @if (session('import_msg'))
                        <div class="alert alert-info mt-2">
                            {!! session('import_msg') !!}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="file_export" class="table table-striped table-bordered display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Original Comment</th>
                                    <th>Cleaned Comment</th>
                                    <th>Sentiment Score</th>
                                    <th>Sentiment Label</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->original_comment }}</td>
                                        <td>{{ $data->cleaned_comment }}</td>
                                        <td>{{ $data->sentiment_score }}</td>
                                        <td>{{ $data->sentiment_label }}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Import Excel --}}
                    <!-- Modal -->
                    <div class="modal fade" id="importModal" tabindex="-1" role="dialog"
                        aria-labelledby="defaultModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="defaultModalLabel">Import Excel Modal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/sentiment/import" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="recipient-name" class="col-form-label">File</label>
                                            <input name="csv" class="form-control" type="file" id="formFile"
                                                required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn mb-2 btn-danger"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn mb-2 btn-success" id="btnImportSubmit">
                                            <span class="spinner-border spinner-border-sm d-none" role="status"
                                                aria-hidden="true" id="importSpinner"></span>
                                            <span class="btn-text">Save</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- End --}}


                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                        aria-labelledby="defaultModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="defaultModalLabel">Delete Modal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Yakin Ingin Menghapus Semua Data Sentimen?
                                </div>
                                <form action="/sentiment/delete" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-footer">
                                        <button type="button" class="btn mb-2 btn-success"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn mb-2 btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('admin2/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin2/buttons/2.4.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin2/ajax/libs/jszip/3.10.1/jszip.min.js') }}"></script>
    <script src="{{ asset('admin2/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin2/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin2/buttons/2.4.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin2/buttons/2.4.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin2/assets/js/datatable/datatable-advanced.init.js') }}"></script>

    {{-- <script>
        $('#importModal form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            // Disable tombol dan tampilkan loader
            let btn = $('#btnImportSubmit');
            btn.attr('disabled', true);
            btn.find('.btn-text').text('Uploading...');
            btn.find('.spinner-border').removeClass('d-none');

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('#importModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data has been added',
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(() => {
                        // Enable tombol dan hide loader
                        btn.attr('disabled', false);
                        btn.find('.btn-text').text('Save');
                        btn.find('.spinner-border').addClass('d-none');
                        // Reload halaman supaya data baru tampil di tabel
                        location.reload();
                    });
                },
                error: function(xhr) {
                    let msg = 'Error importing file!';
                    if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.csv) {
                        msg = xhr.responseJSON.errors.csv[0];
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Import gagal',
                        text: msg,
                    });
                    // Enable tombol dan hide loader
                    btn.attr('disabled', false);
                    btn.find('.btn-text').text('Save');
                    btn.find('.spinner-border').addClass('d-none');
                }
            });
        });
    </script> --}}
@endpush
