@extends('admin2.layout.main')

@section('title', 'Prediction - ')

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
                            <li class="breadcrumb-item" aria-current="page">Prediction</li>
                        </ol>
                    </nav>
                    <h2 class="mb-0 fw-bolder fs-8">Prediction</h2>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Prediction Data</h4>
                        <div class="form-group mb-3">
                            <label for="sentiment" class="form-label">Sentiment</label>
                            <input type="text" class="form-control" name="sentiment" id="sentiment"
                                placeholder="Sentiment">
                            <button class="btn btn-primary mt-2" id="predictButton">Predict</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Prediction Results</h4>
                        <div class="table-responsive">
                            <table id="predictionTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sentiment</th>
                                        <th>Label</th>
                                        <th>Confidence</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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

    <script>
        let predictionIndex = 1; // untuk nomor urut

        $('#predictButton').on('click', function() {
            const statement = $('#sentiment').val().trim();
            if (!statement) {
                alert('Silakan masukkan kalimat untuk prediksi!');
                return;
            }
            $.ajax({
                url: '{{ route('predict.post') }}',
                method: 'POST',
                data: {
                    statement: statement,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    // Tambahkan hasil ke tabel
                    $('#predictionTable tbody').prepend(
                        `<tr>
                    <td>${predictionIndex++}</td>
                    <td>${res.sentiment}</td>
                    <td>${res.label}</td>
                    <td>${res.confidence}</td>
                </tr>`
                    );
                    $('#sentiment').val('');
                    Swal.fire({
                        icon: 'success',
                        title: 'Prediksi berhasil!',
                        text: `Label: ${res.label}, Confidence: ${res.confidence}`,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                },
                error: function(xhr) {
                    let msg = 'Terjadi error!';
                    if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors
                        .statement) {
                        msg = xhr.responseJSON.errors.statement[0];
                    }
                    alert(msg);
                }
            });
        });
    </script>
@endpush
