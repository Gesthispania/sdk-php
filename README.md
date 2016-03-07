NimblePayments SDK for PHP
======================

The NimblePayments SDK for PHP makes it easy to add payment services to your e-commerce. It connects your site to the NimblePayments API directly.

## Release notes

# 1.0

- First live release
- It includes the single payment service 

## Requirements

* PHP 5.2 or above
* curl & json extensions must be enabled

## Installation

### From source

1. Download or clone this repo. You will obtain a file called "sdk-php-master.zip". It includes the SDK and several samples.
2. Create a directory inside your PHP project directory where to store NimblePayments SDK files.
3. Unzip "sdk-php-master.zip" and copy all files in the dicertory you have created in the previous step.
4. Now you are ready to include NimblePayments SDK in your scripts

## Configuration

The file named base/ConfigSDK.php includes some configuration parameters by default that do not need to be modified.

In order to create a new object of a NimbleAPI's class, the API keys must be included in the array "params"

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
