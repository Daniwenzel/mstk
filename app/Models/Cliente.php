<?php

namespace Messtechnik\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $connection = 'mysql';

    protected $table = 'CLIENTE';

    protected $primaryKey = 'codigo';

    protected $fillable = ['codigo', 'razaosocial', 'endereco'];

    public function users() {
        return $this->hasMany('Messtechnik\User', 'clicodigo', 'codigo');
    }

   public function torres() {
       return $this->hasMany('Messtechnik\Models\Site', 'clicodigo', 'codigo');
   }
}
