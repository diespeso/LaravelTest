<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Permission;

class Rol extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $fillable = [
        "name",
    ];


    public function permissions() {
        return $this->hasMany(Permission::class, "roleId" ,"id");
    }
}
