<?php
/**
 * @author Tomáš Blatný
 */

namespace Axima\PaymentGate;


class Utils
{

	/**
	 * @param int $merchantId
	 * @param int $shopId
	 * @param string $currency
	 * @param int $amount
	 * @param string $merchantOrderNumber
	 * @param string|NULL $email
	 * @return string
	 */
	public static function getPaymentLink($merchantId, $shopId, $currency, $amount, $merchantOrderNumber, $email = NULL)
	{
		$link = 'https://www.pays.cz/paymentorder?Merchant=' . $merchantId . '&Shop=' . $shopId;
		$link .= '&Currency=' . $currency . '&Amount=' . $amount . '&MerchantOrderNumber=' . $merchantOrderNumber;
		if ($email !== NULL) {
			$link .= '&Email=' . $email;
		}
		return $link;
	}


	/**
	 * @param string $password
	 * @param array|NULL $data
	 * @return bool
	 */
	public static function validateConfirmData($password, array $data = NULL)
	{
		if ($data === NULL) {
			$data = $_GET;
		}

		$get = function ($name, $default = NULL) use ($data) {
			return isset($data[$name]) ? $data[$name] : $default;
		};

		$hashString = implode('', [
			$get('PaymentOrderID') .
			$get('MerchantOrderNumber') .
			$get('PaymentOrderStatusID') .
			$get('CurrencyID') .
			$get('Amount') .
			$get('CurrencyBaseUnits')
		]);

		return hash_hmac('md5', $hashString, $password) === $get('Hash', $get('hash'));
	}

}
