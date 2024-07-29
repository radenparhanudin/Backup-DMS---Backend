<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain default error messages used by
    | validator class. Some of these rules have multiple versions such
    | as size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute must be accepted.',
    'accepted_if' => ':attribute must be accepted when :other is :value.',
    'active_url' => ':attribute must be a valid URL.',
    'after' => ':attribute must be a date after :date.',
    'after_or_equal' => ':attribute must be a date after or equal to :date.',
    'alpha' => ':attribute must only contain letters.',
    'alpha_dash' => ':attribute must only contain letters, numbers, dashes, and underscores.',
    'alpha_num' => ':attribute must only contain letters and numbers.',
    'array' => ':attribute must be an array.',
    'ascii' => ':attribute must only contain single-byte alphanumeric characters and symbols.',
    'before' => ':attribute must be a date before :date.',
    'before_or_equal' => ':attribute must be a date before or equal to :date.',
    'between' => [
        'array' => ':attribute must have between :min and :max items.',
        'file' => ':attribute must be between :min and :max kilobytes.',
        'numeric' => ':attribute must be between :min and :max.',
        'string' => ':attribute must be between :min and :max characters.',
    ],
    'boolean' => ':attribute must be true or false.',
    'can' => ':attribute contains an unauthorized value.',
    'confirmed' => ':attribute confirmation does not match.',
    'current_password' => 'password is incorrect.',
    'date' => ':attribute must be a valid date.',
    'date_equals' => ':attribute must be a date equal to :date.',
    'date_format' => ':attribute must match format :format.',
    'decimal' => ':attribute must have :decimal decimal places.',
    'declined' => ':attribute must be declined.',
    'declined_if' => ':attribute must be declined when :other is :value.',
    'different' => ':attribute and :other must be different.',
    'digits' => ':attribute must be :digits digits.',
    'digits_between' => ':attribute must be between :min and :max digits.',
    'dimensions' => ':attribute has invalid image dimensions.',
    'distinct' => ':attribute has a duplicate value.',
    'doesnt_end_with' => ':attribute must not end with one of following: :values.',
    'doesnt_start_with' => ':attribute must not start with one of following: :values.',
    'email' => ':attribute must be a valid email address.',
    'ends_with' => ':attribute must end with one of following: :values.',
    'enum' => 'selected :attribute is invalid.',
    'exists' => 'selected :attribute is invalid.',
    'extensions' => ':attribute must have one of following extensions: :values.',
    'file' => ':attribute must be a file.',
    'filled' => ':attribute must have a value.',
    'gt' => [
        'array' => ':attribute must have more than :value items.',
        'file' => ':attribute must be greater than :value kilobytes.',
        'numeric' => ':attribute must be greater than :value.',
        'string' => ':attribute must be greater than :value characters.',
    ],
    'gte' => [
        'array' => ':attribute must have :value items or more.',
        'file' => ':attribute must be greater than or equal to :value kilobytes.',
        'numeric' => ':attribute must be greater than or equal to :value.',
        'string' => ':attribute must be greater than or equal to :value characters.',
    ],
    'hex_color' => ':attribute must be a valid hexadecimal color.',
    'image' => ':attribute must be an image.',
    'in' => 'selected :attribute is invalid.',
    'in_array' => ':attribute must exist in :other.',
    'integer' => ':attribute must be an integer.',
    'ip' => ':attribute must be a valid IP address.',
    'ipv4' => ':attribute must be a valid IPv4 address.',
    'ipv6' => ':attribute must be a valid IPv6 address.',
    'json' => ':attribute must be a valid JSON string.',
    'lowercase' => ':attribute must be lowercase.',
    'lt' => [
        'array' => ':attribute must have less than :value items.',
        'file' => ':attribute must be less than :value kilobytes.',
        'numeric' => ':attribute must be less than :value.',
        'string' => ':attribute must be less than :value characters.',
    ],
    'lte' => [
        'array' => ':attribute must not have more than :value items.',
        'file' => ':attribute must be less than or equal to :value kilobytes.',
        'numeric' => ':attribute must be less than or equal to :value.',
        'string' => ':attribute must be less than or equal to :value characters.',
    ],
    'mac_address' => ':attribute must be a valid MAC address.',
    'max' => [
        'array' => ':attribute must not have more than :max items.',
        'file' => ':attribute must not be greater than :max kilobytes.',
        'numeric' => ':attribute must not be greater than :max.',
        'string' => ':attribute must not be greater than :max characters.',
    ],
    'max_digits' => ':attribute must not have more than :max digits.',
    'mimes' => ':attribute must be a file of type: :values.',
    'mimetypes' => ':attribute must be a file of type: :values.',
    'min' => [
        'array' => ':attribute must have at least :min items.',
        'file' => ':attribute must be at least :min kilobytes.',
        'numeric' => ':attribute must be at least :min.',
        'string' => ':attribute must be at least :min characters.',
    ],
    'min_digits' => ':attribute must have at least :min digits.',
    'missing' => ':attribute must be missing.',
    'missing_if' => ':attribute must be missing when :other is :value.',
    'missing_unless' => ':attribute must be missing unless :other is :value.',
    'missing_with' => ':attribute must be missing when :values is present.',
    'missing_with_all' => ':attribute must be missing when :values are present.',
    'multiple_of' => ':attribute must be a multiple of :value.',
    'not_in' => 'selected :attribute is invalid.',
    'not_regex' => ':attribute format is invalid.',
    'numeric' => ':attribute must be a number.',
    'password' => [
        'letters' => ':attribute must contain at least one letter.',
        'mixed' => ':attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => ':attribute must contain at least one number.',
        'symbols' => ':attribute must contain at least one symbol.',
        'uncompromised' => 'given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => ':attribute must be present.',
    'present_if' => ':attribute must be present when :other is :value.',
    'present_unless' => ':attribute must be present unless :other is :value.',
    'present_with' => ':attribute must be present when :values is present.',
    'present_with_all' => ':attribute must be present when :values are present.',
    'prohibited' => ':attribute is prohibited.',
    'prohibited_if' => ':attribute is prohibited when :other is :value.',
    'prohibited_unless' => ':attribute is prohibited unless :other is in :values.',
    'prohibits' => ':attribute prohibits :other from being present.',
    'regex' => ':attribute format is invalid.',
    'required' => ':attribute is required.',
    'required_array_keys' => ':attribute must contain entries for: :values.',
    'required_if' => ':attribute is required when :other is :value.',
    'required_if_accepted' => ':attribute is required when :other is accepted.',
    'required_unless' => ':attribute is required unless :other is in :values.',
    'required_with' => ':attribute is required when :values is present.',
    'required_with_all' => ':attribute is required when :values are present.',
    'required_without' => ':attribute is required when :values is not present.',
    'required_without_all' => ':attribute is required when none of :values are present.',
    'same' => ':attribute must match :other.',
    'size' => [
        'array' => ':attribute must contain :size items.',
        'file' => ':attribute must be :size kilobytes.',
        'numeric' => ':attribute must be :size.',
        'string' => ':attribute must be :size characters.',
    ],
    'starts_with' => ':attribute must start with one of following: :values.',
    'string' => ':attribute must be a string.',
    'timezone' => ':attribute must be a valid timezone.',
    'unique' => ':attribute has already been taken.',
    'uploaded' => ':attribute failed to upload.',
    'uppercase' => ':attribute must be uppercase.',
    'url' => ':attribute must be a valid URL.',
    'ulid' => ':attribute must be a valid ULID.',
    'uuid' => ':attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name lines. This makes it quick to
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
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
