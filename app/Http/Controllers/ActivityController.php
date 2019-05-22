<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityEntry;
use App\ActivityPrice;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Returns the index view.
     *
     * @return mixed The index view
     */
    public function index()
    {
        $today = Carbon::today();

        $activities = Activity::where([
            ['available_from', '<=', $today],
            ['available_to', '>=', $today],
        ])->get();

        return view('activity.index', compact('activities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $activity = Activity::findOrFail($id);
        $activity_entry = ActivityEntry::where([
            ['user_id', $user->id],
            ['activity_id', $activity->id],
        ])->first();

        $activity_price = $activity->prices()
            ->where('user_category_alias', $user->user_category_alias)
            ->first();

        return view('activity.show', compact('activity', 'activity_entry', 'activity_price'));
    }

    /**
     * Display a listing of the resources for administrators.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        $activities = Activity::latest()->get();

        return view('activity.manage', compact('activities'));
    }

    /**
     * Display a listing of the resources for administrators.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activity.create');
    }

    /**
     * Display a specified listing of the resources for administrators.
     *
     * @param int $id The id of the activity
     * @return \Illuminate\Http\Response
     */
    public function entries($id)
    {
        $activity = Activity::findOrFail($id);
        $activity_entries = ActivityEntry::where('activity_id', $id)->get();

        return view('activity.entries', compact('activity', 'activity_entries'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'event_name' => 'required|unique:activities,title|max:255',
            'description' => 'required',
            'event_price_member' => 'required|numeric',
            'event_price_non_member' => 'required|numeric',
            'member_limit' => 'int',
            'available_from' => 'required',
            'available_to' => 'required',
            'starts_at' => 'required',
            'ends_at' => 'required',
        ]);

        $activity = Activity::create([
            'title' => request('event_name'),
            'description' => request('description'),
            'member_limit' => request('member_limit'),
            'available_from' => request('available_from'),
            'available_to' => request('available_to'),
            'starts_at' => request('starts_at'),
            'ends_at' => request('ends_at'),
        ]);

        $activityPriceMember = ActivityPrice::create([
            'activity_id' => $activity->id,
            'user_category_alias' => 'lid',
            'amount' => request('event_price_member'),
        ]);

        $activityPriceNonMember = ActivityPrice::create([
            'activity_id' => $activity->id,
            'user_category_alias' => 'geen-lid',
            'amount' => request('event_price_non_member'),
        ]);

        flash('Evenement toegevoegd!', 'success');

        return redirect(route('activity.index'));
    }
}
