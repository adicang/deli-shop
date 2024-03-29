<?php
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'include/start.php'; 


$price = $_GET['totalPay'];
$orderId = $_GET['orderId'];
$shipping = 0;
$total = $price+$shipping;

$payer = new Payer();
$payer-> setPaymentMethod('paypal');

$item = new Item();
$item->setName($product)
    ->setCurrency('ILS')
    ->setQuantity(1)
    ->setPrice($price);

$itemList = new ItemList();
$itemList-> setItems([$item]);

$details = new Details();
$details->setShipping($shipping)
    ->setSubtotal($price);

$amount = new Amount();
$amount->setCurrency('ILS')
    ->setTotal($total)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription('payment')
    ->setInvoiceNumber(uniqid());


$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL . '/includes/order_final.php?orderId='.$orderId.'')
    ->setCancelUrl(SITE_URL . '/includes/submit_order.php');

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions([$transaction]);

try{
    $payment->create($paypal);
}catch(Exception $e){
    die($e);
}

$approvalUrl = $payment->getApprovalLink();

header("Location: {$approvalUrl}");