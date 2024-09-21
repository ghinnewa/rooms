<?php

namespace App\DataTables;

use App\Models\Subject;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class SubjectDataTable extends DataTable
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

        // Check if the user has the 'student' role
        if (!auth()->user()->hasRole('student')) {
            // Add the action column only if the user is not a student
            $dataTable->addColumn('action', 'subjects.datatables_actions');
        }

        return $dataTable->addColumn('prerequisite_subject.title', function($subject) {
            return $subject->prerequisiteSubject ? $subject->prerequisiteSubject->title : 'None';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Subject $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subject $model)
    {
        $user = auth()->user();

    // Check if the user has the 'student' role
    if ($user->hasRole('student')) {
        // Get the subjects associated with the student's profile
        return $model->newQuery()
            ->whereHas('users', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with('prerequisiteSubject');
    }

    // Default query for other roles
    return $model->newQuery()->with('prerequisiteSubject');

        // Default query for other roles
    
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
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    [
                       'extend' => 'create',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
                    ],
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
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'title' => new Column(['title' => __('models/subjects.fields.title'), 'data' => 'title']),
            'points' => new Column(['title' => __('models/subjects.fields.points'), 'data' => 'points']),
            'code' => new Column(['title' => __('models/subjects.fields.code'), 'data' => 'code']),
            'prerequisite_subject' => new Column(['title' => __('models/subjects.fields.prerequisite_subject_id'), 'data' => 'prerequisite_subject.title']),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'subjects_datatable_' . time();
    }
}
