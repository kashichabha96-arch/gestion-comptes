@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto mt-10 px-4">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-8 flex items-center gap-2">
        🔔 Notifications
    </h2>
    @forelse($notifications as $note)
    <div class="bg-white rounded-2xl shadow-md p-6 mb-5 transition duration-300 hover:shadow-xl border-l-4
            {{ $note->is_read ? 'border-gray-300' : 'border-indigo-500' }}">
        <div class="flex justify-between items-start">
            <p class="text-gray-800 text-lg font-medium">
                {{ $note->message }}
            </p>
            @if(!$note->is_read)
            <span class="ml-4 bg-indigo-100 text-indigo-600 text-xs font-bold px-3 py-1 rounded-full">
                NEW
            </span>
            @endif
        </div>
        <div class="flex justify-between items-center mt-4">
            <small class="text-gray-400 text-sm">
                ⏱ {{ $note->created_at->diffForHumans() }}
            </small>
            @if(!$note->is_read)
            <a href="{{ route('notifications.read', $note->id) }}"
                class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                ✔ Mark as read
            </a>
            @endif
        </div>
    </div>
    @empty
    <div class="bg-gray-50 text-center py-12 rounded-xl shadow">
        <p class="text-gray-500 text-lg">📭 No notifications for now</p>
    </div>
    @endforelse
    <!-- 🔙 Button Router -->
    <div class="mt-10 flex justify-between items-center">
        <a href="{{route('dashboard')}}"
            class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700
                  text-white font-bold py-3 px-6 rounded-2xl shadow-lg transition">
            🔙 Retour
        </a>
    </div>
</div>
@endsection