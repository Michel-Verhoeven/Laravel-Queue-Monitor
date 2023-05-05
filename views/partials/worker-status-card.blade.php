@if(!is_null($queue_worker_status))
    <div class="flex flex-col justify-between p-6 @if($queue_worker_status === 0) bg-green-200 @else bg-red-200 @endif border border-gray-200 dark:border-gray-600 rounded-md shadow-sm">
        <div class="font-semibold text-sm text-gray-600 dark:text-gray-400" title="Queue Worker status">
            Queue worker
        </div>
        @if($queue_worker_status === 0)
            ✅ @lang('Active')
        @else 
            ❌ @lang('Inactive')
        @endif
    </div>
@endif