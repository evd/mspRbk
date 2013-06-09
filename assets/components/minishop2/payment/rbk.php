<?php
// Подключаем
define('MODX_API_MODE', true);
require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/index.php';

// Включаем обработку ошибок
$modx->getService('error','error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('FILE');

/* @var miniShop2 $miniShop2 */
$miniShop2 = $modx->getService('minishop2','miniShop2',$modx->getOption('minishop2.core_path',null,$modx->getOption('core_path').'components/minishop2/').'model/minishop2/', array());
$miniShop2->loadCustomClasses('payment');

if (!class_exists('RBK')) {exit( 'Error: could not load payment class "RBK".');}
if (empty($_POST['orderId'])) {exit('Wrong orderId');}
/* @var msPaymentInterface|RBK $handler */
$handler = new RBK($modx->newObject('msOrder'));
$order = $modx->getObject('msOrder', $_POST['orderId']);
if (!isset($order)) {exit('Wrong orderId');}
$handler->receive($order, $_POST);

echo 'OK';