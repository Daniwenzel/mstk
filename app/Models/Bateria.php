<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bateria extends Model
{
    protected $table = 'baterias';

    protected $fillable = [
        'nome', 'leitura', 'sensor_id', 'created_at', 'updated_at'
    ];

    public function sensor() {
        return $this->belongsTo('App\Models\Sensor', 'sensor_id', 'id');
    }
}