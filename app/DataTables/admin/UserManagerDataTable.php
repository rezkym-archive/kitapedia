<?php

namespace App\DataTables\admin;

/* Admin Model */
use App\User;
use App\currencyIDR;
use App\admin\UserManager;

/* Yajra package */
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserManagerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        /**
         * Print settings datatable
         */
        return datatables()
            ->of($query)
            ->orderColumn('name', function ($query, $order) 
            {
                $query->orderBy('role', $order);

            })->editColumn('balance', function(UserManager $user) 
            {
                return 'Rp' .currencyIDR::beCalculated($user->balance);

            })->editColumn('status', function(UserManager $user) 
            {
                /**
                 * Make the status result have badge
                 */
                switch ($user->status) {

                    /* Active badge */
                    case 'active':
                        return '<span class="badge badge-success"> '.$user->status.' </span>';
                        break;

                    /* Nonactive badge */
                    case 'nonactive':
                        return '<span class="badge badge-danger"> '.$user->status.' </span>';
                        break;

                    /* Suspended badge */
                    case 'suspended':
                        return '<span class="badge badge-warning"> '.$user->status.' </span>';
                        break;

                    /* Deleted badge */
                    case 'deleted':
                        return '<span class="badge badge-dark"> '.$user->status.' </span>';
                        break;
                    
                    /* Default Badge */
                    default:
                    return '<span class="badge badge-light"> Unknown </span>';
                        break;
                }

            })
            ->addColumn('action', function($user)
            {
                /**
                 * Add action button in users table
                 */
                $actionButton = 
                '
                    <div class="dropdown d-inline rounded">
                        <button class="btn btn-primary btn-sm dropdown-toggle mb-1" type="button" id="'.$user->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                        </button>
                        <div class="dropdown-menu">

                            <!-- Info User -->
                            <a class="dropdown-item has-icon" id="'.$user->id.'" href="javascript:void(0);"><i class="fa fa-info"></i> Info </a>

                            <!-- Edit User -->
                            <a class="dropdown-item has-icon" href="javascript:void(0);"><i class="fa fa-user-edit"></i> Sunting </a>

                            <!-- Soft Delete -->
                            <a class="dropdown-item has-icon softDelete" id="'.$user->id.'" user-name="'.$user->name.'" href="javascript:void(0);"><i class="fa fa-trash-alt"></i> Hapus sementara </a>

                            <!-- Permanently Delete -->
                            <a class="dropdown-item has-icon delete" id="'.$user->id.'" user-name="'.$user->name.'" href="javascript:void(0);"><i class="fa fa-user-slash"></i> Hapus selamanya </a>
                        </div>
                    </div>
                ';

                /**
                 * Add to column
                 * 
                 * @return string
                 */
                return $actionButton;
            })
            /**
             * Raw the data HTML
             */
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\admin/UserManager $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserManager $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('User-Manager-Table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        "lengthMenu"    => [ 10, 20, 30 ],
                        'paging'        => true,
                        'searching'     => true,
                        'info'          => true,
                        'serverSide'    => true,
                        'processing'    => true,
                        'language' => 
                        [
                            /* Set Indonesian language datatables */
                            'url' => url('https://cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json')
                        ],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        /**
         * Add column to datatables
         */
        return 
        [
            /* Print name */
            Column::make('name')
            ->title('Nama'),

            /* Print username */
            Column::make('username')
            ->title('Username'),

            /* Print number phone */
            Column::make('nohp')
            ->title('No Hp'),

            /* Print email */
            Column::make('email')
            ->title('Email'),

            /* Print role */
            Column::make('role')
            ->title('Level'),

            /* Print Balance */
            Column::make('balance')
            ->title('Saldo'),

            /* Print status */
            Column::make('status')
            ->title('Status'),

            /* Print action */
            Column::computed('action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'admin/UserManager_' . date('YmdHis');
    }
}
