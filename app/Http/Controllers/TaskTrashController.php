<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class TaskTrashController extends Controller
{
    public function index(Request $request){
        $searchName = $request->search_name;
        $searchMonth = $request->search_month;
        $searchCategory = $request->search_category;

        $tasks = Task::with(['user', 'category'])
                ->when($searchName, function($q) use($searchName){
                    return $q->where('name', 'like', '%' . $searchName . '%');
                })
                ->when($searchMonth, function($q) use($searchMonth){
                    $time=strtotime($searchMonth);
                    $month=date("m",$time);
                    $year=date("Y",$time);
    
                    return $q->whereMonth('tanggal_upload', '=', $month)->whereYear('tanggal_upload', '=', $year);
                })
                ->when($searchCategory, function($q) use($searchCategory){
                    return $q->where('category_id', $searchCategory);
                })
                ->onlyTrashed()
                ->latest()->paginate(25);

        $categories = Category::get();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function deleteTrash($id){
        $fileColumns = [
            'penjelasan',
            'upload_dokumen',
            'undangan_pelelangan',
            'teknis',
            'penawaran',
            'legal',
            'pengumuman_pem',
        ];

        // Delete associated files in related models (uraians, laporans, penagaihans, etc.)
        $relatedModels = [
            'uraians', 'laporans', 'penagihans', 'pembuatans', 'pembayarans', 
        ];

        $task = Task::onlyTrashed()->findOrFail($id);

        //loop delete on relation model
        foreach ($relatedModels as $relatedModel) {
            foreach ($task->{$relatedModel} as $relatedRecord) {
                $relatedRecord->deleteFile(); // Call deleteFile() method for each related model
            }
        }

        //loop delete on task columns it self
        foreach($fileColumns as $fileColumn){
            $arrayColumn = $task->{$fileColumn};
            
            $filePath = json_decode($arrayColumn, true);

            if ($arrayColumn && Storage::exists($filePath['file_directory'])) {
                Storage::delete($filePath['file_directory']); // Delete the associated file
            }
        }

        $task->forceDelete();

        return back()->with('success', 'Data terhapus permanen');
    }
    
    
    public function restoreTrash($id){
        $task = Task::onlyTrashed()->findOrFail($id);

        $task->restore();
        return back()->with('success', 'Data telah direstore');

    }
}
