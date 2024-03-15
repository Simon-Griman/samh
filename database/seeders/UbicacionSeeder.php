<?php

namespace Database\Seeders;

use App\Models\Ubicacion;
use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ubicacion::create(['nombre' => 'Caracas']);
        Ubicacion::create(['nombre' => 'El Palito']);
        Ubicacion::create(['nombre' => 'Maracaibo']);
        Ubicacion::create(['nombre' => 'Maturín']);
        Ubicacion::create(['nombre' => 'El Vigía']);
        Ubicacion::create(['nombre' => 'Catia la Mar']);
        Ubicacion::create(['nombre' => 'Guaraguao']);
        Ubicacion::create(['nombre' => 'Amuay']);
        Ubicacion::create(['nombre' => 'Bajo Grande']);
        Ubicacion::create(['nombre' => 'Cardón']);
        Ubicacion::create(['nombre' => 'La Salina']);
        Ubicacion::create(['nombre' => 'Puerto Miranda']);
        Ubicacion::create(['nombre' => 'Cijaa']);
        Ubicacion::create(['nombre' => 'EL Guamache']);
        Ubicacion::create(['nombre' => 'Cabimas']);
        Ubicacion::create(['nombre' => 'Barinas']);
        Ubicacion::create(['nombre' => 'Maporal']);
        Ubicacion::create(['nombre' => 'Cumaná']);
        Ubicacion::create(['nombre' => 'San Lorenzo']);
        Ubicacion::create(['nombre' => 'Cardon']);
        Ubicacion::create(['nombre' => 'Carenero']);
        Ubicacion::create(['nombre' => 'ULE']);
        Ubicacion::create(['nombre' => 'San Tomé']);
        Ubicacion::create(['nombre' => 'Ciudad Bolívar']);
        Ubicacion::create(['nombre' => 'Puerto Ordaz']);
        Ubicacion::create(['nombre' => 'Yagua']);
        Ubicacion::create(['nombre' => 'Guatire']);
    }
}
