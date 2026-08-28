<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Resources\UserResource;

class ParticipantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'eventId'     => $this->event_id,
            'role'        => $this->role ?? [],
            'permissions' => $this->permissions ?? [],
            'status'      => $this->status,
            'user'        => $this->whenLoaded('user', fn() => UserResource::make($this->user)),
            'createdAt'   => $this->created_at?->toIso8601String(),
            'updatedAt'   => $this->updated_at?->toIso8601String(),
            'deletedAt'   => $this->deleted_at?->toIso8601String(),
        ];
    }
}