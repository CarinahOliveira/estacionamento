<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Checkinout;
use App\Models\Veiculo;
use App\Models\Patio;
use App\Models\Vaga;
use App\Models\Fabricante;

use Illuminate\Http\Request;
use function Pest\Laravel\json;
use function PHPUnit\Framework\isEmpty;

class CheckinOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        $patios = Patio::all();
        $vagasTotal = Vaga::get();
        $vagasLivre = Vaga::where('status', '=', 0)->get();
        $vagasOcupado = Vaga::where('status', '=', 1)->get();
        $fabricante = Fabricante::all();

        $cars = $this->searchCar($request);

        return view('dashboard', compact('patios', 'vagasLivre', 'vagasTotal', 'vagasOcupado', 'cars', 'fabricante'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function validCheckin(Request $request){
        $veiculo = Veiculo::where('placa_veiculo', '=', $request->placa)->first();

        if (!is_null($veiculo)){
            $this->ocupaVaga($request);
            $this->saveCheckin($request, $veiculo);

            return redirect('/dashboard');

        }else {
            $newVeiculo = $this->createVeiculo($request);
            $this->ocupaVaga($request);
            $this->saveCheckin($request, $newVeiculo);

            return redirect('/dashboard');
        }
    }

    /** Save Checkin */
    public function saveCheckin(Request $request, $veiculo){
        $checkin = new Checkinout;

        $checkin->num_vaga = $request->vaga;
        $checkin->id_patio = $request->patio;
        $checkin->id_veiculo = $veiculo->id;
        $checkin->status = 1;
        $checkin->id_usuario = Auth::id();
        $checkin->dh_registro = now();

        $checkin->save();
    }

    /** Create Veiculo */
    public function createVeiculo(Request $request){
        $veiculo = new Veiculo;

        $veiculo->placa_veiculo = $request->placa;
        $veiculo->marca = $request->marca;
        $veiculo->modelo = $request->modelo;
        $veiculo->cor = $request->cor;
        $veiculo->save();

        return $veiculo;
    }

    /** Ocupa Vaga */
    public function ocupaVaga(Request $request){
        $vaga = Vaga::where('num_vaga', '=', $request->vaga)->update([
            'status' => 1
        ]);
    }

    /**
     * Barra de Pesquisa - Busca o carro na lista de checkin
     */
    public function searchCar(Request $request){
        $search = $request->searchCar;

        if ($search){
            $cars = DB::table('veiculos')
                ->join('checkin_outs', 'veiculos.id', '=', 'checkin_outs.id_veiculo')
                ->select('checkin_outs.*', 'veiculos.placa_veiculo', 'veiculos.marca', 'veiculos.modelo', 'veiculos.cor')
                ->where('veiculos.placa_veiculo', 'like', '%'.$search.'%')
                ->where('checkin_outs.status', '=', 1)
                ->get();
        } else {
            $cars = DB::table('veiculos')
                ->join('checkin_outs', 'veiculos.id', '=', 'checkin_outs.id_veiculo')
                ->select('checkin_outs.*', 'veiculos.placa_veiculo', 'veiculos.marca', 'veiculos.modelo', 'veiculos.cor')
                ->where('checkin_outs.status', '=', 1)
                ->get();
        }
        return $cars;
    }

    /** Desocupa Vaga */
    public function  desocupaVaga($checkout){
        $desocupaVaga = Vaga::where('num_vaga', '=', $checkout)->update([
            'status' => 0
        ]);;
    }

    /**
     * Realiza Checkout -> alterar status = 0
     */
    public function realizaCheckout($id){
        $checkout = Checkinout::find($id);

        if($checkout && $checkout->exists){
            $this->desocupaVaga($checkout->num_vaga);

            $checkout->status = 0;
            $checkout->save();

            return redirect('/dashboard');
        }
    }

    /**
     * Calculo Checkout
     */
    public  function calculoCheckout(Request $request, $id){
        $tempo = Checkinout::where('id', '=', $id)->get('dh_registro')[0]->dh_registro;
        $tempo = now()->diffInMinutes($tempo);

        $hora = floor($tempo/60);
        $resto = $tempo%60;
        $horas = $hora.':'.$resto;

        $tempo2 = ceil(($tempo/60));

        if($tempo2 <= 1){
            $valor = 1;
            $valor = "R$".$valor.",00";
        } else if ( $tempo2 > 1 ) {
            $valor = 2 * $tempo2;
            $valor = "R$".$valor.",00";
        }

        $car = DB::table('veiculos')
            ->join('checkin_outs', 'veiculos.id', '=', 'checkin_outs.id_veiculo')
            ->select('checkin_outs.*', 'veiculos.placa_veiculo', 'veiculos.marca', 'veiculos.modelo', 'veiculos.cor')
            ->where('checkin_outs.id', '=', $id)
            ->get();

        $id_veiculo = Veiculo::where('id', '=', $car[0]->id_veiculo)->get('id');
        $this->createRecibo($horas, $valor, $id_veiculo[0]->id);

        return view('checkout', compact('valor', 'tempo2', 'car', 'horas'));
    }

    /**
     * @return Recibo
     */
    public function createRecibo($tempo, $valor, $id){
        $recibo = new Recibo;

        $recibo->id_veiculo = $id;
        $recibo->dh_recibo = now();
        $recibo->tempo_permanencia = $tempo;
        $recibo->valor = $valor;
        $recibo->id_usuario = Auth::id();

        $recibo->save();
    }
}
