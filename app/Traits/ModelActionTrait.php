<?php

namespace App\Traits;

trait ModelActionTrait
{
//    public function impersonateModel($route)
//    {
//        return '<li><a href="' . $route . '" title="Impersonate" class="btn btn-info m-1"><i class="ri-user-2-fill"></i></a></li>';
//    }

    public function editModel($route)
    {
        return '<li><a href="' . $route . '" title="Edit" class="btn btn-secondary btn-sm m-1"><i class="fa fa-edit"></i></a></li>';
    }

    public function deleteModel($route, $token, $dataTableId)
    {
        return '<li><a href="#" onclick="deleteRow(`' . $route . '`,`' . $token . '`' . ',`' . $dataTableId . '`' . ')" title="Delete" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash-alt"></i></a></li>';
    }
}
