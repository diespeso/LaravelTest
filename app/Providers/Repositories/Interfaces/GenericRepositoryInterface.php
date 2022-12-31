<?php

namespace App\Providers\Repositories\Interfaces;

interface GenericRepositoryInterface {

    public function model();
    public function index();
    public function show(int $id);
    public function store($createBody);
    public function patch(int $id, $patchBody);
    public function destroy(int $id);
}
