@extends('layouts.master')
@section('title', 'Create Post')
@section('content')
  <div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-2xl mx-auto px-4">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold mb-6">Create a New Post</h1>

        @if ($errors->any())
          <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
          @csrf

          <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
              What's on your mind?
            </label>
            <textarea
              id="content"
              name="content"
              rows="6"
              placeholder="Share your thoughts..."
              class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror"
            >{{ old('content') }}</textarea>
            @error('content')
              <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
          </div>

          <div class="flex gap-4">
            <button
              type="submit"
              class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition"
            >
              Post
            </button>
            <a
              href="{{ route('feed') }}"
              class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-400 transition text-center"
            >
              Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
