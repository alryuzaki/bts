<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Checklist;

class ChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Checklist::factory(10)->create();
    }
}
