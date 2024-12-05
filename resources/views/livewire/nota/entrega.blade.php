<div class="container">
    <div class="row d-flex justify-content-center">
        <h2 class="col-lg-12 text-center">Notas de Entrega</h2>
        <div class="card col col-lg-6 mx-auto">
            <div class="card-body">
                <form wire:submit.prevent="enviar" class="mb-0 pl-0">
                    

                    <div wire:ignore>
                        <h5>Seleccionar Usuario</h5>
                        <select class="form-control select2 @error('usuario') is-invalid @enderror" id="sel3">
                            <option value="">Todo</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        @error('usuario') <span class="error text-red">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <h5>Seleccionar los Bienes</h5>

                        @foreach ($bienes as $item)
                            @if ($usuario != '')
                                @foreach ($equipos_user as $equipos)
                                    @if ($equipos->id_tipo == $item->id)
                                        @php $match = true @endphp
                                    @endif
                                @endforeach
                                <div wire:ignore>
                                    @if ($match)
                                        <input type="checkbox" id="{{ $item->nombre }}" wire:model="box.option{{ $num1++ }}" value="{{ $item->id }}">
                                        <label for="{{ $item->nombre }}">{{ $item->nombre }}</label>
                                        <br>
                                        @php $match = false @endphp
                                    @endif
                                </div>
                            @endif
                        @endforeach
                        <div>
                            @error('box') <span class="error text-red">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <br>
                    <div class="">
                        <h5>Observaciones</h5>

                        <input type="text" class="form-control" wire:model="observacion">
                    </div>

                    <div class="mt-4 text-center">
                        <button class="btn btn-primary" type="submit">Generar Nota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ url('js/jquery.js') }}"></script>
    
    <script>
        document.addEventListener('livewire:load', function(){
            $('.select2').select2();

            $('#sel1').on('change', function(){
                @this.set('departamento', this.value);
            });

            $('#sel2').on('change', function(){
                @this.set('ubica', this.value);
            });

            $('#sel3').on('change', function(){
                @this.set('usuario', this.value);
            });
        });
    </script>
</div>