<?php
define('MODX_API_MODE', true);
require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/index.php';

$modx->getService('error','error.modError');

//Logging request if in debug mode
if ($modx->getDebug()) $modx->log(xPDO::LOG_LEVEL_DEBUG, '[miniShop2:RBK] Payment notification request: ' . print_r($_POST, true));

/* @var miniShop2 $miniShop2 */
$miniShop2 = $modx->getService('minishop2','miniShop2',$modx->getOption('minishop2.core_path',null,$modx->getOption('core_path').'components/minishop2/').'model/minishop2/', array());
$miniShop2->loadCustomClasses('payment');

if (class_exists('RBK')) {
    if (!empty($_POST['orderId'])) {
        /* @var msPaymentInterface|RBK $handler */
        $handler = new RBK($modx->newObject('msOrder'));
        $order = $modx->getObject('msOrder', $_POST['orderId']);
        if (isset($order)) {
            $handler->receive($order, $_POST);
        } else
            $handler->paymentError('Order not found', $_POST);
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, '[miniShop2:RBK] Wrong orderId.');
    }
} else {
    $modx->log(xPDO::LOG_LEVEL_ERROR, '[miniShop2:RBK] could not load payment class "RBK".');
}

//Always return OK to prevent repaeat payment notification
echo 'OK';