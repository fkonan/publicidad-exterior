<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class PgirhExports implements FromView, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $data;
    public $empresa;
    public $nit;
    public $gestor;
    public $sede;
        
    public function __construct($data)
    {
        $this->data = $data; // errro en en linea
        
    }
    public function collection()
    {
        //
    }

    public function view(): View
    {
        return view('exports.pgirh-export', [
            'data' => $this->data
        ]);
    }

    public function title(): string
    {
        return 'Reporte PGIRH';
    }
}
