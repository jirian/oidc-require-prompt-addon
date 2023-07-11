<?php

function orpa_require_prompt_settings($fields)
{
    $field_array = array(
        'require_prompt'  => array(
            'title'       => __('Require Prompt', 'daggerhart-openid-connect-generic'),
            'description' => __('If checked, the IdP will always show the login prompt, regardless of whether the user used Remember Me.', 'daggerhart-openid-connect-generic'),
            'type'        => 'checkbox',
            'section'     => 'client_settings',
        ),
    );

    return $fields + $field_array;
}

add_filter('openid-connect-generic-settings-fields', 'orpa_require_prompt_settings', 10, 1);

function orpa_alter_url($url)
{
    $settings = get_option('openid_connect_generic_settings', array());

    if ($settings['require_prompt']) {
        $url .= "&prompt=login";
    }

    return $url;
}

add_filter('openid-connect-generic-auth-url', 'orpa_alter_url', 10, 1);
