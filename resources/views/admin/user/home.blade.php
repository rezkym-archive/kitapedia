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

    <script src="{{ asset('assets/js/admin/UserManager.js') }}"></script>
    
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
                <h2 class="section-title"> Kelola Pengguna </h2>

                <p class="section-lead">
                    Mengelola data pengguna
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

                                    <a  class="dropdown-item has-icon" name="create_record" id="create_record" href="javascript:void(0);">
                                        <i class="fa fa-user-plus"></i> Tambah Pengguna 
                                    </a>
                                    
                                    <a class="dropdown-item has-icon" href="javascript:void(0);">
                                        <i class="fa fa-backspace"></i> Bersihkan Pengguna 
                                    </a>

                                    <a class="dropdown-item has-icon" href="javascript:void(0);">
                                        <i class="fa fa-redo"></i> Reset Log Pengguna 
                                    </a>

                                    <a class="dropdown-item has-icon" href="{{ route('admin.user.recyle') }}">
                                        <i class="fa fa-recycle"></i> Recycle 
                                    </a>

                                </div>
                            </div>

                        </div>

                            <div class="card-body">
                                <h2 class="text-center"> 412 </h2>
                                <div class="mt-2 text-center font-weight"> <span class="badge badge-info"> Total Pengguna </span> </div>
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

    {{-- Modal input user --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="user-input-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"> Tambah Pengguna </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>

                <div class="modal-body">

                    {{-- Form result user input --}}
                    <span id="form_result"></span>
                    <form method="post" id="add_form" class="form-horizontal">

                        <!-- CSRF Section -->
                        @csrf

                        <div class="section-title mt-0 font-weight-bold"> Dasar </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name"> Nama </label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama"> 
                            </div>

                            <div class="form-group col-md-6">
                                <label for="username"> Nama Pengguna </label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username / Nama pengguna"> 
                            </div>
                        </div>

                        <div class="section-title mt-0 font-weight-bold"> Akun </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email"> Email </label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email"> 
                            </div>

                            <div class="form-group col-md-6">
                                <label for="nohp"> No Hp </label>
                                <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Nomor telefon"> 
                            </div>
                        </div>

                        <div class="section-title mt-0 font-weight-bold"> Kata sandi </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password"> Kata sandi </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Kata sandi"> 
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password_confirmation"> Konfirmasi kata sandi </label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi kata sandi"> 
                            </div>
                        </div>

                        <div class="section-title mt-0 font-weight-bold"> Pengaturan akun </div>
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="level"> Tipe Akun </label>
                                <select id="level" name="level" class="form-control">
                                    <option value="client" selected> Client </option>
                                    <option value="admin"> Admin </option>
                                    <option value="reseller"> Reseller </option>
                                    <option value="client"> Client </option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="status"> Status </label>
                                <select id="status" name="status" class="form-control">
                                    <option value="active" selected> aktif </option>
                                    <option value="active"> aktif </option>
                                    <option value="nonactive"> nonaktif </option>
                                    <option value="suspended"> dibekukan </option>
                                    <option value="deleted"> dihapus </option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="balance"> Saldo </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type="text" class="form-control currency" id="balance" name="balance" placeholder="Saldo"> 
                                </div>
                            </div>
                            
                        </div>

                </div>
                
                        <div class="modal-footer bg-whitesmoke br">

                            
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal </button>
                            <button type="submit" name="action_button" id="action_button" class="btn btn-primary"> Selanjutnya </button> 

                        </div>
                    </form>
            </div>
        </div>
    </div>

    {{-- Modal user delete --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="confirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"> Hapus pengguna </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>

                <div class="modal-body">

                    <p class="mt-0" id="delete-message">  </p> 

                </div>

                <div class="modal-footer bg-whitesmoke br">

                    <button type="button" class="btn btn-danger" name="ok_button" id="ok_button"> Ya </button>
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