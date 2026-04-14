  <nav class="bg-white max-w-2xl mx-auto space-y-5 rounded-md shadow-sm">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">

      <!-- Logo -->
      <h1 class="text-xl font-bold text-blue-600">Pisbuk</h1>

      <!-- Nav Links -->
      <div class="flex space-x-6 text-gray-700 items-center">
        <button class="hover:text-pink-600 transition">
            <a href="{{ route('feed') }}">
                <i class="bi bi-house"></i>
            </a>
        </button>
        <button class="hover:text-green-600 transition">
            <a href="{{ route('friends.index') }}">
                <i class="bi bi-people"></i>
            </a>
        </button>
        <button class="hover:text-purple-600 transition">
            <a href="{{ route('messages.index') }}">
                <i class="bi bi-chat"></i>
            </a>
        </button>
        <button class="hover:text-yellow-600 transition">
            <i class="bi bi-bell"></i>
        </button>
        <button onclick="profile_modal.showModal()" class="hover:text-blue-600 transition">
            <i class="bi bi-person"></i>
        </button>

        <!-- Profile Modal - DaisyUI Light Colored -->
        <dialog id="profile_modal" class="modal">
          <div class="modal-box bg-linear-to-br from-blue-50 to-indigo-50 border border-blue-100">

            <!-- User Profile Section -->
            <div class="text-center pb-6">
              <div class="w-40 h-40 rounded-full bg-linear-to-br from-blue-400 to-blue-600 flex items-center justify-center shrink-0 mx-auto mb-4 shadow-lg">
                <span class="text-white font-bold text-2xl">{{ strtoupper(substr(auth()->user()->first_name ?? 'U', 0, 1)) }}</span>
              </div>
              <h3 class="text-xl font-bold text-gray-900">{{ auth()->user()->first_name ?? 'User' }} {{ auth()->user()->last_name ?? '' }}</h3>
              <p class="text-sm text-gray-600 mt-1">{{ auth()->user()->email }}</p>
            </div>

            <span class="flex items-center">
            <span class="h-px flex-1 bg-gray-300"></span>

            <span class="shrink-0 px-4 text-sm text-gray-700">Menu</span>

            <span class="h-px flex-1 bg-gray-300"></span>
            </span>


            <!-- Menu Options -->
            <div class="space-y-2">
              <a href="{{ route('feed') }}" class="flex items-center space-x-3 p-3 hover:bg-blue-100 rounded-lg transition cursor-pointer text-gray-700 hover:text-blue-600">
                <i class="bi bi-house-fill text-blue-600"></i>
                <span class="font-medium">Feed</span>
              </a>
              <a href="{{ route('profile') }}" class="flex items-center space-x-3 p-3 hover:bg-blue-100 rounded-lg transition cursor-pointer text-gray-700 hover:text-blue-600">
                <i class="bi bi-gear-fill text-blue-600"></i>
                <span class="font-medium">Profile</span>
              </a>
              <a href="#" class="flex items-center space-x-3 p-3 hover:bg-blue-100 rounded-lg transition cursor-pointer text-gray-700 hover:text-blue-600">
                <i class="bi bi-bookmark-fill text-blue-600"></i>
                <span class="font-medium">Favorites</span>
              </a>
            </div>

            <span class="flex items-center">
            <span class="h-px flex-1 bg-gray-300"></span>

            <span class="shrink-0 px-4 text-sm text-gray-700"></span>

            <span class="h-px flex-1 bg-gray-300"></span>
            </span>
          </div>
          <form method="dialog" class="modal-backdrop">
            <button></button>
          </form>
        </dialog>

        <form method="POST" action="{{ route('logout') }}" class="inline" id="logoutFormNavbar">
          @csrf
          <button type="submit" class="hover:text-red-500 font-medium transition">
            <i class="bi bi-power"></i>
          </button>
        </form>
      </div>

    </div>
  </nav>

<script>
  // Logout confirmation for navbar icon button
  document.getElementById('logoutFormNavbar')?.addEventListener('submit', (e) => {
    e.preventDefault();
    Swal.fire({
      title: 'Logout?',
      text: 'Are you sure you want to logout?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc2626',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Logout',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logoutFormNavbar').submit();
      }
    });
  });

  // Logout confirmation for modal logout button
  document.getElementById('logoutFormModal')?.addEventListener('submit', (e) => {
    e.preventDefault();
    Swal.fire({
      title: 'Logout?',
      text: 'Are you sure you want to logout?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc2626',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Logout',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logoutFormModal').submit();
      }
    });
  });
</script>
