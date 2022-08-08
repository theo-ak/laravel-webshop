<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */


    'email' => 'Câmpul :attribute trebuie să fie o adresă de e-mail validă.',
    'exists' => 'Câmpul :attribute selectat nu este valid.',
    'file' => 'Câmpul :attribute trebuie să fie un fișier.',
    'image' => 'Câmpul :attribute trebuie să fie o imagine.',
    'in' => 'Câmpul :attribute selectat nu este valid.',
    'in_array' => 'Câmpul :attribute nu există în :other.',
    'numeric' => 'Câmpul :attribute trebuie să fie un număr.',
    'required' => 'Câmpul :attribute este obligatoriu.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'title' => 'titlu',
        'description' => 'descriere',
        'price' => 'pret',
        'image' => 'imagine'
    ],

];
