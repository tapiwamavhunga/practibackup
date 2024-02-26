<?php

  

namespace App\Http\Controllers;

  

use Illuminate\Http\Request;

use App\DataTables\UsersDataTable;

  

class AllController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function allusers(UsersDataTable $dataTable)

    {

        return $dataTable->render('users');

    }

}