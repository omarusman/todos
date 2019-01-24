<?php

namespace App\Http\Repositories;

use App\Http\Contracts\TodoRepositoryInterface;
use App\Todo;
use Symfony\Component\HttpFoundation\ParameterBag;

class TodoRepository implements TodoRepositoryInterface
{

    public function all()
    {
        return Todo::orderBy('created_at', 'desc')->get();
    }

    public function add(ParameterBag $input)
    {
        $todo = new Todo;

        if ( ! $todo->valid($input->all())) {
            throw new \Exception($todo->errors()->first());
        }

        $todo->fill($input->all());
        $todo->save();

        return $todo;
    }

    public function delete(ParameterBag $input)
    {
        $todo = new Todo;

        foreach ($input as $field => $value) {
            $todo->where($field, $value);
        }

        $todo = $todo->first();

        if ( ! $todo) {
            throw new \Exception('Todo item not found.');
        }

        return $todo->delete();
    }
}