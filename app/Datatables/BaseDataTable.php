<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;

class BaseDataTable extends DataTable
{
    public $user;
    public $domHtml;
    public $tableClass;

    public function __construct()
    {
        $this->domHtml = '<"row"<"col-md-12"<"row"<"col-md-2"l><"col-md-4"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >';
        $this->tableClass = 'table table-bordered dt-responsive nowrap align-middle mdl-data-table';
        $this->sInfo = 'Showing page _PAGE_ of _PAGES_ of _MAX_ entries';
        $this->lengthMenu = [[10, 50, 100, -1], [10, 50, 100, "All"]];
        $this->pageLength = 10;
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
