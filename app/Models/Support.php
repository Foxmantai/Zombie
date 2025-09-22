<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Support extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'supports';

    protected $appends = [
        'beweismittel',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'Offen'          => 'Offen',
        'In Bearbeitung' => 'In Bearbeitung',
        'Geschlossen'    => 'Geschlossen',
    ];

    public const KATEGORIE_SELECT = [
        'Erstattung'        => 'Erstattung',
        'Regelbruch'        => 'Regelbruch',
        'Bug'               => 'Bug',
        'Technische Fragen' => 'Technische Fragen',
    ];

    protected $fillable = [
        'titel',
        'ingame_name',
        'grund',
        'supporter',
        'status',
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getBeweismittelAttribute()
    {
        return $this->getMedia('beweismittel');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
