NimblePayments SDK for PHP
======================

The NimblePayments SDK for PHP makes it easy to add payment services to your e-commerce. It connects your site to the NimblePayments API directly.

## Release notes

### 2.0.0
- Restructuring code
- Implementating new API services
- Test example code

### 1.0.0
- First live release
- It includes the single payment service 

## Requirements
* PHP 5.2 or above
* curl & json extensions must be enabled

## Installation
The SDK zip from the GitHub repository contains the NimblePayments SDK for PHP tool, including all its dependencies. Follow the next steps to install it:

1. Download the latest/desired release zip. You will obtain a file called "_sdk-php-master.zip_" which includes the SDK and several samples.
2. Create a new folder inside your PHP project directory to store NimblePayments SDK files.
3. Unzip "_sdk-php-master.zip_" and copy all files in the folder you have just created in the previous step.

## Configuration
The file named __base/ConfigSDK.php__ includes some configuration parameters by default that do not need to be modified.

## Working with the SDK
Once you have completed the Installation and configuration processes, you are ready to generate a payment.

## Payments 
In order to execute a payment, you will need to create a `NimbleApi` instance with payment and client information and use the `sendPaymentClient` method in the class `NimbleAPIPayments` to send the payment

### Payment’s information
A `payment` term refers to an object that contains all the data needed in order to execute a payment. This object is an array that must be filled with the following parameters:

- `amount`: it refers to the amount that has to be paid in cents avoiding the decimal digits. The real amount has to be multiplied by 100.
- `currency`: it refers to the payment currency. It follows the currency ISO 4217 code
- `merchantOrderId`: it refers to the merchant's sale identification. Example: The Prestashop`s order id.
- `paymentSuccessUrl`: it refers to the callback URL to be redirected when the payment finishes successfully.
- `paymentErrorUrl`: it refers to the callback URL to be redirected when the payment finishes with an error.
- `cardHolderId`: (optional) it refers to the merchant's customer identification.  Example: The Prestashop`s customer id.

```php
require_once './sdk-php/lib/Nimble/base/NimbleAPI.php';
require_once './sdk-php/lib/Nimble/api/NimbleAPIPayments.php';

// build an array with payment information
$payment = array(
    'amount' => 1010,
    'currency' => 'EUR',
    'merchantOrderId' => 'idSample12345',
    'paymentSuccessUrl' => 'https://my-commerce.com/payments/success',
    'paymentErrorUrl' => 'https://my-commerce.com/payments/error',
    'cardHolderId' => 'idCustomer12345'
);
```

## Client’s  information
Client information refers to an array called “params” that includes client’s credentials.

- Client’s credentials consist of a clientid and clientsecret. Their value is the  `Api_Client_Id` and the `Client_Secret` codes  generated when creating a Payment gateway in the Nimble dashboard.

## Example of a Payment generation
To generate a Payment you will need to execute the following steps:

- Build an array with the payment information
- Build an array with client information (`Api_Client_Id` and `Client_Secret`)
- Create a `NimbleAPI` instance
- Use the `sendPaymentClient` method in the class `NimbleAPIPayments` to send the payment

```php
require_once './sdk-php/lib/Nimble/base/NimbleAPI.php';
require_once './sdk-php/lib/Nimble/api/NimbleAPIPayments.php';

// build an array with payment information
$payment = array(
         'amount' => 1010,
         'currency' => 'EUR',
         'customerData' => 'idSample12345',
         'paymentSuccessUrl' => 'https://my-commerce.com/payments/success',
         'paymentErrorUrl' => 'https://my-commerce.com/payments/error'
        );

// build an array with client API information
$params = array(
        'clientId' => '729DFCD7A2B4643A0DA3D4A7E537FC6E',
        'clientSecret' => 'jg26cI3O1mB0$eR&fo6a2TWPmq&gyQoUOG6tClO%VE*N$SN9xX27@R4CTqi*$4EO'
);

$NimbleApi = new NimbleAPI($params);
$response = NimbleAPIPayments::sendPaymentClient($NimbleApi, $payment);
```
If the sendPaymentClient call is correct, the response will contain the new transaction id. This transaction id could be used later to view and check the new transaction in the NimblePayments's site. Also is returned the URL to show to the client for introduce the payment data information.

That payment URL must contain all the parameters needed, just for charge that URL in the web browser (or web view in the case of mobile devices).

##Environment
There are two different environment options:
- Sandbox.It is used in the demo environment to make tests.
- Real. It is used to work in the real environment.

The sandbox environment is disabled by default. To activate it, the variable mode must be manually set to “sandbox” in NimbleAPIConfig.php file. Please, follow these steps:
- Open the file ```./sdk-php/lib/Nimble/base/NimbleAPI.php```
- Search the line where ```const MODE = 'real';``` is placed
- Change the value ```real``` to ```sandbox```

## Test

In `test` folder you will find scripts implementing a basics operations that uses NimbleePayments SDK as payment platform.

## Documentation
Please see [Apiary](http://docs.nimblepublicapi.apiary.io/#) for up-to-date documentation.
