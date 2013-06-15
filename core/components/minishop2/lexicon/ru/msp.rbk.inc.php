<?php
/**
 * Settings Russian Lexicon Entries for mspRbk
 *
 * @package msprbk
 * @subpackage lexicon
 */

$_lang['ms2_payment_rbk_service_name'] = 'Заказ #[[+num]]';

$_lang['setting_ms2_payment_rbk_checkout_url'] = 'Url оплаты RBK Money';
$_lang['setting_ms2_payment_rbk_checkout_url_desc'] = 'Url для отправки запроса на оплату в системе RBK Money.';
$_lang['setting_ms2_payment_rbk_currency'] = 'Валюта RBK Money';
$_lang['setting_ms2_payment_rbk_currency_desc'] = 'Валюта в которой производится оплата в системе RBK Money. Возможные значения: USD, RUR, EUR, UAH, GBP.';
$_lang['setting_ms2_payment_rbk_eshopid'] = 'Идентификатор магазина в RBK Money';
$_lang['setting_ms2_payment_rbk_eshopid_desc'] = 'Обязательный уникальный номер магазина в системе RBK Money. Узнать его можно в личном кабинете RBK Money.';
$_lang['setting_ms2_payment_rbk_secret_key'] = 'Секретный ключ RBK Money';
$_lang['setting_ms2_payment_rbk_secret_key_desc'] = 'Обязательный секретный ключ для подтверждения всех транзакций. Его можно указать в личном кабинете RBK money.';
$_lang['setting_ms2_payment_rbk_language'] = 'Язык интерфейса RBK Money';
$_lang['setting_ms2_payment_rbk_language_desc'] = 'Язык интерфейса в системе RBK Money. Возможные варианты ru или en.';
$_lang['setting_ms2_payment_rbk_preference'] = 'Способ пополнения в RBK Money';
$_lang['setting_ms2_payment_rbk_preference_desc'] = 'Способ ввода средств в систему RBK Money, который будет предложен Плательщику, минуя экран выбора. Подробнее в документации к RBK Money. Или пустое для выбора пользователем.';
$_lang['setting_ms2_payment_rbk_success_id'] = 'Страница успешной оплаты RBK Money';
$_lang['setting_ms2_payment_rbk_success_id_desc'] = 'Пользователь будет отправлен на эту страницу после завершения оплаты. Рекомендуется указать id страницы с корзиной, для вывода заказа.';
$_lang['setting_ms2_payment_rbk_cancel_id'] = 'Страница отказа от оплаты RBK Money';
$_lang['setting_ms2_payment_rbk_cancel_id_desc'] = 'Пользователь будет отправлен на эту страницу при неудачной оплате. Рекомендуется указать id страницы с корзиной, для вывода заказа.';
$_lang['setting_ms2_payment_rbk_cancel_order'] = 'Отмена заказа RBK Money';
$_lang['setting_ms2_payment_rbk_cancel_order_desc'] = 'Если включено, то заказ будет перевед в статус "Отменён" при отказе от оплаты.';