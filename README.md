# php-payment-gate
PHP utils for pays.cz integration.

## Installation

	composer require axima/php-payment-gate

## Usage

	use Axima\PaymentGate\Utils;
	
	$link = Utils::getPaymentLink($merchantId, $shopId, $currency, $amount, $merchantOrderNumber, $email);
	
To validate data on confirmation, you can use helper method:

	if (!Utils::validateConfirmData($password)) {
		// error payment
	} else {
		// success payment
	}
	
If you already have parsed data from `$_GET` or you are using some framework, which provides data in different way, you can pass them as second parameter (but keep the keys same as in `$_GET`):

	Utils::validateConfirmData($password, $data)

	
## Bug reports, feature requests

Please use GitHub issue tracker / pull requests.
