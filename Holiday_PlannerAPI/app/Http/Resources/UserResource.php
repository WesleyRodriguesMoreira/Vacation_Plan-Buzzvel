<?php

namespace App\Http\Resources;use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /** @var function toArray Retorna um arry de informações pré-definidas e estilizadas */
    public function toArray(Request $request): array{
        return [
            'idUser' => $this->id,
            'nameUser' => $this->name,
            'emailUser' => $this->email,
            'created_atUser' => \Carbon\Carbon::parse($this->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s'),
            'updated_atUser' => \Carbon\Carbon::parse($this->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s'),
        ];
    }
}
