<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Resources\RatingResource;
use App\Resources\PositionResource;

class PlayerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'userId'       => $this->user_id,
            'bestSide'     => $this->best_side,
            'type'         => $this->type,
            'positions'    => $this->whenLoaded('positions', fn() => PositionResource::collection($this->positions)),
            'ratings'      => $this->whenLoaded('ratings', fn() => RatingResource::collection($this->ratings)),
            'createdAt'    => $this->created_at?->toIso8601String(),
            'updatedAt'    => $this->updated_at?->toIso8601String(),
            'deletedAt'    => $this->deleted_at?->toIso8601String(),
        ];

        //CRIAR FUNÇÃO DE FORMATAÇÃO DE MAIN POSITION
        //CRIAR FUNÇÃO DE FORMATAÇÃO DE POSITIONS
    }
}