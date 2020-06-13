                    {{-- Status user --}}
                    @switch($status)
                    
                        {{-- Active badge --}}
                        @case('active')
                            <span class="badge badge-success"> Aktif </span>
                            @break

                        {{-- Nonactive badge --}}
                        @case('nonactive')
                            <span class="badge badge-danger"> Nonaktif </span>
                            @break
                            
                        {{-- Suspended badge --}}
                        @case('suspended')
                           <span class="badge badge-warning"> Dibekukan </span>
                            @break
    
                        {{-- Deleted badge --}}
                        @case('deleted')
                           <span class="badge badge-dark"> Dihapus </span>
                            @break
                        
                        {{-- Default Badge --}}
                        @default
                            <span class="badge badge-light"> Unknown </span>
                            @break
                            
                    @endswitch
