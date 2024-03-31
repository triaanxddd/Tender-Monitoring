<?php

namespace App\Observers;

use App\Models\Task;
use Spatie\Activitylog\Models\Activity;

class TaskObserver
{
    public function logging(Task $task, string $eventName)
    {
        if ($eventName === 'created' || $eventName === 'updated' || $eventName === 'deleted') {
            $properties = [
                'name' => $task->name,
                'tanggal_upload' => $task->tanggal_upload,
                // Add more attributes here if needed
            ];

            Activity::where('subject_id', $task->id)
                    ->where('subject_type', Task::class)
                    ->latest()
                    ->first()
                    ->update(['properties' => $properties]);
        }
    }
    /**
     * Handle the Task "created" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
    }

    /**
     * Handle the Task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {

    }

    /**
     * Handle the Task "deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
