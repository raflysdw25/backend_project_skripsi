<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LaporanKerusakanResource extends JsonResource
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
            'barcode_alat' => $this->barcode_alat,
            'barcode_alat_rusak' => $this->barcode_alat_rusak,
            'chronology' => $this->chronology,
            'nim_mahasiswa' => $this->nim_mahasiswa,
            'mahasiswa_lapor_model' => $this->mahasiswa_lapor_model,
            'nip_staff' => $this->nip_staff,
            'staff_lapor_model' => $this->staff_lapor_model,
            'report_status'=> $this->report_status,
            'report_notes'=> $this->report_notes,
            'report_date'=> (string) $this->report_date,
            'report_action'=> (string) $this->report_action,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
