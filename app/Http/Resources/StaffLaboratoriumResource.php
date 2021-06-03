<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffLaboratoriumResource extends JsonResource
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
            'nip'=> (string) $this->nip,
            'staff_model' => $this->staff_user,
            'active_period' => (string) $this->start_active_period,
            'expire_period' => (string) $this->end_active_period,
            'jabatan_id' => $this->jabatan_id,
            'jabatan_model' => $this->jabatan_user,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
