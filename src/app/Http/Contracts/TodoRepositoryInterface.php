<?php

namespace App\Http\Contracts;

use Symfony\Component\HttpFoundation\ParameterBag;

interface TodoRepositoryInterface
{

    /**
     * Show all todo items.
     *
     * @return mixed
     */
    public function all();

    /**
     * Add todo item.
     *
     * @param ParameterBag $input
     *
     * @return mixed
     */
    public function add(ParameterBag $input);

    /**
     * Delete a todo item.
     *
     * @param ParameterBag $input
     *
     * @return mixed
     */
    public function delete(ParameterBag $input);
}