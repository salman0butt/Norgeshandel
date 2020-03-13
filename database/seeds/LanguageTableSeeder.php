<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    private $languages = ['Norsk','Svensk','Dansk','Finsk','Engelsk','Tysk','Fransk','Spansk','Italiensk','Portugisisk','Russisk','Japansk','Nederlandsk','Norsk tegnspråk','Britisk tegnspråk','Amerikansk tegnspråk','Albansk','Arabisk','Armensk','Bengali','Bosnisk','Bulgarsk','Burmesisk','Eskimoisk/Inuitisk','Estisk','Filipinsk','Færøysk','Georgisk','Gresk','Grønlandsk','Gælisk','Hebraisk','Hindi','Hviterussisk','Indonesisk','Irsk','Islandsk','Kantonesisk/Yue','Katalansk','Kinesisk','Koreansk','Kroatisk','Kurdisk','Latin','Latvisk','Litauisk','Luxemburgisk','Makedonsk','Mandarin','Mongolsk','Nepalsk','Persiska (Farsi)','Polsk','Rumensk','Samisk','Samoansk','Serbisk','Slovakisk','Slovensk','Somalisk','Swahili','Syrisk/Assyrisk','Tamil','Thai','Tibetansk','Tsjekkisk','Tsjetsjensk','Tyrkisk','Ukrainsk','Ungarsk','Urdu','Vietnamesisk','Walisisk','Zulu','Pashto','Punjabi/Panjabi','Usbekisk'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('languages')->truncate();
        foreach ($this->languages as $language){
            \App\Models\Language::create(['name'=>$language]);
        }
    }
}
