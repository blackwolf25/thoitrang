<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_name' => $row[0], 
            'product_tags' => $row[1],
            'product_quantity' => $row[2],
            'product_sold' => $row[3],
            'product_slug' => $row[4],
            'category_id' => $row[5],
            'brand_id' => $row[6],
            'product_desc' => $row[7],
            'product_content' => $row[8],
            'product_price' => $row[9],
            'product_si' => $row[10],
            'product_nhap' => $row[11],
            'product_image' => $row[12],
            'product_status' => $row[13],
            'product_noibat' => $row[14],
            'product_file' => $row[15],
            'created_at' => $row[16],
            'updated_at' => $row[17],
            'product_exp' => $row[18],
            'product_mfg' => $row[19],
        ]);
    }
}
