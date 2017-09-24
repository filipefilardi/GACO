<?php

return [

    'accepted'             => 'O :attribute deve ser válido.',
    'active_url'           => 'A :attribute não é uma URL válida.',
    'after'                => 'O :attribute deve ser uma data depois de :date.',
    'alpha'                => 'O :attribute pode conter apenas letras.',
    'alpha_dash'           => 'O :attribute pode conter apenas letras, números e traços.',
    'alpha_num'            => 'O :attribute pode conter apenas letras e números.',
    'array'                => 'O :attribute deve ser um array.',
    'before'               => 'O :attribute deve ser uma data antes de :date.',
    'between'              => [
        'numeric' => 'O :attribute deve ser entre :min e :max.',
        'file'    => 'O :attribute deve ser entre :min e :max kilobytes.',
        'string'  => 'O :attribute deve ser entre :min e :max characteres.',
        'array'   => 'O :attribute deve ser entre :min e :max items.',
    ],
    'boolean'              => 'O campo :attribute deve ser true ou false.',
    'confirmed'            => 'O :attribute confirmação não corresponde.',
    'date'                 => 'O :attribute não é uma data válida.',
    'date_format'          => 'O :attribute não respeita o formato :format.',
    'different'            => 'O :attribute e :other deve ser diferente.',
    'digits'               => 'O :attribute deve ser :digits digitos.',
    'digits_between'       => 'O :attribute deve ser entre :min e :max dígitos.',
    'dimensions'           => 'O :attribute tem dimensões inválidas.',
    'distinct'             => 'O :attribute tem um valor duplicado.',
    'email'                => 'O :attribute deve ser um endereço de email válido.',
    'exists'               => 'O :attribute selecionado é inválido.',
    'file'                 => 'O :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute deve ser preenchido.',
    'image'                => 'O :attribute deve ser uma imagem.',
    'in'                   => 'O :attribute selecionado é inválido.',
    'in_array'             => 'O :attribute field does não exist in :other.',
    'integer'              => 'O :attribute deve ser an integer.',
    'ip'                   => 'O :attribute deve ser um IP Addres válido.',
    'json'                 => 'O :attribute deve ser a valid JSON string.',
    'max'                  => [
        'numeric' => 'O :attribute não pode ser maior que :max.',
        'file'    => 'O :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'O :attribute não pode ser maior que :max characteres.',
        'array'   => 'O :attribute não pode ser maior que :max items.',
    ],
    'mimes'                => 'O :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O :attribute deve ser no mínimo :min.',
        'file'    => 'O :attribute deve ser no mínimo :min kilobytes.',
        'string'  => 'O :attribute deve ser no mínimo :min characters.',
        'array'   => 'O :attribute deve have no mínimo :min items.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => 'O :attribute deve ser a number.',
    'present'              => 'O campo :attribute deve ser presente.',
    'regex'                => 'O formato :attribute é inválido.',
    'required'             => 'O campo :attribute é necessário.',
    'required_if'          => 'O campo :attribute é necessário quando :other é :value.',
    'required_unless'      => 'O campo :attribute é necessário a não ser que :other pertença a :values.',
    'required_with'        => 'O campo :attribute é necessário quando :values é presente.',
    'required_with_all'    => 'O campo :attribute é necessário quando :values é presente.',
    'required_without'     => 'O campo :attribute é necessário quando :values não é presente.',
    'required_without_all' => 'O campo :attribute é necessário quando nenhum dos :values são presente.',
    'same'                 => 'O :attribute e :other devem ser iguais.',
    'size'                 => [
        'numeric' => 'O :attribute deve ser :size.',
        'file'    => 'O :attribute deve ser :size kilobytes.',
        'string'  => 'O :attribute deve ser :size characters.',
        'array'   => 'O :attribute deve conter :size items.',
    ],
    'string'               => 'O :attribute deve ser uma string.',
    'timezone'             => 'O :attribute deve ser uma timezone.',
    'unique'               => 'O :attribute já foi utilizado.',
    'uploaded'             => 'O :attribute falha no upload.',
    'url'                  => 'O :attribute formato é inválido.',

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
