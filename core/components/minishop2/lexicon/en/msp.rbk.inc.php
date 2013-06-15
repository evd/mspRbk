<?php
/**
 * Settings English Lexicon Entries for mspRbk
 *
 * @package msprbk
 * @subpackage lexicon
 */

$_lang['ms2_payment_rbk_service_name'] = 'Order #[[+num]]';

$_lang['setting_ms2_payment_rbk_checkout_url'] = 'RBK Money checkout url';
$_lang['setting_ms2_payment_rbk_checkout_url_desc'] = 'Url to request payment in RBK Money.';
$_lang['setting_ms2_payment_rbk_currency'] = 'RBK Money currency';
$_lang['setting_ms2_payment_rbk_currency_desc'] = 'Payment\'s currecnt in RBK Money. Available values: USD, RUR, EUR, UAH, GBP.';
$_lang['setting_ms2_payment_rbk_eshopid'] = 'RBK Money eshopId';
$_lang['setting_ms2_payment_rbk_eshopid_desc'] = 'Unique shop\'s identifier. You can see it in the personal cabinet in RBK Money.';
$_lang['setting_ms2_payment_rbk_secret_key'] = 'RBK Money secret_key';
$_lang['setting_ms2_payment_rbk_secret_key_desc'] = 'Mandatory secret key to confirm all transactions. You can set it in the personal cabinet in RBk Money.';
$_lang['setting_ms2_payment_rbk_language'] = 'RBK Money language';
$_lang['setting_ms2_payment_rbk_language_desc'] = 'User interface language. Available values: ru, en.';
$_lang['setting_ms2_payment_rbk_preference'] = 'RBK Money preference payment';
$_lang['setting_ms2_payment_rbk_preference_desc'] = 'Preffered input method for payment bypassing selection page. More in RBK Money\'s documenation. Or empty for user select.';
$_lang['setting_ms2_payment_rbk_success_id'] = 'RBK Money successful page id';
$_lang['setting_ms2_payment_rbk_success_id_desc'] = 'The customer will be sent to this page after the completion of the payment. It is recommended to specify the id of the page with the shopping cart to order output.';
$_lang['setting_ms2_payment_rbk_cancel_id'] = 'RBK Money cancel page id';
$_lang['setting_ms2_payment_rbk_cancel_id_desc'] = 'The customer will be sent to this page if something went wrong. It is recommended to specify the id of the page with the shopping cart to order output.';
$_lang['setting_ms2_payment_rbk_cancel_order'] = 'RBK Money cancel order';
$_lang['setting_ms2_payment_rbk_cancel_order_desc'] = 'If true, order will be cancelled if customer cancel payment.';