<?php

namespace App\Http\Controllers;

use App\Models\Anemometro;
use App\Models\Barometro;
use App\Models\Bateria;
use App\Models\Temperatura;
use App\Models\Tower;
use App\Models\Umidade;
use App\Models\Windvane;
use Illuminate\Support\Carbon;
//use Illuminate\Support\Str;

class TowerController extends Controller
{

    // Mostrar informações da torre selecionada
    public function showTowerInfo($tower_id) {
        /* Buscando pelos sensores da torre
           Através do torre_id, mas torre_id não
           Consta no arquivo txt lido */

        $torre = Tower::find($tower_id);

        $sensores = $torre->sensores;

        //$yesterday = date("Y-m-d", strtotime( '-1 days' ) );
        $yesterday = Carbon::createFromDate(2018, 6, 20)->format('Y-m-d'); // usar yesterday fixo para exposicao

        /*$leituras[$sensor->nome]->push(['marca' => 'images/sensors/'.$sensor->marca]);*/

        if (count($sensores) !== 0) {
            foreach ($sensores as $sensor) { /* Percorre a lista de sensores daquela torre
                                                e compara o seu tipo (anemometro, windvane...)*/

                if ($sensor->barometro->first()) {
                    $barometros[$sensor->nome] = Barometro::whereDate('created_at', $yesterday)
                        ->where('sensor_id', $sensor->id)
                        ->where('nome', 'like','%'.'Avg')
                        ->pluck('leitura')
                        ->toArray();
                } elseif ($sensor->anemometro->first()) {
                    $anemometros[$sensor->nome] = Anemometro::whereDate('created_at', $yesterday)
                        ->where('sensor_id', $sensor->id)
                        ->where('nome', 'like','%'.'Avg')
                        ->pluck('leitura')
                        ->toArray();
                } elseif ($sensor->windvane->first()) {
                    $windvanes[$sensor->nome] = Windvane::whereDate('created_at', $yesterday)
                        ->where('sensor_id', $sensor->id)
                        ->where('nome', 'like','%'.'Avg')
                        ->pluck('leitura')
                        ->toArray();
                } elseif ($sensor->temperatura->first()) {
                    $temperaturas[$sensor->nome] = Temperatura::whereDate('created_at', $yesterday)
                        ->where('sensor_id', $sensor->id)
                        ->where('nome', 'like','%'.'Avg')
                        ->pluck('leitura')
                        ->toArray();
                } elseif ($sensor->umidade->first()) {
                    $umidades[$sensor->nome] = Umidade::whereDate('created_at', $yesterday)
                        ->where('sensor_id', $sensor->id)
                        ->where('nome', 'like','%'.'Avg')
                        ->pluck('leitura')
                        ->toArray();
                } elseif ($sensor->bateria->first()) {
                    $baterias[$sensor->nome] = Bateria::whereDate('created_at', $yesterday)
                        ->where('sensor_id', $sensor->id)
                        ->where('nome', 'like','%'.'Avg')
                        ->pluck('leitura')
                        ->toArray();
                }
            }

            /* $filter = $anemometros['AN_120_']->filter(function($value, $key) {
                 if (Str::endsWith($value['nome'], 'Avg')) {
                     return true;
                 }
             });*/

            $barometros = empty($barometros) ? [] : $barometros;
            $anemometros = empty($anemometros) ? [] : $anemometros;
            $windvanes = empty($windvanes) ? [] : $windvanes;
            $temperaturas = empty($temperaturas) ? [] : $temperaturas;
            $umidades = empty($umidades) ? [] : $umidades;
            $baterias = empty($baterias) ? [] : $baterias;

            return view('towerinfo', compact([
                'torre',
                'yesterday',
                'barometros',
                'anemometros',
                'windvanes',
                'temperaturas',
                'umidades',
                'baterias'
            ]));
        }
        return view('towerinfo', compact('torre', 'yesterday'));
    }
}
