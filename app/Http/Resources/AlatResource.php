<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlatResource extends JsonResource
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
            'alat_name'=> $this->alat_name,
            'jenis_alat_id'=> $this->jenis_alat_id,
            'jenis_alat_model'=> $this->jenis_alat_model,
            'alat_specs'=> $this->alat_specs,
            'asal_pengadaan_id'=> $this->asal_pengadaan_id,
            'asal_pengadaan_model'=> $this->asal_pengadaan_model,
            'alat_year'=> $this->alat_year,
            'supplier_id'=> $this->supplier_id,
            'supplier_model'=> $this->supplier_model,
            'alat_total'=> $this->alat_total,
            'details' => $this->details,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
