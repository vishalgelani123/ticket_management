<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Column;

class UserDataTable extends BaseDataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function ($query) {
                return $query->name;
            })
            ->addColumn('roles', function ($query) {
                $roles = "<ul>";
                if (count($query->roles) > 0) {
                    foreach ($query->roles as $role) {
                        $roles .= "<li>" . $role->name . "</li>";
                    }
                }
                return $roles . "</ul>";
            })
            ->addColumn('action', function ($query) {
                return $query->action_buttons;
            })
            ->rawColumns(['permissions', 'roles', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->role('user');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
//            'id' => ['searchable' => false],
            Column::make('id')->title('ID'),
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('roles')->title('Roles'),
            Column::computed('action', 'Action')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false),
        ];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->addTableClass($this->tableClass)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->dom($this->domHtml)
            ->parameters([
                'buttons' => $this->buttons(),
                'oLanguage' => [
                    'oPaginate' => [
                        'sPrevious' => '<i class="fa-solid fa-arrow-left"></i>',
                        'sNext' => '<i class="fa-solid fa-arrow-right"></i>',
                    ],
                    'sInfo' => $this->sInfo,
                    'sSearch' => '',
                    'sSearchPlaceholder' => 'Search...',
                    'sLengthMenu' => 'Results :  _MENU_',
                ],
                'columnDefs' => [
                    'targets' => [6], // column index (start from 0)
                    'orderable' => false, // set orderable false for selected columns
                ],
                'stripeClasses' => [],
                'lengthMenu' => $this->lengthMenu,
                'pageLength' => $this->pageLength,
                'processing' => true,
                'autoWidth' => true,
                'serverSide' => true,
                'responsive' => true,
                'searchable' => true,
                'fnDrawCallback' => 'function() {
                    $("[data-bs-toggle=\'tooltip\']").tooltip();
                }',
            ]);
    }

    /**
     * Get filename for export.
     *
     * @return string
     */


    protected function buttons()
    {
        return [
            'buttons' => [
                [
                    'extend' => 'copy',
                    'className' => 'btn btn-info'
                ],
                [
                    'extend' => 'csv',
                    'className' => 'btn btn-info',
                    'exportOptions' => [
                        'columns' => [0, 1, 2]
                    ]
                ],
                [
                    'extend' => 'excel',
                    'className' => 'btn btn-info',
                    'exportOptions' => [
                        'columns' => [0, 1, 2]
                    ]
                ],
                [
                    'extend' => 'print',
                    'className' => 'btn btn-info',
                    'exportOptions' => [
                        'columns' => [0, 1, 2]
                    ]
                ],
                [
                    'extend' => 'pdf',
                    'className' => 'btn btn-info',
                    'exportOptions' => [
                        'columns' => [0, 1, 2]
                    ]
                ],
            ]
        ];
    }

    /**
     * Export to excel file.
     *
     * @return mixed
     */
    public function excel()
    {
        // TODO: Implement excel() method.
    }

    /**
     * Export to CSV file.
     *
     * @return mixed
     */
    public function csv()
    {
        // TODO: Implement csv() method.
    }

    /**
     * Export to PDF file.
     *
     * @return mixed
     */
    public function pdf()
    {
        // TODO: Implement pdf() method.
    }
}
