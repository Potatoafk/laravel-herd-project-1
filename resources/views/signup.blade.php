@extends('layouts.master')
@section('title', 'Sign Up')
@section('content')
 <div class="min-h-screen flex items-center justify-center px-4">
    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-md">

      <!-- HEADER -->
      <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-blue-600">Sign Up</h1>
        <p class="text-gray-600">Create a new account</p>
      </div>

      <!-- SIGNUP FORM -->
      <form class="space-y-4" method="POST" action="{{ route('signup.store') }}">
        @csrf

        <div class="grid grid-cols-2 gap-3">
          <input
            type="text"
            name="firstname"
            value="{{ old('firstname') }}"
            placeholder="First name"
            class="px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-gray-500 text-gray-900"
            required
          />
          <input
            type="text"
            name="lastname"
            value="{{ old('lastname') }}"
            placeholder="Last name"
            class="px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-gray-500 text-gray-900"
            required
          />
        </div>

        <input
          type="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="Email address"
          class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-gray-500 text-gray-900"
          required
        />

        <input
          type="password"
          name="password"
          placeholder="Password"
          class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-gray-500 text-gray-900"
          required
        />

        <input
          type="password"
          name="password_confirmation"
          placeholder="Confirm password"
          class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-gray-500 text-gray-900"
          required
        />

        <!-- TERMS -->
        <p class="text-xs text-gray-500">
          By clicking Sign Up, you agree to our
          <a href="#" class="text-blue-600 hover:underline">Terms</a>,
          <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>,
          and
          <a href="#" class="text-blue-600 hover:underline">Cookies Policy</a>.
        </p>

        <!-- SIGN UP BUTTON -->
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-3 rounded font-semibold hover:bg-blue-700"
        >
          Sign Up
        </button>

      </form>

      <!-- FOOTER -->
      <div class="text-center mt-4">
        <p class="text-sm text-gray-600">
          Already have an account?
          <a href="{{ route('homepage') }}" class="text-blue-600 hover:underline">Log In</a>
        </p>
      </div>

    </div>
  </div>
@endsection

@push('scripts')
  @if ($errors->has('password') || $errors->has('password_confirmation'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Password Error',
        html: {!! json_encode(implode('<br>', $errors->get('password'))) !!} || {!! json_encode(implode('<br>', $errors->get('password_confirmation'))) !!},
        confirmButtonText: 'OK'
      });
    </script>
  @elseif ($errors->any())
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: {!! json_encode(implode('<br>', $errors->all())) !!},
        confirmButtonText: 'OK'
      });
    </script>
  @endif
@endpush
