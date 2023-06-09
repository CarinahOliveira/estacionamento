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


    <div class="card-checkout">
        <form action="{{ route('dashboard.checkout', $car[0]->id) }}" method="post">
            @csrf
            <!-- Placa -->
            <div class="textfield-checkout">
                <x-input-label for="placa" value="PLACA" />
                <x-text-input id="placa" class="form-control" type="text" name="placa" value="{{ $car[0]->placa_veiculo }}" readonly />
            </div>

            <!-- Marca - Modelo -->
            <div class="textfield-checkout">
                <x-input-label for="modelo" value="MODELO" />
                <x-text-input id="marca" class="form-control" type="text" name="marca" value="{{ $car[0]->marca }} - {{ $car[0]->modelo }}" readonly />
            </div>

            <!-- Entrada -->
            <div class="textfield-checkout">
                <x-input-label class="inputlabel-modal" for="entrada" value="HORA ENTRADA" />
                <x-text-input id="entrada" class="form-control" type="text" name="entrada" value="{{ $car[0]->dh_registro }}" readonly />
            </div>

            <!-- Tempo Permanencia -->
            <div class="textfield-checkout">
                <x-input-label class="inputlabel-modal" for="permanencia" value="Permanência" />
                <x-text-input id="permanencia" class="form-control" type="text" name="permanencia" value=" {{ $horas }} " readonly />
            </div>

            <!-- Valor a Cobrar -->
            <div class="textfield-checkout">
                <x-input-label class="inputlabel-modal" for="valorCobrar" value="VALOR A COBRAR" />
                <x-text-input id="valorCobrar" class="form-control" type="text" name="valorCobrar" value="{{ $valor }}" readonly />
            </div>

            <button type="submit" class="btnCheckout">Checkout</button>
        </form>
    </div>

    @include('main')

</x-app-layout>
