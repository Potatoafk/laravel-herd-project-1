<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $acceptedFriendships = Friendship::where(function ($query) use ($user) {
            $query->where('requester_id', $user->user_id)
                ->orWhere('requested_id', $user->user_id);
        })->where('status', 'accepted')
            ->with(['requester', 'requested'])
            ->get();

        $friends = $acceptedFriendships->map(function ($friendship) use ($user) {
            return $friendship->requester_id === $user->user_id ? $friendship->requested : $friendship->requester;
        });

        $pendingRequests = $user->receivedFriendRequests()->where('status', 'pending')->with('requester')->get();
        $sentRequests = $user->sentFriendRequests()->where('status', 'pending')->with('requested')->get();

        $friendIds = $friends->pluck('user_id')->toArray();
        $pendingSentIds = $sentRequests->pluck('requested_id')->toArray();
        $pendingReceivedIds = $pendingRequests->pluck('requester_id')->toArray();

        $people = Users::where('user_id', '!=', $user->user_id)->get();

        return view('users.friends', compact(
            'acceptedFriendships',
            'friends',
            'pendingRequests',
            'sentRequests',
            'people',
            'friendIds',
            'pendingSentIds',
            'pendingReceivedIds'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'requested_id' => 'required|exists:users_table,user_id|different:' . Auth::id(),
        ]);

        $user = Auth::user();
        $targetId = $validated['requested_id'];

        if ($user->isFriendsWith($targetId)) {
            return back()->with('error', 'You are already friends with this user.');
        }

        $existingOutgoing = Friendship::where('requester_id', $user->user_id)
            ->where('requested_id', $targetId)
            ->where('status', 'pending')
            ->exists();

        if ($existingOutgoing) {
            return back()->with('error', 'You already sent a friend request to this user.');
        }

        $incomingRequest = Friendship::where('requester_id', $targetId)
            ->where('requested_id', $user->user_id)
            ->where('status', 'pending')
            ->first();

        if ($incomingRequest) {
            $incomingRequest->update(['status' => 'accepted']);
            return back()->with('success', 'Friend request accepted.');
        }

        Friendship::create([
            'requester_id' => $user->user_id,
            'requested_id' => $targetId,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Friend request sent.');
    }

    public function accept($friendshipId)
    {
        $friendship = Friendship::findOrFail($friendshipId);

        if ($friendship->requested_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $friendship->update(['status' => 'accepted']);

        return back()->with('success', 'Friend request accepted.');
    }

    public function decline($friendshipId)
    {
        $friendship = Friendship::findOrFail($friendshipId);

        if ($friendship->requested_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $friendship->update(['status' => 'declined']);

        return back()
            ->with('success', 'Friend request declined.')
            ->with('alert_action', 'decline');
    }

    public function destroy($friendshipId)
    {
        $friendship = Friendship::findOrFail($friendshipId);
        $userId = Auth::id();

        if ($friendship->requester_id !== $userId && $friendship->requested_id !== $userId) {
            abort(403, 'Unauthorized');
        }

        $friendship->delete();

        return back()->with('success', 'Friendship removed.');
    }
}
