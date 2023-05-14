<x-app-layout>
    <!--  Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css">

    <!-- JAVASCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="{{ asset('js/dashboard.js') }}"></script>

    <script src="https://kit.fontawesome.com/68d770198c.js" crossorigin="anonymous"></script>

    <x-slot name="header">
        <h2 class="header-dashboard">
            {{ __('Lets Park') }}
        </h2>
    </x-slot>

    <div class="card">
        <p><span>Vagas: {{ $vagasTotal->count() }}</span></p>
        <p><span>Livre: {{ $vagasLivre->count() }}</span></p>
        <p><span>Ocupado: {{ $vagasOcupado->count() }}</span></p>
    </div>
    <div>


        <!-- Form Checking -->
        <form action="{{ route('checkin-create') }}" method="post">
            @csrf

            <div class="card-estacionamento">

                <div class="checking-car">
                    <!-- Placa -->
                    <div class="textfield">
                        <x-text-input id="placa" class="form-control" type="text" placeholder="PLACA" name="placa" required autofocus autocomplete="placa" />
                    </div>

                    <!-- Marca -->
                    <div class="textfield">
                        <x-text-input id="marca" class="form-control" type="text" placeholder="MARCA" name="marca" required autofocus autocomplete="marca" />
                    </div>

                    <!-- Modelo -->
                    <div class="textfield">
                        <x-text-input id="modelo" class="form-control" type="text" placeholder="MODELO" name="modelo" required autofocus autocomplete="modelo" />
                    </div>

                    <!-- Cor -->
                    <div class="textfield">
                        <x-text-input id="cor" class="form-control" type="text" placeholder="COR" name="cor" required autofocus autocomplete="cor" />
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
                        @foreach($vagasLivre as $vaga)
                            <option value="{{ $vaga->num_vaga }}">{{ $vaga->num_vaga }}</option>
                        @endforeach
                    </select>

                    <!-- Button Checking -->
                    <button type="submit" class="btn-checking">Enviar</button>
                </div>
            </div>
        </form>

        <!-- Barra de Pesquisa - Pesquisar Carro por Placa -->
        <div class="searchCar">
            <form action="{{ route('dashboard') }}" method="GET">
                <x-text-input id="searchCar" class="form-control-search" type="text" placeholder="Pesquisar Placa" name="searchCar"/>
                <button class="btnSearchBar" type="submit">Search</button>
            </form>
        </div>


        <!-- Table list carr status == checking -->
        <div class="table-cars" id="tableCars">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Entrada</th>
                        <th scope="col">Placa</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Patio</th>
                        <th scope="col">Vaga</th>
                        <th scope="col">Checkout</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td data-label="ENTRADA">{{ $car->dh_registro }}</td>
                        <td data-label="PLACA">{{ $car->placa_veiculo }}</td>
                        <td data-label="MODELO">{{ $car->marca }} - {{ $car->modelo }} - {{ $car->cor }}</td>
                        <td data-label="PATIO">{{ $car->id_patio }}</td>
                        <td data-label="VAGA">{{ $car->num_vaga }}</td>
                        <td data-label="CHECKOUT">
                            <a href="#checkout-{{$car->id}}" data-bs-toggle="modal" data-bs-target="#checkout-{{$car->id}}">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                        </td>
                        @include('checkout')
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>



    </div>

    @include('main')

</x-app-layout>


