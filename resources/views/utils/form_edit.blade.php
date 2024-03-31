@if(!$taskColumn)
<div>
    @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => $label, 'type' => 'file', 'name' => $name])
</div>
@else
    <div>
        @include('partials.list_coledit', [
            'label' => $label, 
            'uploader' => $data ? $data['user_name'] : '', 
            'tanggal' => $data ? $data['date_uploaded'] : '', 
            'directory' => $data ? asset('storage').'/'.$data['file_directory'] : '',
            'url' => '/tasks/delete-file/'. $name . '/' . $task->id,
        ])
    </div>
@endif