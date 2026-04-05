  <nav class="bg-white max-w-2xl mx-auto space-y-5 rounded-md">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">

      <!-- Logo -->
      <h1 class="text-xl font-bold text-blue-600">Pisbuk</h1>

      <!-- Nav Links -->
      <div class="flex space-x-6 text-gray-700 items-center">
        <a href="#" class="hover:text-blue-600">Profile</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button type="submit" class="hover:text-red-500 font-medium">Logout</button>
        </form>
      </div>

    </div>
  </nav>
