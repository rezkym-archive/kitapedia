@extends('layouts.app')

{{-- Title Head --}}
@section('title_head', 'Kelola Pengguna')

{{-- Css Lib --}}
@push('css_lib')
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

@endpush

{{-- Js Lib --}}
@push('js_lib')

    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1/dist/cleave.min.js"></script>

@endpush

{{-- Js Specific --}}
@push('js_specific')

    <script src="{{ asset('assets/js/admin/UserManagerRecyle.js') }}"></script>
    
@endpush

{{-- Content --}}
@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1> Pengguna </h1>
                
            </div>

            <div class="section-body">
                <h2 class="section-title"> Kelola Pengguna dihapus </h2>

                <p class="section-lead">
                    Mengelola pengguna yang dihapus sementara
                </p>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2">

                    <div class="card card-success">
                        <div class="card-header">
                            <h4> Total Pengguna </h4>

                            <button type="button" id="reload-table" class="card-header-action btn btn-info btn-icon icon-left">
                                <i class="fas fa-redo"></i>
                            </button>

                            <div class="card-header-action dropdown d-inline mr-3 ml-3">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pengaturan
                                </button>

                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">

                                    <a class="dropdown-item has-icon delete_recyle" href="javascript:void(0);">
                                        <i class="fa fa-backspace"></i> Bersihkan Pengguna 
                                    </a>

                                </div>
                            </div>

                        </div>

                            <div class="card-body">
                                <h2 class="text-center"> {{ $totalUser }} </h2>
                                <div class="mt-2 text-center font-weight"> <span class="badge badge-info" data-toggle="tooltip" title="Perhitungan recyle tidak termasuk" > Total Pengguna </span> </div>
                            </div>
                            
                        </div>
                    </div>
                </div> {{-- End row:1 --}}

                <div class="row">
                    <div class="col-md-8 offset-lg-2">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4> Tabel Pengguna</h4> </div>
                            <div class="card-body">

                                {{-- Datatables HTML --}}
                                <div class="table-responsive">
                                    {!! $dataTable->table(['class' => 'table table-striped', true]) !!}
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div> {{-- End Row:2 --}}

        </section>
    </div>

@endsection

{{-- Modal Section --}}
@section('modal')

    {{-- Modal action --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="action-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>

                <div class="modal-body">

                    <p class="mt-0" id="action-message">  </p> 

                </div>

                <div class="modal-footer bg-whitesmoke br">

                    <button type="button" class="btn btn-danger" id="confirm"> Ya </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batalkan </button>
                    
                </div>

            </div>
        </div>
    </div>

@endsection

{{-- Javascript in HTML code --}}
@push('js_html')

    {{-- Dtatables script --}}
    {!! $dataTable->scripts() !!}


    {{-- General Script --}}
    <script type="text/javascript">

        
    </script>

@endpush