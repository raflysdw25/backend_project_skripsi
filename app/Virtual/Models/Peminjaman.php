<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Peminjaman",
     *      description="Peminjaman Model",
     *      @OA\Xml(
     *          name="Peminjaman" 
     *      )
     * 
     * )
     * 
     */

     class Peminjaman{
         /**
         * @OA\Property(
         *     title="ID",
         *     description="ID",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
        private $id;

        /**
         * @OA\Property(
         *      title="NIM Mahasiswa",
         *      description="NIM Mahasiswa",
         * )
         *
         * @var string
         */
        private $nim_mahasiswa;
        /**
         * @OA\Property(
         *      title="Model Mahasiswa",
         *      description="Model Mahasiswa",
         * )
         *
         * @var App\Virtual\Models\Mahasiswa
         */
        private $mahasiswa_peminjam_model;
        
        /**
         * @OA\Property(
         *      title="NIP Staff",
         *      description="NIP Staff",
         * )
         *
         * @var string
         */
        private $nip_staff;
        /**
         * @OA\Property(
         *      title="Model Staff",
         *      description="Model Staff",
         * )
         *
         * @var App\Virtual\Models\Staff
         */
        private $staff_peminjam_model;
        
        /**
         * @OA\Property(
         *      title="NIP Staff In Charge",
         *      description="NIP Staff In Charge",
         * )
         *
         * @var string
         */
        private $nip_staff_in_charge;
        /**
         * @OA\Property(
         *      title="Model Staff",
         *      description="Model Staff",
         * )
         *
         * @var App\Virtual\Models\Staff
         */
        private $staff_in_charge_model;
        
        /**
         * @OA\Property(
         *      title="Ruangan ID",
         *      description="Ruangan ID",
         * )
         *
         * @var integer
         */
        private $ruangan_id;
        /**
         * @OA\Property(
         *      title="Model Ruangan",
         *      description="Model Ruangan",
         * )
         *
         * @var App\Virtual\Models\Ruangan
         */
        private $ruangan_model;

        /**
         * @OA\Property(
         *      title="Tipe Peminjaman",
         *      description="Tipe Peminjaman",
         * )
         *
         * @var string
         */
        private $pjm_type;
        
        /**
         * @OA\Property(
         *      title="Status Peminjaman",
         *      description="Status Peminjaman",
         * )
         *
         * @var integer
         */
        private $pjm_status;

        /**
         * @OA\Property(
         *      title="Tujuan Peminjaman",
         *      description="Tujuan Peminjaman",
         * )
         *
         * @var string
         */
        private $pjm_purpose;
        
        /**
         * @OA\Property(
         *      title="Catatan Peminjaman",
         *      description="Catatan Peminjaman",
         * )
         *
         * @var string
         */
        private $pjm_notes;


        /**
         * @OA\Property(
         *      title="Expected Return Date",
         *      description="Perkiraan Tanggal Pengembalian",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $expected_return_date;
        
        /**
         * @OA\Property(
         *      title="Real Return Date",
         *      description="Tanggal Pengembalian Sebenarnya",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $real_return_date;
        
        /**
         * @OA\Property(
         *      title="Created Date",
         *      description="Date of data been created",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $created_at;


        /**
         * @OA\Property(
         *     title="Updated at",
         *     description="Updated at",
         *     example="2020-01-27 17:50:45",
         *     format="datetime",
         *     type="string"
         * )
         *
         * @var \DateTime
         */
        private $updated_at;
       
        /**
         * @OA\Property(
         *     title="Deleted at",
         *     description="Deleted at",
         *     example="2020-01-27 17:50:45",
         *     format="datetime",
         *     type="string"
         * )
         *
         * @var \DateTime
         */
        private $deleted_at;
     }


?>