<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Goods;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $selectedYear = $request->search_year;

        $tasks = Task::
        when($selectedYear != 0, function($q) use($selectedYear){
            return $q->whereYear('tanggal_upload', $selectedYear);
        })
        ->latest()->get();
        
        $categories = Category::with('task')->latest()->get();
        $goods = Goods::with('demandedGoods')->latest()->get();
        $taskData = [];

        foreach($tasks as $task){
            // Assuming your `tracker` function returns the level progression based on the status
            $levelProgression = tracker($task->status_pemenang, $task);

            $taskData[] = [
                'x' => $task->name, // Replace with your task name attribute
                'y' => $levelProgression, // Replace with your level progression attribute
            ];
        }

        return view('index', compact('tasks', 'categories', 'taskData', 'goods'));
    }

    public function getTasksByYear(Request $request){
        $selectedYear = $request->search_year;
    
        // Retrieve tasks for the selected year

        if($selectedYear != 0){
            $tasksForYear = Task::whereYear('tanggal_upload', $selectedYear)->get();
        }
        else{
            $tasksForYear = Task::get();
        }

        $taskData = [];

        foreach($tasksForYear as $task){
            // Assuming your `tracker` function returns the level progression based on the status
            $levelProgression = tracker($task->status_pemenang, $task);

            $taskData[] = [
                'x' => $task->name, // Replace with your task name attribute
                'y' => $levelProgression, // Replace with your level progression attribute
            ];
        }
        return response()->json(['tasksForYear' => $taskData]);
    }
}
