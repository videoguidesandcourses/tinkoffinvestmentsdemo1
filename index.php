<?php
require_once 'vendor/autoload.php';

use \jamesRUS52\TinkoffInvest\TIClient;
use \jamesRUS52\TinkoffInvest\TISiteEnum;
use \jamesRUS52\TinkoffInvest\TICurrencyEnum;
use \jamesRUS52\TinkoffInvest\TIInstrument;
use \jamesRUS52\TinkoffInvest\TIPortfolio;
use \jamesRUS52\TinkoffInvest\TIOperationEnum;
use \jamesRUS52\TinkoffInvest\TIIntervalEnum;
use \jamesRUS52\TinkoffInvest\TICandleIntervalEnum;
use \jamesRUS52\TinkoffInvest\TICandle;
use \jamesRUS52\TinkoffInvest\TIOrderBook;
use \jamesRUS52\TinkoffInvest\TIInstrumentInfo;

include("credentials.php");
$file = 'result.csv';

$from = new \DateTime();
$from->sub(new \DateInterval("P365D"));
$to = new \DateTime();
$operations = $client->getOperations($from, $to);
$str="";

foreach ($operations as $operation)
{
  if ($operation->getOperationType()=="BrokerCommission")
  {
    if($operation->getCurrency()=="RUB")
    $str .= str_replace(".",",",$operation->getPayment()).';'.$operation->getCurrency().';'.';'.';'.';'.';'.$operation->getOperationType().';'.$operation->getDate()->format('d.m.Y H:i')."\n";
    if($operation->getCurrency()=="USD")
    $str .= ';'.';'.str_replace(".",",",$operation->getPayment()).';'.$operation->getCurrency().';'.';'.';'.$operation->getOperationType().';'.$operation->getDate()->format('d.m.Y H:i')."\n";
    if($operation->getCurrency()=="EUR")
    $str .= ';'.';'.';'.';'.str_replace(".",",",$operation->getPayment()).';'.$operation->getCurrency().';'.$operation->getOperationType().';'.$operation->getDate()->format('d.m.Y H:i')."\n";
  }  
}
file_put_contents($file, $str);
