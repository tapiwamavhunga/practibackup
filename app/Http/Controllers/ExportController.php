<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\User;
use App\Models\SMS;
use App\Models\Emails;

class ExportController extends Controller
{
    //

    public function export_users(){
        $users = User::all();


    // Export all users
    // (new FastExcel($users))->export('file.xlsx');
    return (new FastExcel(User::all()))->download('file.xlsx');
    }

    public function exportCSV(Request $request)
{
   $fileName = 'email_reports.csv';
   $tasks = Emails::all();
   
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Title']  = $task->title;
                $row['Assign']    = $task->assign->name;
                $row['Description']    = $task->description;
                $row['Start Date']  = $task->start_at;
                $row['Due Date']  = $task->end_at;

                fputcsv($file, array($row['Title'], $row['Assign'], $row['Description'], $row['Start Date'], $row['Due Date']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
