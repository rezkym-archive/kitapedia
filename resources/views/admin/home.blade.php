@extends('layouts.app')

{{-- Title Head --}}
@section('title_head', 'Beranda')

{{-- Css Lib --}}
@push('css_lib')

        <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

@endpush

{{-- Js Lib --}}
@push('js_lib')

        <script src="{{ asset('assets/modules/jquery.sparkline.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.min.js"></script>
        <script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
        <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

@endpush

{{-- Js Specific --}}
@push('js_specific')

@endpush

{{-- Content Section --}}
@section('content')

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-header">
                            <h1> Beranda </h1>

                            <div class="section-header-breadcrumb">
                                <div class="breadcrumb-item active"><a href="{{ route($user->role.'.index') }}"> Beranda </a></div>
                              </div>
                        </div>
                        
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="card card-statistic-2">
                                        <div class="card-stats">
                                            <div class="card-stats-title"> 
                                                Penjualan 
                                            </div>
                                            <div class="card-stats-items">
                                                
                                                @foreach ($trxStatus[0] as $status => $val)

                                                    <div class="card-stats-item">
                                                        <div class="card-stats-item-count"> {{ isset($val) ? $val : 0 }} </div>
                                                        <div class="card-stats-item-label"> {{ isset($status) ? $status : 'unknown' }} </div>
                                                    </div>

                                                @endforeach
                                                
                                            </div>
                                        </div>
                                        <div class="card-icon shadow-primary bg-primary"> <i class="fas fa-archive"></i> </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4> Pendapatan </h4> </div>
                                            <div class="card-body"> {{ $totalSales['allSales'] }} </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="card card-statistic-2">
                                        <div class="card-chart">
                                            <canvas id="balance-chart" height="80"></canvas>
                                        </div>
                                        <div class="card-icon shadow-primary bg-primary"> <i class="fas fa-shopping-bag"></i> </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4> Sosmed </h4> </div>
                                            <div class="card-body"> {{ $totalSales['sosmedSales'] }} </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="card card-statistic-2">
                                        <div class="card-chart">
                                            <canvas id="sales-chart" height="80"></canvas>
                                        </div>
                                        <div class="card-icon shadow-primary bg-primary"> <i class="fas fa-shopping-bag"></i> </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4> PPOB </h4> 
                                            </div>

                                            <div class="card-body"> 
                                                {{ $totalSales['ppobSales'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4> Grafik Pembelian Sosmed & Lainnya</h4> 
                                        </div>

                                        <div class="card-body">

                                            {!! $transactionChart->container() !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card gradient-bottom">
                                        <div class="card-header">
                                            <h4> Riwayat Pembelian </h4>
                                            <div class="card-header-action dropdown"> 
                                                <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-danger dropdown-toggle"> 
                                                    Hari ini
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <li class="dropdown-title"> 
                                                        Pilih periode
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item"> 
                                                            Hari ini
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body" id="top-5-scroll">
                                            <ul class="list-unstyled list-unstyled-border">
                                                
                                                @foreach ($transactionUser as $trx)

                                                    <li class="media"> <img class="mr-3 rounded" width="55" src="assets/img/products/product-3-50.png" alt="product">
                                                        <div class="media-body">
                                                            <div class="float-right">
                                                                <div class="font-weight-600 text-muted text-small"> {{ date('d/m/y', strtotime($trx->created_at)) }} </div>
                                                            </div>

                                                            <div class="media-title"> 
                                                                
                                                                {{ $trx->username }} 
                                                                - 
                                                                {{ $trx->type }}
                                                                - 
                                                                {{ $trx->status }}
                                                            </div>
                                                            
                                                        </div>
                                                    </li>

                                                @endforeach                             
                                                
                                            </ul>
                                        </div>
                                        <div class="card-footer pt-3 d-flex justify-content-center">
                                            <div class="budget-price justify-content-center">
                                                <div class="budget-price-square bg-primary" data-width="20"></div>
                                                <div class="budget-price-label">Selling Price</div>
                                            </div>
                                            <div class="budget-price justify-content-center">
                                                <div class="budget-price-square bg-danger" data-width="20"></div>
                                                <div class="budget-price-label">Budget Price</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="section-body">
                        </div>
                    </section>
                </div>              

@endsection

{{-- Javascript in HTML Code --}}
@push('js_html')

                <!-- Chart script -->
                {!! $transactionChart->script() !!}
    
                <script type="text/javascript">
                    "use strict";

                        /* var ctx = document.getElementById("salesChart").getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'],
                                datasets: [{
                                    label: 'PPOB',
                                    fill: true,
                                    backgroundColor: 'rgb(30, 227, 207, 0.1)',
                                    borderColor: 'rgb(30, 227, 207)',
                                    pointRadius: 3.5,
                                    pointBackgroundColor: 'transparent',
                                    pointHoverBackgroundColor: 'rgba(30, 227, 207, .8)',
                                    data: [
                                        24,
                                        31,
                                        15,
                                        18,
                                        20,
                                        10,
                                        40
                                    ]
                                }, 
                                {
                                    label: 'SOSMED',
                                    fill: true,
                                    backgroundColor: 'rgb(255, 99, 132, 0.1)',
                                    borderColor: 'rgb(255, 99, 132)',
                                    pointRadius: 3.5,
                                    pointBackgroundColor: 'transparent',
                                    pointHoverBackgroundColor: 'rgba(255, 99, 132, .8)',
                                    data: [
                                        10,
                                        14,
                                        18,
                                        17,
                                        21,
                                        24,
                                        13
                                    ],
                                }],
                            },
                            options: {
                                legend: {
                                    display: true
                                },
                                scales: {
                                    yAxes: [{
                                        stacked: false,
                                        gridLines: 
                                        {
                                            display: true,
                                            drawBorder: true,
                                            color: '#f2f2f2',
                                        },
                                        ticks: {
                                            beginAtZero: true,
                                        }
                                    }],
                                    xAxes: [{
                                        gridLines: {
                                            display: true,
                                            tickMarkLength: 15,
                                        }
                                    }]
                            },
                        }
                    }); */


                    var balance_chart = document.getElementById("balance-chart").getContext('2d');

                    var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
                    balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
                    balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

                    var salesChart = new Chart(balance_chart, {
                    type: 'line',
                    data: {
                        labels: ['16-07', '17-07', '18-07', '19-07', '20-07', '21-07', '22-07', '23-07', '24-07', '25-07', '26-07', '27-07', '28-07', '29-07', '30-07', '31-07'],
                        datasets: [{
                        label: 'Balance',
                        data: [3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
                        backgroundColor: balance_chart_bg_color,
                        borderWidth: 3,
                        borderColor: 'rgba(63,82,227,1)',
                        pointBorderWidth: 0,
                        pointBorderColor: 'transparent',
                        pointRadius: 3,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                        }]
                    },
                    options: {
                        layout: {
                        padding: {
                            bottom: -1,
                            left: -1
                        }
                        },
                        legend: {
                        display: false
                        },
                        scales: {
                        yAxes: [{
                            gridLines: {
                            display: false,
                            drawBorder: false,
                            },
                            ticks: {
                            beginAtZero: true,
                            display: false
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                            drawBorder: false,
                            display: false,
                            },
                            ticks: {
                            display: false
                            }
                        }]
                        },
                    }
                    });

                    var sales_chart = document.getElementById("sales-chart").getContext('2d');

                    var sales_chart_bg_color = sales_chart.createLinearGradient(0, 0, 0, 80);
                    balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
                    balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

                    var salesChart = new Chart(sales_chart, {
                    type: 'line',
                    data: {
                        labels: ['16-07', '17-07', '18-07', '19-07', '20-07', '21-07', '22-07', '23-07', '24-07', '25-07', '26-07', '27-07', '28-07', '29-07', '30-07', '31-07'],
                        datasets: [{
                        label: 'Sales',
                        data: [3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
                        borderWidth: 2,
                        backgroundColor: balance_chart_bg_color,
                        borderWidth: 3,
                        borderColor: 'rgba(63,82,227,1)',
                        pointBorderWidth: 0,
                        pointBorderColor: 'transparent',
                        pointRadius: 3,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                        }]
                    },
                    options: {
                        layout: {
                        padding: {
                            bottom: -1,
                            left: -1
                        }
                        },
                        legend: {
                        display: false
                        },
                        scales: {
                        yAxes: [{
                            gridLines: {
                            display: false,
                            drawBorder: false,
                            },
                            ticks: {
                            beginAtZero: true,
                            display: false
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                            drawBorder: false,
                            display: false,
                            },
                            ticks: {
                            display: false
                            }
                        }]
                        },
                    }
                    });

                    $("#products-carousel").owlCarousel({
                    items: 3,
                    margin: 10,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    loop: true,
                    responsive: {
                        0: {
                        items: 2
                        },
                        768: {
                        items: 2
                        },
                        1200: {
                        items: 3
                        }
                    }
                    });

                </script>
@endpush
