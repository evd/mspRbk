<?php
/**
 * Loads system settings into build
 *
 * @package msprbk
 * @subpackage build
 */
$settings = array();

$tmp = array(
    'ms2_payment_rbk_checkout_url' => array(
        'value' => 'https://rbkmoney.ru/acceptpurchase.aspx'
        ,'xtype' => 'textfield'
        ,'area' => 'ms2_payment'
    )
    ,'ms2_payment_rbk_currency' => array(
        'value' => 'RUR'
        ,'xtype' => 'textfield'
        ,'area' => 'ms2_payment'
    )
    ,'ms2_payment_rbk_eshopid' => array(
        'value' => ''
        ,'xtype' => 'textfield'
        ,'area' => 'ms2_payment'
    )
    ,'ms2_payment_rbk_secret_key' => array(
        'value' => ''
        ,'xtype' => 'text-password'
        ,'area' => 'ms2_payment'
    )
    ,'ms2_payment_rbk_preference' => array(
        'value' => ''
        ,'xtype' => 'textfield'
        ,'area' => 'ms2_payment'
    )
    ,'ms2_payment_rbk_language' => array(
        'value' => ''
        ,'xtype' => 'textfield'
        ,'area' => 'ms2_payment'
    )
    ,'ms2_payment_rkb_success_id' => array(
        'value' => ''
        ,'xtype' => 'numberfield'
        ,'area' => 'ms2_payment'
    )
    ,'ms2_payment_rbk_cancel_id' => array(
        'value' => ''
        ,'xtype' => 'numberfield'
        ,'area' => 'ms2_payment'
    )
    ,'ms2_payment_rbk_cancel_order' => array(
        'value' => false
        ,'xtype' => 'combo-boolean'
        ,'area' => 'ms2_payment'
    )
);


foreach ($tmp as $k => $v) {
    /* @var modSystemSetting $setting */
    $setting = $modx->newObject('modSystemSetting');
    $setting->fromArray(array_merge(
        array(
            'key' => $k
            ,'namespace' => 'minishop2'
        ), $v
    ),'',true,true);

    $settings[] = $setting;
}

return $settings;