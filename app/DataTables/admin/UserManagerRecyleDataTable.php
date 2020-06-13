<?php

namespace App\DataTables\admin;

/* Admin Model */
use App\User;
use App\currencyIDR;
use App\admin\UserManager;
use Carbon\Carbon;

/* Yajra package */
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserManagerRecyleDataTable extends DataTable
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

            })->editColumn('deleted_at', function(UserManager $user) 
            {
                /**
                 * Set the date time in Indonesian format
                 */
                Carbon::setLocale('id');

                /**
                 * Change the time date format
                 */
                return Carbon::parse($user->deleted_at)->translatedFormat('l, d F Y H:i');

            })->addColumn('action', function($user)
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

                            <!-- Restore User -->
                            <a class="dropdown-item has-icon restore" id="'.$user->id.'" user-name="'.$user->name.'" href="javascript:void(0);"><i class="fa fa-undo"></i> Pulihkan akun </a>

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
        /**
         * Get users on delete_at is not null
         */
        $model = UserManager::onlyTrashed();
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
                    ->setTableId('User-Manager-recyle-Table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        "lengthMenu"    => [ 10, 20, 30 ],
                        'paging'        => true,
                        'searching'     => true,
                        'info'          => true,
                        'serverSide'    => true,
                        'processing'    => true,
                        'ajax'          => '',
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

            /* Print deleted_at */
            Column::make('deleted_at')
            ->title('Dihapus pada'),


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
