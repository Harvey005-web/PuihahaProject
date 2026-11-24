<?php

namespace Database\Seeders;

use App\Models\{MembershipCategory,MembershipLevel,User};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(['email' => 'admin@memberflow.test'], ['name' => 'System Administrator', 'password' => 'password']);
        foreach (['Student','Regular','Senior Citizen','Corporate'] as $name) MembershipCategory::firstOrCreate(['name'=>$name], ['is_active'=>true]);
        foreach ([['Basic',500,12,'Standard member privileges'],['Silver',1000,12,'Priority updates and standard privileges'],['Gold',2000,12,'Premium benefits and event discounts'],['Platinum',3500,12,'All benefits and priority support']] as [$name,$fee,$months,$benefits]) MembershipLevel::firstOrCreate(['name'=>$name], ['fee'=>$fee,'validity_months'=>$months,'benefits'=>$benefits,'is_active'=>true]);
    }
}
