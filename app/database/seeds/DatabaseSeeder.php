<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(){
		Eloquent::unguard();
		$this->call('TipousuarioSeeder');
        $this->call('UsuarioSeeder');

        $this->call('SedeSeeder');
        $this->call('CarreraSeeder');
        $this->call('AsignaturaSeeder');
	}
}
