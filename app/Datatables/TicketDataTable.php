<?php

namespace App\DataTables;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;

class TicketDataTable extends BaseDataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function ($query) {
                return $query->name;
            })
            ->addColumn('userName', function ($query) {
                if ($query->user) {
                    $userName = $query->user->name;
                } else {
                    $userName = 'N/A'; // Replace with the desired text for cases where the user is not found
                }

                return $userName;
            })
            ->addColumn('categoryName', function ($query) {
                if ($query->category) {
                    $categoryName = $query->category->name;
                } else {
                    $categoryName = 'N/A'; // Replace with the desired text for cases where the user is not found
                }

                return $categoryName;
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 'open') {
                    return '<button class="btn btn-sm btn-light-success toggle-status" data-user_id="' . $query->id . '" data-status="open" data-toggle="modal" data-target="#statusChangeModal">Open</button>';
                } else {
                    return '<button class="btn btn-sm btn-light-warning">Closed</button>';
                }
            })
            ->addColumn('view', function ($query) {
                return '<button class="btn btn-sm btn-primary view-details" data-user_id="' . $query->id . '" data-toggle="modal" data-target="#ticketDetailsModal">View</button>';
            })
            ->addColumn('ticketReply', function ($query) {
                if ($query->status === 'close') {
                    return '<span class="badge bg-secondary">Closed</span>';
                } else {
                    return '<button class="btn btn-sm btn-primary ticket_reply" data-ticket_id="' . $query->id . '" data-toggle="modal" data-target="#ticketReplyModal">Reply</button>';
                }
            })
            ->addColumn('action', function ($query) {
                return $query->action_buttons;
            })
            ->rawColumns(['ticketReply', 'view', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\\Ticket $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ticket $model)
    {
        if (Auth::user()->hasRole('admin')) {
            // If the user is an admin, show all tickets
            return $model->newQuery();
        } else {
            // If the user is not an admin, show only their own tickets
            return $model->where('user_id', Auth::id());
        }
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
            Column::make('userName')->title('User Name'),
            Column::make('categoryName')->title('Category Name'),
            Column::make('title')->title('Title'),
            Column::make('description')->title('Description'),
            Column::make('status')->title('Change Status'),
            Column::make('view')->title('View')
//            Column::computed('action', 'Action')
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
            ->setTableId('tickets-table')
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
