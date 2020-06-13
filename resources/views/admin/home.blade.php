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

                                <!-- All sales -->
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="card card-statistic-2">
                                        <div class="card-stats">
                                            <div class="card-stats-title"> 
                                                Semua Penjualan
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

                                <!-- Sosmed sales -->
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="card card-statistic-2">
                                        <div class="card-stats">
                                            <div class="card-stats-title"> 
                                                Penjualan Sosmed
                                            </div>
        
                                            <div class="card-stats-items">

                                                @foreach ($trxStatus[1] as $item)

                                                    <div class="card-stats-item">
                                                        <div class="card-stats-item-count"> {{ isset($item->count) ? $item->count : 0 }} </div>
                                                        <div class="card-stats-item-label"> {{ isset($item->status) ? $item->status : 'unknown' }} </div>
                                                    </div>

                                                @endforeach
                                                
                                            </div>

                                        </div>
                                        <div class="card-icon shadow-primary bg-primary"> <i class="fas fa-archive"></i> </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4> Pendapatan </h4> </div>
                                            <div class="card-body"> {{ $totalSales['sosmedSales'] }} </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- PPOB Sales -->
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="card card-statistic-2">
                                        <div class="card-stats">
                                            <div class="card-stats-title"> 
                                                Penjualan PPOB
                                            </div>

                                            <div class="card-stats-items">
                                                
                                                @foreach ($trxStatus[2] as $item)

                                                    <div class="card-stats-item">
                                                        <div class="card-stats-item-count"> {{ isset($item->count) ? $item->count : 0 }} </div>
                                                        <div class="card-stats-item-label"> {{ isset($item->status) ? $item->status : 'unknown' }} </div>
                                                    </div>

                                                @endforeach
                                                
                                            </div>

                                        </div>
                                        <div class="card-icon shadow-primary bg-primary"> <i class="fas fa-archive"></i> </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4> Pendapatan </h4> </div>
                                            <div class="card-body"> {{ $totalSales['ppobSales'] }} </div>
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

@endpush
