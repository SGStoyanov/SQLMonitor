<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'zabbix_tables';

    protected $fillable = [
        //'id',
        'table_name',
        'size',
        'collected_on'
    ];
}
