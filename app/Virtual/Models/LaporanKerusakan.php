<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="LaporanKerusakan",
     *      description="LaporanKerusakan Model",
     *      @OA\Xml(
     *          name="LaporanKerusakan" 
     *      )
     * 
     * )
     * 
     */

     class LaporanKerusakan{
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
         *      description="NIM of the Mahasiswa",
         * )
         *
         * @var string
         */
        private $nim_mahasiswa;
        
        /**
         * @OA\Property(
         *      title="Mahasiswa Lapor Model",
         *      description="Model of Mahasiswa",
         * )
         *
         * @var App\Virtual\Models\Mahasiswa
         */
        private $mahasiswa_lapor_model;
        
        /**
         * @OA\Property(
         *      title="NIP Mahasiswa",
         *      description="NIP of the Staff",
         * )
         *
         * @var string
         */
        private $nip_staff;
        
        /**
         * @OA\Property(
         *      title="Staff Lapor Model",
         *      description="Model of Staff",
         * )
         *
         * @var App\Virtual\Models\Staff
         */
        private $staff_lapor_model;

        /**
         * @OA\Property(
         *      title="Barcode Alat",
         *      description="Barcode Alat",
         * )
         *
         * @var string
         */
        private $barcode_alat;
        
        /**
         * @OA\Property(
         *      title="Kronologi",
         *      description="Kronologi",
         * )
         *
         * @var string
         */
        private $chronology;
        
        /**
         * @OA\Property(
         *      title="Report Status",
         *      description="Report Status",
         * )
         *
         * @var integer
         */
        private $report_status;

        /**
         * @OA\Property(
         *      title="Report Notes",
         *      description="Report Notes",
         * )
         *
         * @var string
         */
        private $report_notes;
        
        
        /**
         * @OA\Property(
         *      title="Report Date",
         *      description="Date of report been created",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $report_date;
        
        /**
         * @OA\Property(
         *      title="Report Action",
         *      description="Action Date of report been created",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $report_action;

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