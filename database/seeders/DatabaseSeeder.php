<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Donate\DonationMethodsSeeder;
use Database\Seeders\Donate\MaxiCardSeeder;
use Database\Seeders\Donate\PaypalSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(MagOptSeeder::class);
        $this->call(ItemNameSeeder::class);
        $this->call(LogInstanceWorldInfo::class);
        $this->call(LogChatMessage::class);

        $this->call(SettingSeeder::class);
        $this->call(DonationMethodsSeeder::class);
        $this->call(MaxiCardSeeder::class);
        $this->call(PaypalSeeder::class);
    }
}
