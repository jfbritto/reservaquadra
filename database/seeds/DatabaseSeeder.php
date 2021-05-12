<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CourtsTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(InvoicesTableSeeder::class);
        $this->call(InvoiceTypesTableSeeder::class);
        $this->call(ContractsTableSeeder::class);
        $this->call(ScheduledClassesTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(PaymentMethodSubtypesTableSeeder::class);
    }
}
