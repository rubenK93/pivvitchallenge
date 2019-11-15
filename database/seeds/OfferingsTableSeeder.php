<?php

use App\Offering;
use Illuminate\Database\Seeder;

class OfferingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offering::truncate();

        Offering::create([
            'title' => 'Offering #1',
            'price' => 10
        ]);

        Offering::create([
            'title' => 'Offering #2',
            'price' => 20
        ]);

        Offering::create([
            'title' => 'Offering #3',
            'price' => 30
        ]);

        Offering::create([
            'title' => 'Offering #4',
            'price' => 40
        ]);

        Offering::create([
            'title' => 'Offering #5',
            'price' => 50
        ]);
    }
}
