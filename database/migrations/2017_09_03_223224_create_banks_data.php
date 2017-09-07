<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\UploadedFile;
use CodeFin\Repositories\BankRepository;
use CodeFin\Models\Bank;


class CreateBanksData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
       /** @var codeFin\Repositories\BankRepository $repository */
        $repository = app(BankRepository::class); //helper app, para passar o serviço que o laravel gere
        foreach ($this->getData() as $bankArray) {
            $repository->create($bankArray);
            sleep(1); // faz com que o feech espera um segundo ate ao proximo registo
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        $repository = app(BankRepository::class);
        $repository->skipPresenter(true);
        $count = count($this->getData());

        foreach (range(1, $count) as $value) {
            $model  = $repository->find($value);
            $path   = Bank::logosDir(). '/' . $model->logo;
            \Storage::disk('public')->delete($path);
            $model->delete();
        }
    }

    public function getData()
    {
        return [
            [
                'name' => 'Novo Banco',
                'logo' => new UploadedFile(
                    storage_path('app/files/banks/logos/novobanco.jpg'),
                    'novobanco.jpg'
                )
            ],
            [
                'name' => 'Banco Popular',
                'logo' => new UploadedFile(
                    storage_path('app/files/banks/logos/popular.jpg'),
                    'popular.jpg'
                )
            ],
            [
                'name' => 'Santander',
                'logo' => new UploadedFile(
                    storage_path('app/files/banks/logos/santander.png'),
                    'santander.png'
                )
            ],
        ];
    }
}
