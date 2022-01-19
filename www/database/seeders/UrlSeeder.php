<?php

namespace Database\Seeders;

use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Seeder;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $urls = Url::factory()->times(50)->create();
    }
}
