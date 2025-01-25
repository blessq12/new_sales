<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyLegalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CompanyLegal::create([
            'company_id' => 1,
            'account_number' => '40702810823200001507',
            'currency' => 'RUR',
            'name' => 'ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ "САЛЕС"',
            'inn' => '7017245026',
            'kpp' => '701701001',
            'bank' => 'ФИЛИАЛ "НОВОСИБИРСКИЙ" АО "АЛЬФА-БАНК"',
            'bik' => '045004774',
            'correspondent_account' => '30101810600000000774',
            'legal_address' => 'проспект МИРА, д. Д. 39, кв./оф. КВ. 84, Томская область, р-н ГОРОД ТОМСК, г. ТОМСК',
        ]);
        \App\Models\CompanyLegal::create([
            'company_id' => 1,
            'account_number' => '40702810023010006893',
            'currency' => 'RUR',
            'name' => 'ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ "ЗАСОР ТОМСК"',
            'inn' => '7017481721',
            'kpp' => '701701001',
            'bank' => 'ФИЛИАЛ "НОВОСИБИРСКИЙ" АО "АЛЬФА-БАНК"',
            'bik' => '045004774',
            'correspondent_account' => '30101810600000000774',
            'legal_address' => 'проспект Мира, д. д.39, кв./оф. кв.84, Томская область, р-н ГОРОД ТОМСК, г. Томск',
        ]);
    }
}
