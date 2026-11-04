<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Officer;
use Illuminate\Database\Seeder;

class OfficerSeeder extends Seeder
{
    public function run(): void
    {
        $it      = Department::where('name', 'IT')->first();
        $hr      = Department::where('name', 'HR')->first();
        $finance = Department::where('name', 'Finance')->first();

        $officers = [
            ['name' => 'Sok Dara',       'phone' => '012345678', 'dept_id' => $it->dept_id],
            ['name' => 'Chan Sreyneang', 'phone' => '098765432', 'dept_id' => $hr->dept_id],
            ['name' => 'Vann Pich',      'phone' => '077112233', 'dept_id' => $finance->dept_id],
        ];

        foreach ($officers as $o) {
            Officer::firstOrCreate(['name' => $o['name']], $o);
        }
    }
}