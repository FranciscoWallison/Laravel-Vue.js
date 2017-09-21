<?php

use Illuminate\Database\Seeder;
use SisFin\Repositories\ClientRepository;
use SisFin\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $repository = app(ClientRepository::class);
        $clients = $repository->all(); // criar o objeto com todos os clientes

        factory(User::class, 1)
        	->states('admin')
        	->create([
        		'name' => 'Francisco Wallison',
        		'email' => 'admin@user.com'
            ]);
            
        foreach (range(1, 50) as $value){  // foreach para criar 50 utilizadores
            
            factory(User::class, 1)
                ->create([
                    'name' => "Cliente $value",
                    'email' => "cliente$value@user.com"

                ])->each(function($user) use($clients) {
                    $client = $clients->random();
                    $user->client()->associate($client);
                    $user->save();
                });
        }
    }
}
