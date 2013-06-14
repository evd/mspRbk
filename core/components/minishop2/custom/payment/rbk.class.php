<?php
if (!class_exists('msPaymentInterface')) {
	require_once dirname(dirname(dirname(__FILE__))) . '/model/minishop2/mspaymenthandler.class.php';
}

class RBK extends msPaymentHandler implements msPaymentInterface {

	function __construct(xPDOObject $object, $config = array()) {
		$this->modx = & $object->xpdo;

		$siteUrl = $this->modx->getOption('site_url');
		$assetsUrl = $this->modx->getOption('minishop2.assets_url', $config, $this->modx->getOption('assets_url').'components/minishop2/');
		$paymentUrl = $siteUrl . substr($assetsUrl, 1) . 'payment/rbk.php';

		$this->config = array_merge(array(
			'paymentUrl' => $paymentUrl
			,'checkoutUrl' => $this->modx->getOption('ms2_payment_rbk_checkout_url', null, 'https://rbkmoney.ru/acceptpurchase.aspx')
			,'currency' => $this->modx->getOption('ms2_payment_rbk_currency', null, 'RUR')
			,'eshopid' => $this->modx->getOption('ms2_payment_rbk_eshopid')
			,'secret_key' => $this->modx->getOption('ms2_payment_rbk_secret_key')
			,'preference' => $this->modx->getOption('ms2_payment_rbk_preference')
			,'language' => $this->modx->getOption('ms2_payment_rbk_language', null, 'ru')
			,'json_response' => false
		), $config);

		$this->modx->lexicon->load('minishop2:rbk');
	}


	/* @inheritdoc} */
	public function send(msOrder $order) {
        $link = $this->getPaymentLink($order);
		return $this->success('', array('redirect' => $link));
	}

    public function getPaymentLink(msOrder $order) {
        $successUrl = $cancelUrl = $this->modx->getOption('site_url');
        $params = array(
            'msorder' => $order->get('id')
        );
        $context = $order->get('context');
        if ($id = $this->modx->getOption('ms2_payment_rbk_success_id', null, 0)) {
            $successUrl = $this->modx->makeUrl($id, $context, $params, 'full');
        }
        if ($id = $this->modx->getOption('ms2_payment_rbk_cancel_id', null, 0)) {
            $cancelUrl = $this->modx->makeUrl($id, $context, $params, 'full');
        }

        $params = array(
            'eshopId' => $this->config['eshopid']
            ,'orderId' => $order->get('id')
            ,'serviceName' => $this->modx->lexicon('ms2_payment_rbk_service_name', array('num' => $order->get('id')))
            ,'recipientAmount' => $order->get('cost')
            ,'recipientCurrency' => $this->config['currency']
            ,'language' => $this->config['language']
            ,'successUrl' => $successUrl
            ,'failUrl' => $cancelUrl
        );

        $profile = $order->getOne('UserProfile');
        if (isset($profile)) {
            $params['user_email'] = $profile->get('email');
        }

        if (!empty($this->config['preference']))
            $params['preference'] = $this->config['preference'];

        $params['hash'] = $this->hash($params, 'request');

        $link = $this->config['checkoutUrl'];
        $link.= ((strpos($link, '?') === false)?'?':'&') . http_build_query($params);

        return $link;
    }

	/* @inheritdoc} */
	public function receive(msOrder $order, $params = array()) {
		/* @var miniShop2 $miniShop2 */
		$miniShop2 = $this->modx->getService('miniShop2');
		//Check input parameters
		if (!isset($params['eshopId'], $params['recipientAmount'], $params['recipientCurrency'], $params['paymentStatus'], $params['hash'])) {
			$this->modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2:RBK] Wrong payment request: Request: ' . print_r($params, 1));
			return true;
		}
		if ($this->hash($params, 'payment') != $params['hash']) {
			$this->modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2:RBK] Wrong hash: Request: ' . print_r($params, 1));
			return true;
		}
		if ($params['eshopId'] != $this->config['eshopid']) {
			$this->modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2:RBK] Wrong eshopId: Request: ' . print_r($params, 1));
			return true;
		}
		if ($params['recipientCurrency'] != $this->config['currency']) {
			$this->modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2:RBK] Wrong currency: Request: ' . print_r($params, 1));
			return true;
		}
		if ($params['recipientAmount'] != $order->get('cost')) {
			$this->modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2:RBK] Wrong order cost: Request: ' . print_r($params, 1));
			return true;
		}

		if ($params['paymentStatus']==5)
			$miniShop2->changeOrderStatus($order->get('id'), 2); // Setting status "paid"
		elseif ($params['paymentStatus']==4 && $this->modx->getOption('ms2_payment_rbk_cancel_order', null, false))
			$miniShop2->changeOrderStatus($order->get('id'), 4); // Setting status "cancelled"

		return true;
	}

	/**
	 * Caclulate hash
	 *
	 * @param array $params Params for hash
	 * @param string $type The type of operation (request or payment)
	 * @return string
	 */
	public function hash($params = array(), $type = 'request') {
		$fields = array();
		if ($type=='request')
			$fields = array('eshopId','recipientAmount','recipientCurrency',
							'user_email','serviceName','orderId','userFields');
		else
			$fields = array('eshopId','orderId','serviceName','eshopAccount',
						'recipientAmount','recipientCurrency','paymentStatus',
						'userName','userEmail','paymentData');

		$hashValues = array();
		foreach($fields as $field) {
			$hashValues[] = (isset($params[$field]))?$params[$field]:'';
		}
		$hashValues[] = $this->config['secret_key'];
		return md5(implode('::', $hashValues));
	}
}