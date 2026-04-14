@extends('layouts.master')
@section('title', 'Friends')

@section('content')
@include('partials.navbar')

<div class="bg-gray-200 min-h-screen py-8">
  <main class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-semibold text-gray-900">Friends</h1>
        <p class="text-gray-600 text-sm">Manage friend requests and connections.</p>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
      <div class="tabs flex flex-wrap bg-white px-4 py-3 gap-2 border-b border-gray-200">
        <button type="button" class="tab tab-bordered tab-active bg-white text-sm text-gray-700" data-tab="incoming"><i class="bi bi-envelope-arrow-down me-1"></i>Incoming Requests</button>
        <button type="button" class="tab tab-bordered bg-white text-sm text-gray-700" data-tab="sent"><i class="bi bi-envelope-arrow-up me-1"></i> Sent Requests</button>
        <button type="button" class="tab tab-bordered bg-white text-sm text-gray-700" data-tab="friends"><i class="bi bi-people me-1"></i> Your Friends</button>
        <button type="button" class="tab tab-bordered bg-white text-sm text-gray-700" data-tab="people"><i class="bi bi-person-add me-1"></i> Add Friends</button>
      </div>

      <div class="p-6 space-y-6">
        <div id="incoming" class="tab-panel space-y-6">
          <section class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900">Incoming Requests</h2>
            @forelse($pendingRequests as $request)
              <div class="mt-4 p-4 rounded-lg bg-gray-50 border border-gray-200">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                  <div>
                    <p class="font-semibold text-gray-900">{{ $request->requester->first_name ?? 'Unknown' }} {{ $request->requester->last_name ?? '' }}</p>
                    <p class="text-sm text-gray-500">{{ $request->requester->email }}</p>
                  </div>
                  <div class="flex flex-wrap items-center gap-2">
                    <form method="POST" action="{{ route('friends.accept', $request->friendship_id) }}">
                      @csrf
                      <button class="px-3 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">Accept</button>
                    </form>
                    <form method="POST" action="{{ route('friends.decline', $request->friendship_id) }}">
                      @csrf
                      <button class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">Decline</button>
                    </form>
                  </div>
                </div>
              </div>
            @empty
              <p class="mt-4 text-sm text-gray-500">No incoming friend requests.</p>
            @endforelse
          </section>
        </div>

        <div id="sent" class="tab-panel hidden space-y-6">
          <section class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900">Sent Requests</h2>
            @forelse($sentRequests as $request)
              <div class="mt-4 p-4 rounded-lg bg-gray-50 border border-gray-200 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                  <p class="font-semibold text-gray-900">{{ $request->requested->first_name ?? 'Unknown' }} {{ $request->requested->last_name ?? '' }}</p>
                  <p class="text-sm text-gray-500">{{ $request->requested->email }}</p>
                </div>
                <span class="inline-flex items-center rounded-full bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1">Pending</span>
              </div>
            @empty
              <p class="mt-4 text-sm text-gray-500">You haven't sent any friend requests yet.</p>
            @endforelse
          </section>
        </div>

        <div id="friends" class="tab-panel hidden space-y-6">
          <section class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900">Your Friends</h2>
            @forelse($acceptedFriendships as $friendship)
              @php
                $friend = $friendship->requester_id === auth()->id() ? $friendship->requested : $friendship->requester;
              @endphp
              <div class="mt-4 p-4 rounded-lg bg-gray-50 border border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                  <p class="font-semibold text-gray-900">{{ $friend->first_name }} {{ $friend->last_name }}</p>
                  <p class="text-sm text-gray-500">{{ $friend->email }}</p>
                </div>
                <form method="POST" action="{{ route('friends.destroy', $friendship->friendship_id) }}">
                  @csrf
                  @method('DELETE')
                  <button class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">Remove</button>
                </form>
              </div>
            @empty
              <p class="mt-4 text-sm text-gray-500">No friends yet. Start by sending a request.</p>
            @endforelse
          </section>
        </div>

        <div id="people" class="tab-panel hidden space-y-6">
          <section class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900">People You May Know</h2>
            <div class="mt-4 space-y-4">
              @foreach($people as $person)
                @php
                  $isFriend = in_array($person->user_id, $friendIds, true);
                  $isPendingSent = in_array($person->user_id, $pendingSentIds, true);
                  $isPendingReceived = in_array($person->user_id, $pendingReceivedIds, true);
                @endphp

                <div class="p-4 rounded-xl border border-gray-200 bg-gray-50 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                  <div>
                    <p class="font-semibold text-gray-900">{{ $person->first_name }} {{ $person->last_name }}</p>
                    <p class="text-sm text-gray-500">{{ $person->email }}</p>
                  </div>
                  <div class="flex flex-wrap items-center gap-2">
                    @if($isFriend)
                      <span class="inline-flex items-center rounded-full bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1">Friends</span>
                    @elseif($isPendingSent)
                      <span class="inline-flex items-center rounded-full bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1">Requested</span>
                    @elseif($isPendingReceived)
                      <span class="inline-flex items-center rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-1">Waiting for your action</span>
                    @else
                      <form method="POST" action="{{ route('friends.store') }}">
                        @csrf
                        <input type="hidden" name="requested_id" value="{{ $person->user_id }}">
                        <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">Add Friend</button>
                      </form>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
          </section>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection

@push('scripts')
@if(session('success'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        confirmButtonColor: '#10b981'
        });
    });
    </script>
@endif
@if(session('error'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('error') }}",
        confirmButtonColor: '#ef4444'
        });
    });
    </script>
@endif
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tabButtons = document.querySelectorAll('[data-tab]');
    var tabPanels = document.querySelectorAll('.tab-panel');

    tabButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        tabButtons.forEach(function (btn) {
          btn.classList.remove('tab-active');
        });
        tabPanels.forEach(function (panel) {
          panel.classList.add('hidden');
        });

        button.classList.add('tab-active');
        var target = document.getElementById(button.dataset.tab);
        if (target) {
          target.classList.remove('hidden');
        }
      });
    });
  });
</script>
@endpush
