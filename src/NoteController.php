<?php

namespace Jam0r85\NovaNotes;

use App\Note;
use Laravel\Nova\Http\Requests\NovaRequest;

class NoteController
{
    /**
     * Get all of the notes for the given model and ID.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return NoteResource
     */
    public function index(NovaRequest $request)
    {
        $notes = Note::with('owner')
                     ->whereParentType($request->model)
                     ->whereParentId($request->id)
                     ->get();

        return NoteResource::collection($notes);
    }

    /**
     * Get all of the importnat notes for the given model and ID.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return NoteResource
     */
    public function important(NovaRequest $request)
    {
        $notes = Note::with('owner')
                    ->whereIsImportant(true)
                    ->get();

        return NoteResource::collection($notes);
    }

    /**
     * Store a new note in storage.
     *
     * @param  NovaRequest $request [description]
     * @return [type]               [description]
     */
    public function store(NovaRequest $request)
    {
        $note = new Note();
        $note->owner_id = $request->user()->id;
        $note->team_id = $request->user()->current_team_id;
        $note->body = $request->body;
        $note->parent_type = $request->model;
        $note->parent_id = $request->id;
        $note->save();
    }
}
