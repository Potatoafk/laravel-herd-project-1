@extends('layouts.app')

@section('feed')
<main class="max-w-2xl mx-auto mt-6 px-4 space-y-6">

  <!-- BACK TO FEED -->
  <div>
    <a
      href="/feed"
      class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600"
    >
      ← Back to Feed
    </a>
  </div>

  <!-- PROFILE HEADER -->
  <div class="bg-white p-6 rounded-lg shadow-sm">
    <div class="flex items-center">
      <!-- Avatar -->
      <div class="w-20 h-20 rounded-full bg-gray-300"></div>

      <!-- User Info -->
      <div class="ml-5">
        <h2 class="text-xl font-semibold">John Doe</h2>
        <p class="text-gray-600 text-sm">Web dev • building cool stuff</p>
        <p class="text-xs text-gray-500 mt-1">Joined January 2026</p>
      </div>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="mt-4 flex space-x-3">
      <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Edit Profile
      </button>
    </div>
  </div>

  <!-- USER POSTS -->
  <div class="space-y-4">
    <h3 class="text-gray-700 font-semibold">Posts</h3>

    <!-- POST -->
    <div class="bg-white p-4 rounded-lg shadow-sm">
      <p class="text-gray-800">
        First post on my new social app 🚀
      </p>
      <p class="text-xs text-gray-500 mt-2">2 hours ago</p>
    </div>

    <!-- POST -->
    <div class="bg-white p-4 rounded-lg shadow-sm">
      <p class="text-gray-800">
        Keeping things simple and clean.
      </p>
      <p class="text-xs text-gray-500 mt-2">Yesterday</p>
    </div>
  </div>

</main>


@endsection
