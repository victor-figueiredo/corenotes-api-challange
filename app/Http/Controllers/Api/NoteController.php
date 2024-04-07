<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notes;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    private $note;

    public function __construct(Notes $note)
    {
        $this->note = $note;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $find = $this->note;
    
        $title = $request->input('title');
        if ($title) {
            $notes = $find->where('title', 'like', "%$title%");
        }
    
        $color = $request->input('color');
        if ($color) {
            $notes = $find->where('color', $color);
        }
    
        $isFavorite = $request->input('isFavorite');
        if ($isFavorite !== null) {
            $notes = $find->where('isFavorite', $isFavorite);
        }
    
        if (!isset($notes)) {
            $notes = $this->note;
        }
    
        $notes = $notes->orderByDesc('isFavorite')->paginate(10);
    
        return [
            'current_page' => $notes->currentPage(),
            'data' => $notes->items(),
            'last_page' => $notes->lastPage(),
            'per_page' => $notes->perPage(),
            'total' => $notes->total(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->note->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Notes $note)
    {
        return $note;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notes $note)
    {
        $note->update($request->all());
        return $note;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notes $note)
    {
        return $note->delete();
    }
}
