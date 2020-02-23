<?php

use Illuminate\Database\Seeder;
use App\Modulo;
class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('modulos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Modulo::create([
            'nombre'=>'DWESE',
            'horas'=>'8'
        ]);

        Modulo::create([
            'nombre'=>'DWEC',
            'horas'=>'6'
        ]);

        Modulo::create([
            'nombre'=>'DAWEB',
            'horas'=>'3'
        ]);

        Modulo::create([
            'nombre'=>'DIW',
            'horas'=>'6'
        ]);

        Modulo::create([
            'nombre'=>'HLC',
            'horas'=>'3'
        ]);

        Modulo::create([
            'nombre'=>'EIM',
            'horas'=>'4'
        ]);
    }
}
