<?php

namespace MorningTrain\Foundation\Api\Contracts;

use Illuminate\Http\Request;

interface Controller
{

    /**
     * @param Request $request
     * @param array ...$arguments
     * @return mixed
     */
    public function index(Request $request, ...$arguments);

    /**
     * @param Request $request
     * @param array ...$arguments
     * @return mixed
     */
    public function find(Request $request, ...$arguments);

    /**
     * @param Request $request
     * @param array ...$arguments
     * @return mixed
     */
    public function create(Request $request, ...$arguments);

    /**
     * @param Request $request
     * @param array ...$arguments
     * @return mixed
     */
    public function update(Request $request, ...$arguments);

    /**
     * @param Request $request
     * @param array ...$arguments
     * @return mixed
     */
    public function delete(Request $request, ...$arguments);

}