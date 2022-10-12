<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class OrderImport implements ToModel , WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        // print_r($row);
        // exit;
        return new Order([
            'order_number' => $row[0]
        ]);
    }
}
