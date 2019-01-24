<?php

namespace App\Http\Controllers;

use App\Http\Contracts\TodoRepositoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

class TodoController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function all(TodoRepositoryInterface $todoRepository)
    {

        try {

            $result = $todoRepository->all();

            return response()->json(['msg' => 'Your todo items.', 'data' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 400);
        }
    }

    public function add(Request $request, TodoRepositoryInterface $todoRepository)
    {

        try {

            $todo = $todoRepository->add(new ParameterBag($request->all()));

            return response()->json(['msg' => 'Todo item has been added.', 'data' => $todo], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 400);
        }
    }

    public function destroy($id, TodoRepositoryInterface $todoRepository)
    {
        try {

            $todoRepository->delete(new ParameterBag(['id' => $id]));

            return response()->json(['msg' => 'Todo item has been deleted.'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 400);
        }
    }
}
