<?php

namespace CodiLuck\AuthorizenetVisa\Gateway\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;
use Magento\Payment\Model\InfoInterface;
use Magento\Sales\Model\Order\Payment;

/**
 * Class PaymentDetailsHandler
 * @package CodiLuck\AuthorizenetVisa\Gateway\Response
 */
class PaymentDetailsHandler implements HandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(array $handlingSubject, array $response)
    {
        /** @var InfoInterface|Payment $payment */
        $payment = $handlingSubject['payment']->getPayment();

        $transactionId = time();
        $payment->setCcTransId($transactionId);
        $payment->setLastTransId($transactionId);
        $payment->setTransactionId($transactionId);

        $payment->setData('cc_type', $response['cardInfo']['cardArt']['cardBrand']);
        $payment->setAdditionalInformation('card_type', $response['cardInfo']['cardArt']['cardBrand']);
        $payment->setAdditionalInformation('exp_data', $response['cardInfo']['expirationDate']);
    }
}