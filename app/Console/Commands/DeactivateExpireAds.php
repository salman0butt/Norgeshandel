<?php

namespace App\Console\Commands;

use App\Models\Ad;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class DeactivateExpireAds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactivate:expireAds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate all the ads that has been expired.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now_date = date('Y-m-d');
        $ads = Ad::where('visibility', '=', 1)->whereNull('sold_at')->where('status', 'published')
            ->whereHas('expiry', function (Builder $query) use($now_date) {
            $query->whereDate('date_end','<', $now_date);
            })->get();
            /*
            ->where(function ($query){
                $date = Date('y-m-d',strtotime('-7 days'));
                $query->where('status', 'published')->orwhereDate('sold_at','>',$date);
            })*/


        if($ads->count()){
            foreach ($ads as $ad){
                $ad->status = 'deactivate';
                $ad->update();
            }
            $this->info('Deactivate all the expired ads.Thanks');
        }else{
            $this->info('No ad found.');
        }
    }
}
