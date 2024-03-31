<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Goods;
use App\Models\Uraian;
use App\Models\Laporan;
use App\Models\Category;
use App\Models\DemandedGoods;
use App\Models\Pembuatan;
use App\Models\Penagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchName = $request->search_name;
        $searchMonth = $request->search_month;
        $searchCategory = $request->search_category;
        $searchStatus = $request->search_status;

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
                ->when($searchStatus != null, function($q) use($searchStatus){
                    if($searchStatus == 3){
                        return $q->where('is_complete', 1);
                    }
                    // elseif($searchStatus == 1){
                    //     return $q->where('status_pemenang', $searchStatus)->where('is_complete', '!=' , 1);
                    // }
                    return $q->where('status_pemenang', $searchStatus);
                })
                ->latest()->paginate(25);

        $categories = Category::get();
        
        return view('tasks.index', compact('tasks', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation form request
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'penjelasan' => 'mimes:pdf,png,jpg|file|max:20480', //file
            'upload_dokumen' => 'mimes:pdf,png,jpg|file|max:20480', //file
            'undangan_pelelangan' => 'mimes:pdf,png,jpg|file|max:20480', //file
            'teknis' => 'mimes:pdf,png,jpg|file|max:20480', //file
            'penawaran' => 'mimes:pdf,png,jpg|file|max:20480', //file
            'legal' => 'mimes:pdf,png,jpg|file|max:20480', //file
            'pengumuman_pem' => 'mimes:pdf,png,jpg|file|max:20480', //file
            'barang' => 'max:255',
            'harga_kontrak'=> '',
            'harga_perkiraan_sendiri'=> 'required',
            'harga_pagu'=> '',
            'harga_upload'=> '',
            'tanggal_upload' => 'required',
            'category_id' => 'required',
            'pembuatan.*' => ''
        ]);

        //user_id based on who created tasks
        $validateData['user_id'] = auth()->user()->id;
        $validateData['harga_kontrak'] = substr($validateData['harga_kontrak'], 4);
        $validateData['harga_perkiraan_sendiri'] = substr($validateData['harga_perkiraan_sendiri'], 4);
        $validateData['harga_pagu'] = substr($validateData['harga_pagu'], 4);
        $validateData['harga_upload'] = substr($validateData['harga_upload'], 4);
        $validateData['track'] = 'Menunggu Peng. Pelelangan';


        // Define array of column names for file uploads
        $fileColumns = [
        'penjelasan',
        'upload_dokumen',
        'undangan_pelelangan',
        'teknis',
        'penawaran',
        'legal',
        'pengumuman_pem',
        ];

        // Process file uploads
        foreach ($request->allFiles() as $key => $file) {
            foreach ($fileColumns as $column) {
                if (strpos($key, $column) === 0) {
                    $fileData = [
                        'file_directory' => $file->store('task-files'),
                        'user_name' => auth()->user()->name,
                        'date_uploaded' => date('Y-m-d H:i:s'),
                    ];
                    
                    $validateData[$column] = json_encode($fileData);
                }
            }
        }   

        $task = Task::create($validateData);
        
        $this->subTaskFileStore('pembuatan', 'pembuatan-files', $task->id, 'Pembuatan', $request);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $pembuatans = Pembuatan::where('task_id', $task->id)->latest()->get();

        $uraians = Uraian::where('task_id', $task->id)->latest()->get();
        $laporans = Laporan::where('task_id', $task->id)->latest()->get();
        $penagihans = Penagihan::where('task_id', $task->id)->latest()->get();
        $pembayarans = Pembayaran::where('task_id', $task->id)->latest()->get();

        //goods and demanded goods
        $goods = Goods::latest()->get();
        $demandedGoods = DemandedGoods::with(['task', 'goods'])->where('task_id', $task->id)->latest()->get();

        return view('tasks.show', compact('task', 'uraians', 'laporans', 'penagihans', 'pembayarans', 'pembuatans', 'goods', 'demandedGoods'));
    }


    public function pdfDownload($id){
        $mpdf = new \Mpdf\Mpdf();
        $task = Task::whereId($id)->first();
        
        $pembuatans = Pembuatan::where('task_id', $task->id)->latest()->get();

        $uraians = Uraian::where('task_id', $task->id)->latest()->get();
        $laporans = Laporan::where('task_id', $task->id)->latest()->get();
        $penagihans = Penagihan::where('task_id', $task->id)->latest()->get();
        $pembayarans = Pembayaran::where('task_id', $task->id)->latest()->get();

        $mpdf->WriteHTML(view('tasks.pdf_show', compact('task',  'uraians', 'laporans', 'penagihans', 'pembayarans', 'pembuatans'))->render());
        $mpdf->Output();

        // return view('tasks.show', compact('task', 'uraians', 'laporans', 'penagihans', 'pembayarans', 'pembuatans'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $pembuatans = Pembuatan::where('task_id', $task->id)->latest()->get();

        $uraians = Uraian::where('task_id', $task->id)->latest()->get();
        $laporans = Laporan::where('task_id', $task->id)->latest()->get();
        $penagihans = Penagihan::where('task_id', $task->id)->latest()->get();
        $pembayarans = Pembayaran::where('task_id', $task->id)->latest()->get();
        $categories = Category::get();
        
        //goods and demanded goods
        $goods = Goods::latest()->get();
        $demandedGoods = DemandedGoods::with(['task', 'goods'])->where('task_id', $task->id)->latest()->get();

        return view('tasks.edit', compact('task', 'uraians', 'laporans', 'penagihans', 'pembayarans', 'pembuatans', 'categories', 'goods', 'demandedGoods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */

    public function subTaskFileStore($subTaskName, $subTaskFolder, $taskId, $modelName, $request){
        $files = $request->file($subTaskName);
        if($files){
            foreach($files as $file){
                $fileDirectory = $file->store($subTaskFolder);
                // Create a new Uraian record for each file uploaded
                $uraian = app("App\Models\\{$modelName}");
                $uraian->file = $fileDirectory;
                $uraian->user_name = auth()->user()->name; 
                $uraian->task_id = $taskId; 

                // Add other attributes as needed
                $uraian->save();
            }
        }
    }

    private function tracker($status_pemenang, $task){
            $relationUraian = count($task->uraians);
            $relationLaporan = count($task->laporans);
            $relationPenagihan = count($task->penagihans);
            $relationPembayaran = count($task->pembayarans);


            //0 = Menunggu
            if($status_pemenang == 0){
                return 0;
            }
            //1 = lanjut -> uraian
            elseif($status_pemenang == 1){
                //lanjut
                if($relationUraian > 0){
                    if($relationLaporan > 0){
                        if($relationPenagihan > 0){
                            if($relationPembayaran > 0){
                                return 1;
                            }
                            return 0;
                        }
                        return 0;
                    }
                    return 0;
                }
                return 0;
            }

            //2 = kalah STOP
            elseif($status_pemenang == 2){
                return 0;
            }

    }

    public function update(Request $request, Task $task)
    {

        //validation input
        $rules = [
            'name' => 'required|max:255',
            'penjelasan' => 'nullable|mimes:pdf,png,jpg|file|max:20480', //file
            'upload_dokumen' => 'nullable|mimes:pdf,png,jpg|file|max:20480', //file
            'undangan_pelelangan' => 'nullable|mimes:pdf,png,jpg|file|max:20480', //file
            'teknis' => 'nullable|mimes:pdf,png,jpg|file|max:20480', //file
            'penawaran' => 'nullable|mimes:pdf,png,jpg|file|max:20480', //file
            'legal' => 'nullable|mimes:pdf,png,jpg|file|max:20480', //file
            'pengumuman_pem' => 'nullable|mimes:pdf,png,jpg|file|max:20480', //file
            'barang' => 'max:255',
            'harga_kontrak'=> '',
            'harga_perkiraan_sendiri'=> '',
            'harga_pagu'=> '',
            'harga_upload'=> '',
            'tanggal_upload' => 'required',
            'status_pemenang' => 'required',
            'uraian.*' => 'nullable|mimes:pdf,png,jpg|file|max:20480',
            'laporan.*' => 'nullable|mimes:pdf,png,jpg|file|max:20480',
            'penagihan.*' => 'nullable|mimes:pdf,png,jpg|file|max:20480',
            'pembayaran.*' => 'nullable|mimes:pdf,png,jpg|file|max:20480',
            'category_id' => 'required',
            'pembuatan.*' => '',
            'loss_statement' => ''
        ];
        
        $validateData = $request->validate($rules);

        $validateData['harga_kontrak'] = substr($validateData['harga_kontrak'], 4);
        $validateData['harga_perkiraan_sendiri'] = substr($validateData['harga_perkiraan_sendiri'], 4);
        $validateData['harga_pagu'] = substr($validateData['harga_pagu'], 4);
        $validateData['harga_upload'] = substr($validateData['harga_upload'], 4);

        // Define array of column names for file uploads
        $fileColumns = [
            'penjelasan',
            'upload_dokumen',
            'undangan_pelelangan',
            'teknis',
            'penawaran',
            'legal',
            'pengumuman_pem',
            ];
    
        // Process file uploads
        foreach ($request->allFiles() as $key => $file) {
            foreach ($fileColumns as $column) {
                if (strpos($key, $column) === 0) {
                    $fileData = [
                        'file_directory' => $file->store('task-files'),
                        'user_name' => auth()->user()->name,
                        'date_uploaded' => date('Y-m-d H:i:s'),
                    ];
                    
                    $validateData[$column] = json_encode($fileData);
                }
            }
        }   

        //update model
        $task->update($validateData);

        //insert data to relation table of task
        $this->subTaskFileStore('uraian', 'uraian-files', $task->id, 'Uraian', $request);
        $this->subTaskFileStore('laporan', 'laporan-files', $task->id, 'Laporan', $request);
        $this->subTaskFileStore('penagihan', 'penagihan-files', $task->id, 'Penagihan', $request);
        $this->subTaskFileStore('pembayaran', 'pembayaran-files', $task->id, 'Pembayaran', $request);
        $this->subTaskFileStore('pembuatan', 'pembuatan-files', $task->id, 'Pembuatan', $request);

         //task complete 
         $status_pemenang = $request->status_pemenang;
         $checkCompleteTask = $this->tracker($status_pemenang, $task);
         if($checkCompleteTask == 1){
            $task->update([$task->is_complete = 1]);
         }
        return redirect()->back()->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $name = $task->name;
        $task->delete();
        return redirect()->route('tasks.index')->with('success', $name . ' sudah terdelete');
    }

    //delete one file in task
    public function deleteFile($column, $id){
        $task = Task::where('id',$id)->first();
        $fileDirectory = json_decode($task->$column, true);

        Storage::delete($fileDirectory['file_directory']);
        $task->update([$task->$column = null]);

        return redirect()->back();
    }

    //delete one file sub-task (relation data)
    public function deleteFileSubTask($subTask, $id){

        $model = app("App\Models\\{$subTask}");
        $item = $model->whereId($id)->first();

        $countModel = $model->count();

        $task = Task::findOrFail($item->task_id);
        Storage::delete($item->file);
        $item->delete();

        //reset complete of parent class (task) if related record model less than equal 1
        if($countModel <= 1 ){
            $task->update([$task->is_complete = 0]);
        }

        return back();
    }

    //ajax jquery list
    public function taskList(){
        $tasks = Task::latest()->get();
        $data = [];

        foreach($tasks as $task){
            $data[] = [
                'id' => $task['id'],
                'name' => $task['name']
            ];
        }

        return $data;
    }
    
}
