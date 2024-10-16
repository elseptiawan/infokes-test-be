<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'parent_id'];

    public function subfolders()
    {
        return $this->hasMany(Folder::class, 'parent_id')->with(['subfolders', 'files']);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
