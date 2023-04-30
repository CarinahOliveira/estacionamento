<x-app-layout>
    <!-- Styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css">

    <x-slot name="header">
        <h2 class="header-dashboard">
            {{ __('Lets Park') }}
        </h2>
    </x-slot>

    <div>

        <form action="{{ route('checkin-create') }}" method="post">
            @csrf

            <div class="card-estacionamento">

                <div class="checking-car">
                    <!-- Placa -->
                    <div class="textfield">
                        <x-text-input id="placa" class="form-control" type="text" placeholder="PLACA" name="placa" required autofocus autocomplete="placa" />
                    </div>

                    <!-- Patio -->
                    <select class="form-control" id="patio" name="patio" required autofocus autocomplete="patio">
                        <option selected>Selecione o Patio</option>
                        @foreach($patios as $patio)
                            <option v-text="{{ $patio->id }}">{{ $patio->id }}</option>
                        @endforeach
                    </select>

                    <!-- Vaga -->
                    <select class="form-control" id="vaga" name="vaga" required autofocus autocomplete="vaga">
                        <option selected>Selecione a Vaga</option>
                        @foreach($vagas as $vaga)
                            <option value="{{ $vaga->num_vaga }}">{{ $vaga->num_vaga }}</option>
                        @endforeach
                    </select>

                    <!-- Button Checking -->
                    <button type="submit" class="btn-checking">Enviar</button>
                </div>
            </div>
        </form>

        <div class="table-cars">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Entrada</th>
                        <th scope="col">Placa</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Patio</th>
                        <th scope="col">Vaga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $car)
                        <tr>
                            <td data-label="ENTRADA">{{ $car->dh_registro }}</td>
                            <td data-label="PLACA">{{ $car->placa_veiculo }}</td>
                            <td data-label="MODELO">Renegade - Prata (A implementar)</td>
                            <td data-label="PATIO">{{ $car->id_patio }}</td>
                            <td data-label="VAGA">{{ $car->num_vaga }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

</x-app-layout>

