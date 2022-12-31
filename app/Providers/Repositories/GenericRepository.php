<?php

namespace App\Providers\Repositories;

use App\Providers\Repositories\Interfaces\GenericRepositoryInterface;

use App\Providers\Repositories\GenericUtils;

class GenericRepository implements GenericRepositoryInterface {

    public function model() {
        return null;
    }

    public function index() {
        return GenericUtils::index($this->model());
    }

    public function show(int $id) {
        return GenericUtils::show($this->model(), $id);
    }

    public function store($createBody) {
        return GenericUtils::store($this->model(), $createBody);
    }

    public function patch(int $id, $patchBody) {
        return GenericUtils::patch($this->model(), $id, $patchBody);
    }

    public function destroy(int $id) {
        return GenericUtils::destroy($this->model(), $id);
    }
}