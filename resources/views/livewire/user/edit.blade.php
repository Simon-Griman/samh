<div>
    <form wire:submit.prevent="editar" class="mb-0 pl-0">
        <h5>Actualizar Contraseña</h5>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password">
        @error('password') <span class="text-red">{{ $message }}</span> @enderror

        <h5 class="mt-2">Confirmar Contraseña</h5>
        <input type="password" class="form-control @error('confirPass') is-invalid @enderror" id="confirpass" wire:model="confirPass">
        @error('confirPass') <span class="text-red">{{ $message }}</span> @enderror

        <div class="mt-4 mb-4">
            <button class="btn btn-primary" type="submit">Actualizar Contraseña</button>
        </div>
    </form>
    <hr>
</div>
