<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
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
            "nim" => (string) $this->nim,
            "mahasiswa_fullname" => $this->mahasiswa_fullname,
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "register_year" => $this->register_year,
            "address" => $this->address,
            "prodi_id" => $this->prodi_id,
            "prodi_model" => $this->mahasiswa_prodi,
            "created_at" => (string) $this->created_at,
            "updated_at" => (string) $this->updated_at,
            "delete_at" => (string) $this->delete_at,
        ];
    }
}
