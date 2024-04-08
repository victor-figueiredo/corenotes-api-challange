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

    public function readAll(): JsonResponse
    {
        $notes = Notes::where('user_id', Auth::user()->id)->get();

        $response = [
            'error' => '',
            'notes' => $notes
        ];
        return response()->json($response);
    }

    /**
     * Método para ler uma tarefa
     */
    public function show($id): JsonResponse
    {
        // Recuperar tarefa do database e verificar o id e usuário
        $note =  Notes::where('user_id', Auth::user()->id)->where('id', $id)->first();

        // Verificar se existe essa tarefa
        if ($note) {
            $response = [
                'error' => '',
                // Pegar a tarefa
                'note' => $note
            ];
        } else {
            // Retorno de erro, caso o id sejá inválido e/ou usuário não seja dono da tarefa
            $response['error'] = 'Não é possível localizar essa Tarefa';
        }
        // Retorno das informações em formato JSON
        return response()->json($response);
    }

    /**
     * Atualizar tarefa no database
     */
    public function update(NoteRequest $request, $id): JsonResponse
    {
        // Pegar dados que foram validados pela request
        $data = $request->only(['title', 'content', 'color', 'isFavorite', 'user_id']);

        // Pegar usuário logado
        $userId = Auth::user()->id;

        // Recuperar tarefa do database e verificar o id e usuário
        $note = Notes::where('user_id', $userId)->where('id', $id)->first();

        // Verificar se existe a tarefa e verificar se não houve alteração de usuário
        if ($note && ($data['user_id'] == $userId)) {
            // Atualizar tarefa no database
            $note->update($data);

            $response = [
                'error' => '',
                // Pegar a tarefa
                'note' => $note
            ];
        } else {
            // Retorno de erro, caso o id sejá inválido e/ou usuário não seja dono da tarefa
            $response['error'] = 'Não é possível localizar essa Tarefa';
        }
        // Retorno das informações em formato JSON
        return response()->json($response);
    }

    /**
     * Método para deletar tarefa no database
     */
    public function delete($id): JsonResponse
    {
        // Recuperar tarefa do database e verificar o id e usuário
        $note = Notes::where('user_id', Auth::user()->id)->where('id', $id)->first();

        // Verificar se a tarefa existe
        if ($note) {
            // Deletar tarefa no database
            $note->delete();

            // Retorno sem erro
            $response = ['error' => ''];
        } else {
            // Retorno de erro, caso o id sejá inválido e/ou usuário não seja dono da tarefa
            $response['error'] = 'Não é possível localizar essa Tarefa';
        }
        // Retorno das informações em formato JSON
        return response()->json($response);
    }

    /**
     * Método para marcar/desmarcar tarefa como favorita no database
     */
    public function maskAsfavorite($id): JsonResponse
    {
        // Recuperar tarefa do database e verificar o id e usuário
        $note = Notes::where('id', $id)->where('user_id', Auth::user()->id)->first();

        //Se a tarefa existir alterar o estado de favorite entre 1/0
        if ($note) {
            // Alternar valor entre 1/0
            $note->isFavorite = 1 - $note->isFavorite;

            // Salvar tarefa no database com o novo valor
            $note->save();

            // Retorno sem erro
            $response = ['error' => ''];
        } else {
            // Retorno de erro, caso o id sejá inválido e/ou usuário não seja dono da tarefa
            $response['error'] = 'Não é possível localizar essa Tarefa';
        }
        // Retorno das informações em formato JSON
        return response()->json($response);
    }

    /**
     * Método para trocar cor da tarefa no databese
     */
    public function changeColor(NoteColorChangeRequest $request, $id): JsonResponse
    {
        // Pegar dados que foram validados pela request
        $data = $request->only(['color']);

        // Recuperar tarefa do database e verificar o id e usuário
        $note = Notes::where('id', $id)->where('user_id', Auth::user()->id)->first();

        //Se a tarefa existir alterar a cor
        if ($note) {
            // Alterar a cor
            $note->color = $data['color'];

            // Salvar tarefa no database com a nova cor
            $note->save();

            // Retorno sem erro
            $response = ['error' => ''];
        } else {
            // Retorno de erro, caso o id sejá inválido e/ou usuário não seja dono da tarefa
            $response['error'] = 'Não é possível localizar essa Tarefa';
        }
        // Retorno das informações em formato JSON
        return response()->json($response);
    }
}
