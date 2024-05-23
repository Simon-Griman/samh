<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 col col-lg-9 mx-auto">
            <div class="card-body pb-0 w-100">            
                <form wire:submit.prevent="crear">
                    <div class="form-row">
                        <div class="form-group col-12" wire:ignore>
                            <label for="descripcion">Descripción</label>
                            <select name="" id="descripcion" class="form-control select2 @error('descripcion') is-invalid @enderror" wire:model="descripcion">
                                <option value="">-- Seleccionar --</option>
                                @foreach ($articulos as $articulo)
                                <option value="{{ $articulo->id }}">{{ $articulo->nombre }}</option>
                                @endforeach
                            </select>    
                        </div>
                        <div class="form-group" style="margin-top: -15px;">
                            @error('descripcion') <span class="text-red"> {{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="unidad">Tipo de Unidad</label>
                            <select name="" id="unidad" class="form-control @error('unidad') is-invalid @enderror" wire:model="unidad">
                                <option value="">-- Seleccionar --</option>                                
                                <option value="Unidad">Unidad</option>
                                <option value="Caja">Caja</option>
                            </select>
                            @error('unidad') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="text-center col-12">
                            <button class="btn btn-primary m-4" type="submit">Crear</button>
                            <a href="{{ route('almacen.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function(){
            $('.select2').select2();

            $('#descripcion').on('change', function(){
                @this.set('descripcion', this.value);
            });
        });
    </script>

</div>