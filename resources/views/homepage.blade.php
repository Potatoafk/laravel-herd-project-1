@extends('layouts.master')
@section('title', 'Welcome to Pisbuk')
@section('content')
  <div class="min-h-screen flex items-center justify-center">
    <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-10 px-6">

      <!-- LEFT SIDE -->
      <div class="flex flex-col justify-center">
        <h1 class="text-5xl font-bold text-blue-600 mb-4">Pisbuk</h1>
        <p class="text-xl text-gray-700">
          Connect with friends and the world around you.
        </p>
      </div>

      <!-- RIGHT SIDE -->
      <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- LOGIN FORM -->
        <form class="space-y-4" method="POST" action="{{ route('login') }}">
          @csrf
          <input
            type="email"
            value="{{ old('email') }}"
            name="email"
            placeholder="Email address"
            class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-gray-500 text-gray-900"
          />

          <input
            type="password"
            name="password"
            placeholder="Password"
            class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-gray-500 text-gray-900"
          />

          <button
            type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded font-semibold hover:bg-blue-700"
          >
            Log In
          </button>

          <div class="text-center">
            <a href="#" class="text-blue-600 text-sm hover:underline">
              Forgot password?
            </a>
          </div>


          <!-- SIGN UP BUTTON -->
          <div class="flex justify-center">
            <a href="{{ route('signup') }}" type="button" class="bg-green-600 text-white px-6 py-3 rounded font-semibold hover:bg-green-700">
              Create New Account
          </a>
          </div>
        </form>
      </div>

    </div>
  </div>
@endsection

@push('scripts')
  @if ($errors->has('email') || $errors->has('password'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Invalid Credentials',
        html: {!! json_encode(implode('<br>', $errors->get('email'))) !!} || {!! json_encode(implode('<br>', $errors->get('password'))) !!},
        confirmButtonText: 'OK'
      });
    </script>
  @elseif ($errors->any())
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Validation Errors',
        html: {!! json_encode(implode('<br>', $errors->all())) !!},
        confirmButtonText: 'OK'
      });
    </script>
  @endif
@endpush
