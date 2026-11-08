<x-mail::message>
# Task completed

The task **{{ $task->title }}** was marked as done.

**Scheduled date:** {{ $task->task_date->format('F j, Y') }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
