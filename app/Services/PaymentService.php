<?php

namespace App\Services;

use App\Models\Payment;
use YooKassa\Client;
use YooKassa\Model\CurrencyCode;
use YooKassa\Model\Payment\ConfirmationType;
use YooKassa\Model\Receipt\PaymentMode;
use YooKassa\Request\Payments\CreatePaymentRequest;
use Ramsey\Uuid\Uuid;


class PaymentService
{
    public function CreatePaymet(float $amount, string $currency): Payment
    {
        $client = new Client();
        $client->setAuth('', '');

        $builder = CreatePaymentRequest::builder();
        $builder
            ->setAmount(1)
            ->setCurrency(CurrencyCode::RUB)
            ->setOptions(
                [
                'cms_name'       => 'yoo_api_test',
                'order_id'       => '112233',
                'language'       => 'ru',
                'transaction_id' => '123-456-789',
                ]
            );
        $builder->setConfirmation(
            [
            'type' => ConfirmationType::REDIRECT,
            'returnUrl' => 'http://localhost/backUrl'
            ]
        );
        $request = $builder->build();
        $uuid = Uuid::uuid4()->toString();
        $response = $client->createPayment($request, $uuid);
        $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();
        $paymentId = $response->getId();

        $paymentModel = new Payment();
        $paymentModel->uuid = $paymentId;
        $paymentModel->paid = false;
        $paymentModel->paymentUrl = $confirmationUrl;
        $paymentModel->save();
        return $paymentModel;
    }
}

