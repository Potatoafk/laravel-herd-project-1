@extends('layouts.master')
@section('title', 'Feed')
@section('content')
@include('partials.navbar')

<div class="bg-gray-200 min-h-screen py-5">
  <main class="max-w-2xl mx-auto space-y-5">

    <!-- CREATE POST SECTION -->
    <div class="bg-white rounded-lg shadow p-4 border border-gray-200">
        <form action="{{ route('posts.create') }}" method="POST">
            @csrf
            <div class="flex items-center space-x-4">
              <input
                type="text"
                placeholder="What's on your mind?"
                name="content"
                class="flex-1 bg-gray-100 rounded-lg px-4 py-2 focus:outline-none text-sm placeholder:text-gray-500 text-gray-800"
              >
              <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold text-sm transition">
                Post
              </button>
            </div>
        </form>

      <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
        <div class="flex space-x-2">
          <button class="flex items-center space-x-2 text-gray-600 hover:bg-gray-100 px-3 py-2 rounded-lg text-sm font-medium transition">
            <span><i class="bi bi-camera"></i></span>
            <span>Photo</span>
          </button>
          <button class="flex items-center space-x-2 text-gray-600 hover:bg-gray-100 px-3 py-2 rounded-lg text-sm font-medium transition">
            <span><i class="bi bi-emoji-smile"></i></span>
            <span>Feeling</span>
          </button>
        </div>
      </div>
    </div>

    <!-- POSTS FEED -->
    @forelse($posts as $post)
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden hover:shadow-md transition">
      <!-- POST HEADER -->
      <div class="p-4 flex items-center justify-between border-b border-gray-200">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 rounded-full bg-linear-to-br from-blue-400 to-blue-600 flex items-center justify-center shrink-0">
            <span class="text-white font-bold text-sm">{{ strtoupper(substr($post->user->first_name ?? 'U', 0, 1)) }}</span>
          </div>
          <div>
            <p class="font-semibold text-gray-900 text-sm">{{ $post->user->first_name ?? 'Unknown' }} {{ $post->user->last_name ?? '' }}</p>
            <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
          </div>
        </div>
      </div>

      <!-- POST CONTENT -->
      <div class="p-4">
        <p class="text-gray-800 text-sm leading-relaxed">
          {{ $post->content }}
        </p>
      </div>

      <!-- POST STATS -->
      <div class="flex items-center justify-between px-4 py-2 text-xs text-gray-500 border-t border-gray-200">
        <span><i class="bi bi-hand-thumbs-up"></i> {{ $post->likes->count() }} reaction{{ $post->likes->count() != 1 ? 's' : '' }}</span>
        <div class="space-x-4">
          <a href="{{ route('comments.view', $post->post_id) }}" class="cursor-pointer hover:text-blue-600">{{ $post->comments->count() }} comment{{ $post->comments->count() != 1 ? 's' : '' }}</a>
          <span class="cursor-pointer hover:text-blue-600">0 shares</span>
        </div>
      </div>

      <!-- ACTIONS -->
      <div class="flex items-center border-t border-gray-200">
        @php
          $isLiked = $post->likes->where('user_id', auth()->id())->count() > 0;
        @endphp
        <form method="POST" class="flex-1">
          @csrf
          @if($isLiked)
            <button formaction="{{ route('posts.unlike', $post->post_id) }}" class="w-full flex items-center justify-center space-x-2 text-blue-600 hover:bg-blue-50 py-2 transition text-sm font-medium">
              <span><i class="bi bi-hand-thumbs-up-fill"></i></span>
              <span>Unlike</span>
            </button>
          @else
            <button formaction="{{ route('posts.like', $post->post_id) }}" class="w-full flex items-center justify-center space-x-2 text-gray-600 hover:bg-gray-100 py-2 transition text-sm font-medium">
              <span><i class="bi bi-hand-thumbs-up"></i></span>
              <span>Like</span>
            </button>
          @endif
        </form>
        <a href="{{ route('comments.view', $post->post_id) }}" class="flex-1 flex items-center justify-center space-x-2 text-gray-600 hover:bg-gray-100 py-2 transition text-sm font-medium border-l border-gray-200">
          <span><i class="bi bi-chat"></i></span>
          <span>Comment</span>
        </a>
      </div>
    </div>
    @empty
    <div class="bg-white rounded-lg shadow border border-gray-200 p-8 text-center">
      <p class="text-gray-500">No posts yet. Be the first to share!</p>
    </div>
    @endforelse

  </main>
</div>

@endsection
