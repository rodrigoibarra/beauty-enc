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

    'accepted'             => 'Tienes que aceptar :attribute',
    'active_url'           => 'El campo :attribute No es una URL válida',
    'after'                => 'El campo :attribute debe de ser una fecha posterior a :date.',
    'alpha'                => 'El campo :attribute Sólo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute sólo puede contener letras, números y diagonales',
    'alpha_num'            => 'El campo :attribute sólo puede contener letras y números',
    'array'                => 'El campo :attribute debe de ser un array',
    'before'               => 'El campo :attribute debe de ser una fecha anterior a :date.',
    'between'              => [
        'numeric' => 'El campo :attribute debe de estar entre :min y :max.',
        'file'    => 'El campo :attribute debe de estar entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe de estar entre :min y :max characters.',
        'array'   => 'El campo :attribute debe de estar entre :min y :max items.',
    ],
    'boolean'              => 'El campo :attribute sólo puede ser true o false.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'date'                 => 'El campo :attribute no es una fecha válida.',
    'date_format'          => 'El campo :attribute no corresponde a :format.',
    'different'            => 'El campo :attribute y :other deben de ser diferentes.',
    'digits'               => 'El campo :attribute debe tener :digits dígitos.',
    'digits_between'       => 'El campo :attribute must be between :min and :max digits.',
    'dimensions'           => 'El campo :attribute tiene dimensiones inválidas.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El campo :attribute tiene que ser un correo válido.',
    'exists'               => 'El campo :attribute seleccionado es inválido.',
    'file'                 => 'El campo :attribute debe de ser un archivo.',
    'filled'               => 'El campo :attribute es requerido.',
    'image'                => 'El campo :attribute debe de ser una imagen.',
    'in'                   => 'La opción seleccionada del campo :attribute es inválida.',
    'in_array'             => 'El campo :attribute no debe estar contenido en :other.',
    'integer'              => 'El campo :attribute debe de ser un número entero.',
    'ip'                   => 'El campo :attribute tiene que ser una IP válida.',
    'json'                 => 'El campo :attribute debe de ser un JSON.',
    'max'                  => [
        'numeric' => 'El campo  :attribute no debe ser mayor a :max.',
        'file'    => 'El campo :attribute no puede ser mayor a  :max kilobytes.',
        'string'  => 'El campo :attribute no puede ser mayor que :max caracteres.',
        'array'   => 'El campo :attribute no debe tener más de :max elementos.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe ser mayor a :min.',
        'file'    => 'El campo :attribute debe de ser mayor a :min kilobytes.',
        'string'  => 'El campo :attribute debe tener al menos :min caracteres.',
        'array'   => 'El campo :attribute debe tener al menos :min elementos.',
    ],
    'not_in'               => 'La opción seleccionada del campo :attribute es inválida.',
    'numeric'              => 'El campo :attribute debe de ser un número.',
    'present'              => 'El campo :attribute debe de estar presenta.',
    'regex'                => 'El formato del campo :attribute es inválido.',
    'required'             => 'El campo :attribute es requerido.',
    'required_if'          => 'El campo :attribute es requerdio cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos :other este en :values.',
    'required_with'        => 'El campo :attribute es requerido cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es requerido cuando :values está presente.',
    'required_without'     => 'El campo :attribute es requerido cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de estos valores :values está presente.',
    'same'                 => 'El campo :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe de ser :size.',
        'file'    => 'El campo :attribute debe pesar :size kilobytes.',
        'string'  => 'El campo :attribute debe tener :size caracteres.',
        'array'   => 'El campo :attribute debe contener :size elementos.',
    ],
    'string'               => 'El campo :attribute debe de ser una cadena de texto.',
    'timezone'             => 'El campo :attribute debe de ser una zona horaria válida.',
    'unique'               => 'El campo :attribute ya ha sido tomado.',
    'url'                  => 'El campo :attribute tiene un formato invalido.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
