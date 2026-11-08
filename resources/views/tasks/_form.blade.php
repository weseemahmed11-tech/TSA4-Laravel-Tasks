@csrf
<div class="form-group">
    <label for="title">Task title</label>
    <input class="form-control" id="title" name="title" type="text" value="{{ old('title', $task->title) }}" required>
    @error('title')<div class="error">{{ $message }}</div>@enderror
</div>
<div class="form-group">
    <label for="task_date">Task date</label>
    <input class="form-control" id="task_date" name="task_date" type="date" value="{{ old('task_date', $task->task_date?->format('Y-m-d')) }}" required>
    @error('task_date')<div class="error">{{ $message }}</div>@enderror
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status" required>
        @foreach (['pending', 'in progress', 'completed', 'done'] as $status)
            <option value="{{ $status }}" @selected(old('status', $task->status) === $status)>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
    @error('status')<div class="error">{{ $message }}</div>@enderror
</div>
<div class="actions">
    <button class="button" type="submit">{{ $submitLabel }}</button>
    <a class="button secondary" href="{{ route('tasks.index') }}">Cancel</a>
</div>
