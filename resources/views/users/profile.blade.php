@extends('layouts.master')
@section('title', 'User Profile')

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

    <!-- PROFILE HEADER -->
    <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
      <div class="flex items-center space-x-5">
        <!-- Avatar -->
        <div class="w-20 h-20 rounded-full bg-linear-to-br from-blue-400 to-blue-600 flex items-center justify-center shrink-0">
          <span class="text-white font-bold text-3xl">{{ strtoupper(substr(auth()->user()->first_name ?? 'U', 0, 1)) }}</span>
        </div>

        <!-- User Info -->
        <div>
          <h2 class="text-2xl font-semibold text-gray-900">{{ auth()->user()->first_name ?? 'User' }} {{ auth()->user()->last_name ?? '' }}</h2>
          <p class="text-gray-600 text-sm">{{ auth()->user()->email }}</p>
          <p class="text-xs text-gray-500 mt-1">Member since {{ auth()->user()->created_at->format('F d Y') }}</p>
        </div>
      </div>7

      <!-- ACTION BUTTONS -->
      <div class="mt-4 flex space-x-3">
        <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 font-semibold transition">
          Edit Profile
        </button>
        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700 font-semibold transition">
          Delete Account
        </button>
      </div>
    </div>

    <!-- USER POSTS -->
    <div class="space-y-4">
      <h3 class="text-gray-900 font-semibold text-lg">My Posts ({{ $posts->count() }})</h3>

      @forelse($posts as $post)
        <!-- POST -->
        <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
          <p class="text-gray-800 text-sm leading-relaxed">
            {{ $post->content }}
          </p>
          <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-200 text-xs text-gray-500">
            <span>{{ $post->created_at->diffForHumans() }}</span>
            <span><i class="bi bi-hand-thumbs-up"></i> {{ $post->likes->count() }} • <i class="bi bi-chat"></i> {{ $post->comments->count() }}</span>
          </div>
        </div>
      @empty
        <div class="bg-white p-8 rounded-lg shadow border border-gray-200 text-center">
          <p class="text-gray-500">No posts yet. Start sharing!</p>
        </div>
      @endforelse
    </div>
  </main>
</div>

@endsection
