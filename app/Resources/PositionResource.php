<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'alias'     => $this->alias,
            'modality'  => $this->modality,
            'main'      => $this->pivot ? (bool) $this->pivot->main : false,
            'createdAt' => $this->created_at?->toIso8601String(),
            'updatedAt' => $this->updated_at?->toIso8601String(),
            'deletedAt' => $this->deleted_at?->toIso8601String(),
        ];

        //CRIAR FUNÇÃO DE FORMATAÇÃO DE MAIN POSITION
        //CRIAR FUNÇÃO DE FORMATAÇÃO DE POSITIONS
    }
}