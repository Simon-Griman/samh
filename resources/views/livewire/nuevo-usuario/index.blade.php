<div class="container">
    <div class="row d-flex justify-content-center">
        <h2 class="col-lg-12 text-center">Bienvenido {{ $myuser }}</h2>
        <p class="col-lg-12 text-center">Antes de comenzar, por tú seguridad actualiza la contraseña</p>
        <div class="card col col-lg-6 mx-auto">
            <div class="card-body">
                <form wire:submit.prevent="editar" class="mb-0 pl-0">
                    <h5>Actualizar Contraseña</h5>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password">
                    @error('password') <span class="text-red">{{ $message }}</span> @enderror

                    <h5 class="mt-2">Confirmar Contraseña</h5>
                    <input type="password" class="form-control @error('confirPass') is-invalid @enderror" id="confirpass" wire:model="confirPass">
                    @error('confirPass') <span class="text-red">{{ $message }}</span> @enderror

                    <div class="mt-4 mb-4 text-center">
                        <button class="btn btn-primary" type="submit">Actualizar Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>