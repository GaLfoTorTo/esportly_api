<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'uuid'         => $this->uuid,
            'title'        => $this->title,
            'description'  => $this->description,
            'points'       => $this->points,
            'category'     => $this->category,
            'modality'     => $this->modality,
            'completed'    => $this->pivot ? (bool) $this->pivot->completed : null,
            'completedAt'  => $this->pivot?->completed_at,
            'achievements' => $this->whenLoaded('achievements', fn () =>
                $this->achievements->map(fn ($achievement) => [
                    'id'            => $achievement->id,
                    'title'         => $achievement->title,
                    'requiredCount' => $achievement->pivot->required_count,
                ])
            ),
            'createdAt'    => $this->created_at?->toIso8601String(),
            'updatedAt'    => $this->updated_at?->toIso8601String(),
            'deletedAt'    => $this->deleted_at?->toIso8601String(),
        ];
    }
}
