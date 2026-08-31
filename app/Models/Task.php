<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\User;
use App\Models\Achievement;

class Task extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tasks';
    protected $fillable = [
        'uuid',
        'title',
        'description',
        'points',
        'category',
        'modality',
    ];
    protected $auditInclude = [
        'uuid',
        'title',
        'description',
        'points',
        'category',
        'modality',
    ];

    protected $casts = [
        'points'     => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // ─── Boot ────────────────────────────────────────────────────────────────

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Task $task) {
            if (empty($task->uuid)) {
                $task->uuid = (string) Str::uuid();
            }
        });
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tasks')
                    ->withPivot(['completed', 'completed_at'])
                    ->withTimestamps();
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'achievement_tasks')
                    ->withPivot('required_count')
                    ->withTimestamps();
    }
}
