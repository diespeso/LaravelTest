<?php

namespace App\Providers\Repositories;
use Illuminate\Database\Eloquent\Model;

class GenericUtils {
    public static function index($model) {
        return $model::all();
    }

    public static function show($model, int $id) {
        return $model::find($id);
    }

    public static function store($model, $createbody) {
        $createObject = new $model($createbody);

        if (!$createObject->save()) {
            echo "error saving object"; //TODO: throw
            return;
        }
        $createObject->refresh();
        return $createObject;
    }

    public static function patch($model, $id, $patchBody) {
        $patchInstance = $model::find($id);
        if (!$patchInstance || !$patchInstance->update($patchBody)) {
            echo "error udpating instance";
            return;
        }
        return $patchInstance;
    }

    public static function destroy($model, $id) {
        $destroyInstance = $model::find($id);
        if (!$destroyInstance || !$destroyInstance->delete()) {
            error_log("failed to destroy instance");
            return false;
        }
        return true;
    }
}