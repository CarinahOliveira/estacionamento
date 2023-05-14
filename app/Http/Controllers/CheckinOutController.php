<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Checkinout;
use App\Models\Veiculo;
use App\Models\Patio;
use App\Models\Vaga;

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

        return view('dashboard', compact('patios', 'vagasLivre', 'vagasTotal', 'vagasOcupado', 'cars', 'search'));
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

    /** Save Checkin */
    public function saveCheckin(Request $request, $veiculo){
        $checkin = new Checkinout;

        $checkin->num_vaga = $request->vaga;
        $checkin->id_patio = $request->patio;
        $checkin->id_veiculo = $veiculo->id;
        $checkin->status = 1;
        $checkin->id_usuario = 1;
        $checkin->dh_registro = now();

        $checkin->save();
    }

    /** Ocupa Vaga */
    public function ocupaVaga(Request $request){
        $vaga = Vaga::where('num_vaga', '=', $request->vaga)->update([
            'status' => 1
        ]);
    }

    /** Desocupa Vaga */
    public function  desocupaVaga($checkout){
        $desocupaVaga = Vaga::where('num_vaga', '=', $checkout)->update([
            'status' => 0
        ]);;
    }

    /** Realiza Checkout -> alterar status = 0 */
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
     * Store a newly created resource in storage.
     */
    public function searchCar(Request $request, $cars)
    {
        $search = $request->searchCar;

        if ($search){
            $cars = DB::table('veiculos')
                ->join('checkin_outs', 'veiculos.id', '=', 'checkin_outs.id_veiculo')
                ->select('checkin_outs.*', 'veiculos.placa_veiculo', 'veiculos.modelo', 'veiculos.cor')
                ->where('checkin_outs.status', '=', 1)
                ->orWhere('veiculos.placa_veiculo', 'like', '%'.$search.'%')
                ->get();
        } else {
            $cars = DB::table('veiculos')
                ->join('checkin_outs', 'veiculos.id', '=', 'checkin_outs.id_veiculo')
                ->select('checkin_outs.*', 'veiculos.placa_veiculo', 'veiculos.modelo', 'veiculos.cor')
                ->where('checkin_outs.status', '=', 1)
                ->get();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
