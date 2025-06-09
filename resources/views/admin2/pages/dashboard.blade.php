@extends('admin2.layout.main')

@section('title', 'Dashboard -')

@section('content')
    <div class="container-fluid">
        <div class="page-titles mb-5">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-12 align-self-center">
                    <h4 class="text-muted mb-0 fw-normal fs-5">
                        Welcome, {{ Auth::user()->name }}
                    </h4>
                    <h2 class="mb-0 fw-bolder fs-8">Analytical Dashboard</h2>
                </div>

            </div>
        </div>

        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-6">
                <div class="card welcome-card overflow-hidden bg-primary-subtle border-0">
                    <div class="card-body">
                        <h4 class="position-relative fs-6">
                            Hey {{ Auth::user()->name }}, Welcome back!
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- earnings card -->
                        <div class="card text-bg-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 text-white card-title">Jumlah Sentimen</h4>

                                </div>
                                <div class="mt-3">
                                    <h2 class="fs-8 text-white mb-0">{{ $total }}</h2>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- earnings card -->
                        <div class="card text-bg-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 text-white card-title">Positive</h4>

                                </div>
                                <div class="mt-3">
                                    <h2 class="fs-8 text-white mb-0">{{ $positive }}</h2>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- earnings card -->
                        <div class="card text-bg-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 text-white card-title">Negative</h4>

                                </div>
                                <div class="mt-3">
                                    <h2 class="fs-8 text-white mb-0">{{ $negative }}</h2>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- earnings card -->
                        <div class="card text-bg-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 text-white card-title">Neutral</h4>

                                </div>
                                <div class="mt-3">
                                    <h2 class="fs-8 text-white mb-0">{{ $neutral }}</h2>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Hasil Chart Analisis Sentimen</h4>
                            </div>
                        </div>
                        <div id="result-chart"></div>
                        <p id="no-data-message" style="display:none; color:red;">Tidak ada data untuk ditampilkan.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Wordcloud - Positive</h4>
                        <div id="w-positif" style="height:300px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Wordcloud - Negative</h4>
                        <div id="w-negatif" style="height:300px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Wordcloud - Neutral</h4>
                        <div id="w-neutral" style="height:300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
    </div>

@endsection

@push('script')
    <script>
        // PIE CHART SENTIMEN
        var chartOptions = {
            series: [{{ $positive }}, {{ $negative }}, {{ $neutral }}],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Positive', 'Negative', 'Neutral'],
            colors: ['#28a745', '#dc3545', '#6c757d'],
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: true,
                formatter: function(val, opts) {
                    return opts.w.globals.series[opts.seriesIndex] + ' (' + val.toFixed(1) + '%)';
                }
            }
        };

        var pieChart = new ApexCharts(document.querySelector("#result-chart"), chartOptions);
        pieChart.render();

        // WORDCLOUD
        function buildWordArray(wordFreq) {
            // wordFreq: { word: count }
            let arr = [];
            Object.entries(wordFreq).slice(0, 50).forEach(([word, count]) => {
                arr.push([word, count]);
            });
            return arr;
        }

        var wcPos = @json($wordcloud_positive);
        var wcNeg = @json($wordcloud_negative);
        var wcNeu = @json($wordcloud_neutral);

        if (Object.keys(wcPos).length > 0) {
            WordCloud(document.getElementById('w-positif'), {
                list: buildWordArray(wcPos),
                gridSize: 10,
                weightFactor: 8,
                color: '#28a745',
                backgroundColor: 'white'
            });
        }
        if (Object.keys(wcNeg).length > 0) {
            WordCloud(document.getElementById('w-negatif'), {
                list: buildWordArray(wcNeg),
                gridSize: 10,
                weightFactor: 8,
                color: '#dc3545',
                backgroundColor: 'white'
            });
        }
        if (Object.keys(wcNeu).length > 0) {
            WordCloud(document.getElementById('w-neutral'), {
                list: buildWordArray(wcNeu),
                gridSize: 10,
                weightFactor: 8,
                color: '#6c757d',
                backgroundColor: 'white'
            });
        }
    </script>
@endpush
