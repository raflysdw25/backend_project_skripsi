<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailAlatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'alat_id'=> $this->alat_id,
            'alat_model'=> $this->alat_model,
            'barcode_alat'=> $this->barcode_alat,
            'condition_status'=> $this->condition_status,
            'available_status'=> $this->available_status,
            'lokasi_id'=> $this->lokasi_id,
            'lokasi_model'=> $this->lokasi_model,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
