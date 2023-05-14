<!-- Estrutura Modal -->
<div class="modal fade" id="checkout-{{$car->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">CHECKOUT</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('dashboard.checkout', $car->id) }}" method="post">
                    @csrf
                    <!-- Placa -->
                    <div class="textfield">
                        <x-input-label for="placa" value="PLACA" />
                        <x-text-input id="placa" class="form-control" type="text" name="placa" value="{{ $car->placa_veiculo }}" readonly />
                    </div>

                    <!-- Marca - Modelo -->
                    <div class="textfield">
                        <x-input-label for="modelo" value="MODELO" />
                        <x-text-input id="marca" class="form-control" type="text" name="marca" value="{{ $car->marca }} - {{ $car->modelo }}" readonly />
                    </div>

                    <!-- Entrada -->
                    <div class="textfield">
                        <x-input-label class="inputlabel-modal" for="entrada" value="HORA ENTRADA" />
                        <x-text-input id="entrada" class="form-control" type="text" name="entrada" value="{{ $car->dh_registro }}" readonly />
                    </div>

                    <button type="submit" class="btnCheckout">Checkout</button>
                </form>

            </div>
            <!--
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div> -->
        </div>
    </div>
</div>
