<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = ['tahun', 'hscode', 'nama_item','kode_negara', 'nama_negara', 'kode_pelabuhan', 'nama_pelabuhan', 'berat_bersih', 'nilai'
    ];
}
