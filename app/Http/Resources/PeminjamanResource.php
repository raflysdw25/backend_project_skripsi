<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeminjamanResource extends JsonResource
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
            'nim_mahasiswa'=> $this->nim_mahasiswa,
            'mahasiswa_peminjam_model'=> $this->mahasiswa_peminjam_model,
            'nip_staff'=> $this->nip_staff,
            'staff_peminjam_model'=> $this->staff_peminjam_model,
            'nip_staff_in_charge'=> $this->nip_staff_in_charge,
            'staff_in_charge_model'=> $this->staff_in_charge_model,
            'ruangan_id'=> $this->ruangan_id,
            'ruangan_model'=> $this->ruangan_model,
            'pjm_type'=> $this->pjm_type,
            'pjm_status'=> $this->pjm_status,
            'pjm_purpose'=> $this->pjm_purpose,
            'pjm_notes'=> $this->pjm_notes,
            'detail_peminjaman_model' => $this->detail_peminjaman_model,
            'expected_return_date'=> (string) $this->expected_return_date,
            'real_return_date'=> (string) $this->real_return_date,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
