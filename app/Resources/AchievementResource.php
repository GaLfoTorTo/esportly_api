<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AchievementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'points'      => $this->points,
            'image'       => $this->image,
            'rarity'      => $this->rarity,
            'status'      => $this->status,
            'actions'     => $this->whenLoaded('actions', fn () =>
                $this->actions->map(fn ($action) => [
                    'id'            => $action->id,
                    'title'         => $action->title,
                    'description'   => $action->description,
                    'score'         => $action->score,
                    'requiredCount' => $action->pivot->required_count,
                ])
            ),
            'tasks'       => $this->whenLoaded('tasks', fn () =>
                $this->tasks->map(fn ($task) => [
                    'id'            => $task->id,
                    'title'         => $task->title,
                    'description'   => $task->description,
                    'points'        => $task->points,
                    'category'      => $task->category,
                    'modality'      => $task->modality,
                    'requiredCount' => $task->pivot->required_count,
                ])
            ),
            'createdAt'   => $this->created_at?->toIso8601String(),
            'updatedAt'   => $this->updated_at?->toIso8601String(),
            'deletedAt'   => $this->deleted_at?->toIso8601String(),
        ];
    }
}