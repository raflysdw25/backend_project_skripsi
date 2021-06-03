<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            "nip" => (string) $this->nip,
            "staff_fullname" => $this->staff_fullname,
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "address" => $this->address,
            "prodi_id" => $this->prodi_id,
            "prodi_model" => $this->staff_prodi,
            "created_at" => (string) $this->created_at,
            "updated_at" => (string) $this->updated_at,
            "delete_at" => $this->delete_at,
        ];
    }
}
