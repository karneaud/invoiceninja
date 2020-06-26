<?php

use App\Models\GatewayType;

class GatewayTypesSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        $gateway_types = [
            ['alias' => 'credit_card', 'name' => 'Credit Card'],
            ['alias' => 'bank_transfer', 'name' => 'Bank Transfer'],
            ['alias' => 'paypal', 'name' => 'PayPal'],
        ];

        foreach ($gateway_types as $gateway_type) {
            $record = GatewayType::where('alias', '=', $gateway_type['alias'])->first();
            if ($record) {
                $record->fill($gateway_type);
                $record->save();
            } else {
                GatewayType::create($gateway_type);
            }
        }
    }
}
