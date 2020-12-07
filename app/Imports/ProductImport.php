<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name'                  => $row['name'],
            'details'               => $row['details'],
            'cost_price'            => $row['cost_price'], 
            'mrp'                   => $row['mrp'],
            'minimum_retail_price'  => $row['minimum_retail_price'],
            'unit'                  => $row['unit'],
            'opening_stock'         => $row['opening_stock'],

        ]);
    }
}
