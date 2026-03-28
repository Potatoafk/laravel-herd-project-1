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

    <!-- POST DIV -->
    <div class="bg-white p-4 rounded-lg shadow-sm">
        <div class="flex items-center mb-3">
            <div class="w-10 h-10 rounded-full bg-gray-300"></div>
            <div class="ml-3">
                <p class="font-semibold">John Doe</p>
                <p class="text-xs text-gray-500">2 hours ago</p>
            </div>
        </div>
        <p class="text-gray-800">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio asperiores temporibus soluta animi corrupti corporis provident eaque, repellat vero placeat labore consectetur sit mollitia quis eius, ratione officia cumque! Perspiciatis.
        </p>
    </div>

    <!-- ADD COMMENT -->
    <div class="bg-white p-4 rounded-lg shadow-sm">
      <h3 class="font-semibold mb-3">Add a comment</h3>

      <div class="flex space-x-3">
        <div class="w-9 h-9 rounded-full bg-gray-300"></div>
        <input
          type="text"
          placeholder="Write a comment..."
          class="flex-1 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>

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
    </div>
</main>
@endsection
