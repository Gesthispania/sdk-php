NimblePayments SDK for PHP
======================

The NimblePayments SDK for PHP makes it easy to add payment services to your e-commerce. It connects your site to the NimblePayments API directly.

## Release notes

### 1.0
- First live release
- It includes the single payment service 

## Requirements
* PHP 5.2 or above
* curl & json extensions must be enabled

## Installation
The SDK zip from the GitHub repository contains the NimblePayments SDK for PHP tool, including all its dependencies. Follow the next steps to install it:

1- Download the latest/desired release zip. You will obtain a file called "_sdk-php-master.zip_" which includes the SDK and several samples.
2- Create a new folder inside your PHP project directory to store NimblePayments SDK files.
3- Unzip "_sdk-php-master.zip_" and copy all files in the folder you have just created in the previous step.

## Configuration
The file named __base/ConfigSDK.php__ includes some configuration parameters by default that do not need to be modified.

## Working with the SDK
Once you have completed the Installation and configuration processes, you are ready to generate a payment.

``` php
require_once './nimble-dev-sdk-php-master/lib/Nimble/base/NimbleAPI.php';

$params = array(
        'clientId' => '729DFCD7A2B4643A0DA3D4A7E537FC6E',
        'clientSecret' => 'jg26cI3O1mB0$eR&fo6a2TWPmq&gyQoUOG6tClO%VE*N$SN9xX27@R4CTqi*$4EO',
        'mode' => 'sandbox'
);

$NimbleApi = new NimbleAPI($params);
```

> The parameter 'mode' is set to define the environment and has two possible values: sandbox or real. 'Sandbox' is used in the demo environment to make tests and 'real' must be set to work in the real environment. 

## Usage

### Payment

See detailed information about [payments](https://github.com/nimblepayments/sdk-php/wiki/Payment) with NimbleePayments.

## Test

In `test` folder you will find scripts implementing a basics operations that uses NimbleePayments SDK as payment platform.
