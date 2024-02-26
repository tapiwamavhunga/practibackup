<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Users;
use DataTables;
class VerificationsController extends Controller
{
    public function index()
    {
        return view('verifications');
    }

    public function getVerifications(Request $request)
    {
        if ($request->ajax()) {
            //$data = Users::latest()->get();
            $data = Users::where('is_verified', NULL)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    //$actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    $actionBtn = '<a href="/user/profile/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-block editProduct">Edit</a>

                    

                    ';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}