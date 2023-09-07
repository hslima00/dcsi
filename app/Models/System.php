<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class System extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'parent_system_id',
    ];

    public function parentSystem()
    {
        return $this->belongsTo(System::class, 'parent_system_id');
    }

    public function childSystems()
    {
        return $this->hasMany(System::class, 'parent_system_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }


}
