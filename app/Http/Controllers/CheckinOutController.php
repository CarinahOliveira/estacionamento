<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Checkinout;
use App\Models\Veiculo;
use App\Models\Patio;
use App\Models\Vaga;

use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class CheckinOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $patios = Patio::all();
        $vagas = Vaga::where('status', '=', 0)->get();

        $cars = DB::table('veiculos')
            ->join('checkin_outs', 'veiculos.id', '=', 'checkin_outs.id_veiculo')
            ->select('checkin_outs.*', 'veiculos.placa_veiculo')
            ->get();

        return view('dashboard', compact('patios', 'vagas', 'cars'));
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


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
