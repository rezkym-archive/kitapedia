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
        <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
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
                                            <div class="card-body"> {{ $totalSales }} </div>
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
                                            <div class="card-body"> 3.000 rb </div>
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
                                                <h4> Sosmed </h4> 
                                            </div>

                                            <div class="card-body"> 
                                                1.000 rb 
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
                                            <canvas id="salesChart" height="158"></canvas>
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
                                                
                                                @foreach ($transactionUser as $trx_ppob)

                                                    <li class="media"> <img class="mr-3 rounded" width="55" src="assets/img/products/product-3-50.png" alt="product">
                                                        <div class="media-body">
                                                            <div class="float-right">
                                                                <div class="font-weight-600 text-muted text-small"> 86 Sales </div>
                                                            </div>

                                                            <div class="media-title"> 
                                                                
                                                                {{ $trx_ppob->username }} 
                                                                - 
                                                                {{ $trx_ppob->type }}
                                                                - 
                                                                {{ $trx_ppob->status }}
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
    
                <script type="text/javascript">
                    "use strict";

                    var ctx = document.getElementById("salesChart").getContext('2d');
                    var salesChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August"],
                        datasets: [{
                        label: 'Sales',
                        data: [3200, 1800, 4305, 3022, 6310, 5120, 5880, 6154],
                        borderWidth: 2,
                        backgroundColor: 'rgba(63,82,227,.8)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 3.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                        },
                        {
                        label: 'Budget',
                        data: [2207, 3403, 2200, 5025, 2302, 4208, 3880, 4880],
                        borderWidth: 2,
                        backgroundColor: 'rgba(254,86,83,.7)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0 ,
                        pointRadius: 3.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                        }]
                    },
                    options: {
                        legend: {
                        display: false
                        },
                        scales: {
                        yAxes: [{
                            gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: '#f2f2f2',
                            },
                            ticks: {
                            beginAtZero: true,
                            stepSize: 1500,
                            callback: function(value, index, values) {
                                return '$' + value;
                            }
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                            display: false,
                            tickMarkLength: 15,
                            }
                        }]
                        },
                    }
                    });

                    var balance_chart = document.getElementById("balance-chart").getContext('2d');

                    var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
                    balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
                    balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

                    var salesChart = new Chart(balance_chart, {
                    type: 'line',
                    data: {
                        labels: ['16-07-2018', '17-07-2018', '18-07-2018', '19-07-2018', '20-07-2018', '21-07-2018', '22-07-2018', '23-07-2018', '24-07-2018', '25-07-2018', '26-07-2018', '27-07-2018', '28-07-2018', '29-07-2018', '30-07-2018', '31-07-2018'],
                        datasets: [{
                        label: 'Balance',
                        data: [50, 61, 80, 50, 72, 52, 60, 41, 30, 45, 70, 40, 93, 63, 50, 62],
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
                        labels: ['16-07-2018', '17-07-2018', '18-07-2018', '19-07-2018', '20-07-2018', '21-07-2018', '22-07-2018', '23-07-2018', '24-07-2018', '25-07-2018', '26-07-2018', '27-07-2018', '28-07-2018', '29-07-2018', '30-07-2018', '31-07-2018'],
                        datasets: [{
                        label: 'Sales',
                        data: [70, 62, 44, 40, 21, 63, 82, 52, 50, 31, 70, 50, 91, 63, 51, 60],
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
