<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'item_name',
        'spawn_name',
        'gewicht',
        'seltenes_item',
    ];

    protected $fillable = [
        'item_name',
        'spawn_name',
        'gewicht',
        'seltenes_item',
        'kategorie_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function endergebnisWerkbankes()
    {
        return $this->hasMany(Werkbanke::class, 'endergebnis_id', 'id');
    }

    public function kategorie()
    {
        return $this->belongsTo(Kategorien::class, 'kategorie_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
