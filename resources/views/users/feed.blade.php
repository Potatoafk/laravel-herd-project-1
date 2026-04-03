@extends('layouts.master')

@section('content')
@include('partials.navbar')
  <main class="max-w-2xl mx-auto mt-6 px-4 space-y-6">

    <!-- CREATE POST -->
    <div class="bg-white p-4 rounded-lg shadow-sm">
      <textarea
        rows="3"
        placeholder="What's on your mind?"
        class="w-full border rounded px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
      ></textarea>

      <div class="flex justify-end mt-3">
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          Post
        </button>
      </div>
    </div>

    <!-- POST CARD -->
    <div class="bg-white p-4 rounded-lg shadow-sm">
      <div class="flex items-center mb-3">
        <div class="w-10 h-10 rounded-full bg-gray-300"></div>
        <div class="ml-3">
          <p class="font-semibold">John Doe</p>
          <p class="text-xs text-gray-500">2 hours ago</p>
        </div>
      </div>

      <p class="text-gray-800">
        Just finished building my first social app UI using Tailwind 🔥
      </p>

      <div class="flex space-x-6 mt-4 text-sm text-gray-500">
        <button class="hover:text-blue-600">Like</button>
        <button class="hover:text-blue-600">Comment</button>
      </div>
    </div>

    <!-- ANOTHER POST -->
    <div class="bg-white p-4 rounded-lg shadow-sm">
      <div class="flex items-center mb-3">
        <div class="w-10 h-10 rounded-full bg-gray-300"></div>
        <div class="ml-3">
          <p class="font-semibold">Jane Smith</p>
          <p class="text-xs text-gray-500">Yesterday</p>
        </div>
      </div>

      <p class="text-gray-800">
        Keeping things simple > overcomplicating everything 💡
      </p>

      <div class="flex space-x-6 mt-4 text-sm text-gray-500">
        <button class="hover:text-blue-600">Like</button>
        <button class="hover:text-blue-600">Comment</button>
      </div>
    </div>

  </main>

@endsection
