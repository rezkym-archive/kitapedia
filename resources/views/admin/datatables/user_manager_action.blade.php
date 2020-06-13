                    {{-- 
                        This template use for UserManagerDatatable
                    --}}
                    
                    <div class="dropdown d-inline rounded">
                        <button class="btn btn-primary btn-sm dropdown-toggle mb-1" type="button" id="{{ $id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                        </button>
                        <div class="dropdown-menu">

                            <!-- Info User -->
                            <a class="dropdown-item has-icon info" id="{{ $id }}" href="javascript:void(0);"><i class="fa fa-info"></i> Info </a>

                            <!-- Edit User -->
                            <a class="dropdown-item has-icon" href="javascript:void(0);"><i class="fa fa-user-edit"></i> Sunting </a>

                            <!-- Soft Delete -->
                            <a class="dropdown-item has-icon softDelete" id="{{ $id }}" user-name="{{ $name }}" href="javascript:void(0);"><i class="fa fa-trash-alt"></i> Hapus sementara </a>

                            <!-- Permanently Delete -->
                            <a class="dropdown-item has-icon delete" id="{{ $id }}" user-name="{{ $name }}" href="javascript:void(0);"><i class="fa fa-user-slash"></i> Hapus selamanya </a>
                        </div>
                    </div>

                        {{-- Modal info uer --}}
                        
                        
                    