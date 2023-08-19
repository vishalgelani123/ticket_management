<?php

namespace App\DataTables;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Column;

class RoleDataTable extends BaseDataTable
{
    /*
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function ($query) {
                return $query->name;
            })//
            ->addColumn('action', function ($query) {
                return ' &nbsp;&nbsp;&nbsp;<a href ="' . route('roles.edit', $query->id) . '" title="Edit Role"   class="btn" style="background: #6b757d;color:white"><i class="ri-edit-line"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button type="button" onclick="deleteRole(' . $query->id . ')" title="Delete Role" class="btn" style="background: red ; color:white" ><i class="ri-delete-bin-6-line"></i></button>';
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Spatie\Permission\Models\Role; $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)

    {
//       role::onlyTrashed($model);
        return $model->newQuery();
        // ->role('user');

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
            Column::make('name')->title('Roles'),
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
            ->setTableId('role-table')
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
                    'targets' => [5], // column index (start from 0)
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
