<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use App\Http\Requests\IdeaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ideas = Auth::user()->ideas;

        return view('ideas.index', [                                            // redirect to resources/ideas
            'ideas' => $ideas
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        Gate::authorize('create', Idea::class);
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IdeaRequest $request)
    {
        // request()->validate([
        //     'description' => ['required', 'min:6']
        // ]);

        $idea = request('description');
        //dd($idea);

        Auth::user()->ideas()->create([
            'description' => $idea,
            'state' => 'pending',
        ]);

        return redirect('/ideas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        Gate::authorize('update', $idea);

        //other way to do it
//        if(Auth::user()->cannot('update', $idea)) {
//            return redirect('/ideas');
//        }

        return view('ideas.show', [
            'idea' => $idea
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
//        Gate::authorize('update', $idea);

        return view('ideas.edit', [
            'idea' => $idea
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IdeaRequest $request, Idea $idea)
    {
        Gate::authorize('update', $idea);
        $idea->update([
            'description' => request('description')
        ]);
        return redirect("/ideas/{$idea->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        Gate::authorize('update', $idea);  // naka update lng kay same lng mn sila implementation
        $idea->delete(); //delete the specific idea
        return redirect('/ideas');
    }
}
