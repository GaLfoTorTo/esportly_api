<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Action extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'actions';
    protected $fillable = [
        'title',
        'description',
        'modality',
        'score',
    ];
    protected $auditInclude = [
        'title',
        'description',
        'modality',
        'score',
    ];

    protected $casts = [
        'score' => 'float',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'achievement_actions')
                    ->withPivot('required_count')
                    ->withTimestamps();
    }
}
