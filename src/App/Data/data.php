<?php

$faker = Faker\Factory::create();

$ret = [];
for($i=0; $i<100; $i++) {
    $ret['user'.$i] = [
        'nom' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->tollFreePhoneNumber     
    ];
}

return $ret;