<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteColorChangeRequest;
use App\Http\Requests\NoteRequest;
use App\Models\Notes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function create(NoteRequest $request): JsonResponse
    {
        $data = $request->only(['title', 'content', 'color', 'isFavorite', 'user_id']);
        
        $note = Notes::create($data);

        $res = [ 'error' => '', 'note' => $note ];

        return response()->json($res);
    }

    public function readAll(Request $request): JsonResponse
    {
        $title = $request->input('title');
        $color = $request->input('color');

        $query = Notes::where('user_id', Auth::user()->id);

        if ($title) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        if ($color) {
            $query->where('color', $color);
        }

        $notes = $query->get();

        $response = [
            'error' => '',
            'notes' => $notes
        ];
        return response()->json($response);
    }

    public function show($id): JsonResponse
    {
        $note =  Notes::where('user_id', Auth::user()->id)->where('id', $id)->first();

        if ($note) {
            $response = [
                'error' => '',
                'note' => $note
            ];
        } else {
            $response['error'] = 'Não é possível localizar essa Tarefa';
        }
        return response()->json($response);
    }

    public function update(NoteRequest $request, $id): JsonResponse
    {
        $data = $request->only(['title', 'content', 'color', 'isFavorite', 'user_id']);

        $userId = Auth::user()->id;

        $note = Notes::where('user_id', $userId)->where('id', $id)->first();

        if ($note && ($data['user_id'] == $userId)) {
            $note->update($data);

            $response = [
                'error' => '',
                'note' => $note
            ];
        } else {
            $response['error'] = 'Não é possível localizar essa Tarefa';
        }
        return response()->json($response);
    }

    public function delete($id): JsonResponse
    {
        $note = Notes::where('user_id', Auth::user()->id)->where('id', $id)->first();

        if ($note) {
            $note->delete();

            $response = ['error' => ''];
        } else {
            $response['error'] = 'Não é possível localizar essa Tarefa';
        }
        return response()->json($response);
    }

    public function maskAsfavorite($id): JsonResponse
    {
        $note = Notes::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if ($note) {
            $note->isFavorite = 1 - $note->isFavorite;

            $note->save();

            $response = ['error' => ''];
        } else {
            $response['error'] = 'Não é possível localizar essa Tarefa';
        }
        return response()->json($response);
    }

    public function changeColor(NoteColorChangeRequest $request, $id): JsonResponse
    {
        $data = $request->only(['color']);

        $note = Notes::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if ($note) {
            $note->color = $data['color'];

            $note->save();

            $response = ['error' => ''];
        } else {
            $response['error'] = 'Não é possível localizar essa Tarefa';
        }
        return response()->json($response);
    }
}
