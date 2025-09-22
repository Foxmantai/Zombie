<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategorien extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'kategoriens';

    public static $searchable = [
        'kategorie',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'kategorie',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function kategorieItems()
    {
        return $this->hasMany(Item::class, 'kategorie_id', 'id');
    }

    public function kategorieDatenbanks()
    {
        return $this->hasMany(Datenbank::class, 'kategorie_id', 'id');
    }

    public function kategorieFahrzeuges()
    {
        return $this->belongsToMany(Fahrzeuge::class);
    }

    public function kategorieWerkbankes()
    {
        return $this->belongsToMany(Werkbanke::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
