<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $languages = ['Norsk','Svensk','Dansk','Finsk','Engelsk','Tysk','Fransk','Spansk','Italiensk','Portugisisk','Russisk','Japansk','Nederlandsk','Norsk tegnspråk','Britisk tegnspråk','Amerikansk tegnspråk','Albansk','Arabisk','Armensk','Bengali','Bosnisk','Bulgarsk','Burmesisk','Eskimoisk/Inuitisk','Estisk','Filipinsk','Færøysk','Georgisk','Gresk','Grønlandsk','Gælisk','Hebraisk','Hindi','Hviterussisk','Indonesisk','Irsk','Islandsk','Kantonesisk/Yue','Katalansk','Kinesisk','Koreansk','Kroatisk','Kurdisk','Latin','Latvisk','Litauisk','Luxemburgisk','Makedonsk','Mandarin','Mongolsk','Nepalsk','Persiska (Farsi)','Polsk','Rumensk','Samisk','Samoansk','Serbisk','Slovakisk','Slovensk','Somalisk','Swahili','Syrisk/Assyrisk','Tamil','Thai','Tibetansk','Tsjekkisk','Tsjetsjensk','Tyrkisk','Ukrainsk','Ungarsk','Urdu','Vietnamesisk','Walisisk','Zulu','Pashto','Punjabi/Panjabi','Usbekisk'];
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
        foreach ($this->languages as $language){
            \App\Models\Language::create(['name'=>$language]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
