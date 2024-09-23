<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('role', function (User $user) {
            return $user->roles->pluck('name')->implode(', '); // Show all roles joined by commas
        })->addColumn('action', 'users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        // Start a new query with the 'roles' relationship loaded
        $query = $model->newQuery()->with('roles');
    
        // If the logged-in user is an admin, restrict them to viewing only students
        if (auth()->user()->hasRole('admin')) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', 'student'); // Only show users with the student role
            });
        }
    
        // Return the (possibly filtered) query
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'responsive' => true, // Enable responsive behavior
                'autoWidth' => false, // Disable automatic width for better mobile adaptation
                'columnDefs' => [
                    ['width' => '30%', 'targets' => 0], // You can adjust column widths here
                    ['width' => '30%', 'targets' => 1]
                ],
                'buttons'   => [
                    [
                        'extend' => 'export',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                     ],
                     [
                        'extend' => 'print',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-print"></i> ' .__('auth.app.print').''
                     ],
                     [
                        'extend' => 'reset',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-undo"></i> ' .__('auth.app.reset').''
                     ],
                     [
                        'extend' => 'reload',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-refresh"></i> ' .__('auth.app.reload').''
                     ],
                ],
                'language' => [
                    'url' => asset('lang/datatables_ar.json'), // Local path to your JSON file
                ],
            ]
        );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => ['title' => __('models/users.fields.name')],
            'email' => ['title' => __('models/users.fields.email')],
            'role' => ['title' => __('models/users.fields.role')],
        ];
    }
    

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'users_datatable_' . time();
    }
}
