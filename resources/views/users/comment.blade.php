@extends('layouts.master')
@section('title', 'Comments')

@section('content')
@include('partials.navbar')

<div class="bg-gray-200 min-h-screen py-8">
  <main class="max-w-2xl mx-auto space-y-5">
    <!-- BACK TO FEED -->
    <div>
      <a href="{{ route('feed') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600">
        ← Back to Feed
      </a>
    </div>

    <!-- POST DIV -->
    <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
      <div class="flex items-center mb-3 space-x-3">
        <div class="w-10 h-10 rounded-full bg-linear-to-br from-blue-400 to-blue-600 flex items-center justify-center shrink-0">
          <span class="text-white font-bold text-sm">{{ strtoupper(substr($post->user->first_name ?? 'U', 0, 1)) }}</span>
        </div>
        <div>
          <p class="font-semibold text-gray-900 text-sm">{{ $post->user->first_name ?? 'Unknown' }} {{ $post->user->last_name ?? '' }}</p>
          <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
        </div>
      </div>
      <p class="text-gray-800 text-sm leading-relaxed">
        {{ $post->content }}
      </p>
    </div>

    <!-- ADD COMMENT -->
    <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
      <h3 class="font-semibold mb-3 text-gray-900">Add a comment</h3>

      <form action="{{ route('comments.store', $post->post_id) }}" method="POST">
        @csrf
        <div class="flex space-x-3">
          <div class="w-9 h-9 rounded-full bg-linear-to-br from-green-400 to-green-600 flex items-center justify-center shrink-0">
            <span class="text-white font-bold text-xs">{{ strtoupper(substr(auth()->user()->first_name ?? 'U', 0, 1)) }}</span>
          </div>
          <input
            type="text"
            placeholder="Write a comment..."
            name="content"
            class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100 placeholder:text-gray-500 text-gray-900"
          />
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 font-semibold text-sm transition">
            Post
          </button>
        </div>

      </form>
    </div>

    <!-- COMMENTS SECTION -->
    <div class="space-y-3">
      <h3 class="font-semibold text-gray-900">Comments ({{ $post->comments->count() }})</h3>

      @forelse($post->comments as $comment)
      <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
        <div class="flex items-center mb-2 space-x-3">
          <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
            <span class="text-white font-bold text-xs">{{ strtoupper(substr($comment->user->first_name ?? 'U', 0, 1)) }}</span>
          </div>
          <div class="flex-1">
            <p class="font-semibold text-gray-900 text-sm">{{ $comment->user->first_name ?? 'Unknown' }} {{ $comment->user->last_name ?? '' }}</p>
            <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
          </div>
        </div>
        <p class="text-gray-800 text-sm ml-11">
          {{ $comment->content }}
        </p>
      </div>
      @empty
      <div class="bg-white p-4 rounded-lg shadow border border-gray-200 text-center">
        <p class="text-gray-500 text-sm">No comments yet. Be the first to comment!</p>
      </div>
      @endforelse
    </div>
  </main>
</div>

@endsection
