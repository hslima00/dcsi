<?php
// ORM - Object Relational Mapping
// usado para aceder à DB
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Item extends Model
{

    use HasFactory, Searchable;

    protected $fillable = [
        'stock',
        'name',
        'serial_n',
        'price',
        'calibration_date',
        'part_number',
        'comment',
        'image',
        'system_id',
    ];

    public function system()
    {
        return $this->belongsTo(System::class);
    }



}
