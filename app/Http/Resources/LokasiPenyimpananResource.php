<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LokasiPenyimpananResource extends JsonResource
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
            'lokasi_name'=> $this->lokasi_name,
            'total_capacity'=> $this->total_capacity,
            'available_capacity'=> $this->available_capacity,
            'stored_capacity'=> $this->stored_capacity,
            'path_qrcode'=> $this->path_qrcode,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
