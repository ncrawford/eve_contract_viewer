<?php

require_once 'config/config.php'; // contains contract_viewer_keyId and contract_viewer_vCode initialization
require_once 'dataHandling/objects/ale/factory.php';
require_once 'dataHandling/objects/station.php';
require_once 'structure/preload.php';

if ( contract_viewer_keyId == '' || contract_viewer_vCode == '' )
    exit;

 //get ALE object
 try
 {
    // which contract attributes to display; columns are displayed in the order listed below
    $attributeList = array(
                        'title',
                        'price',
                        'dateExpired'
                    );

    $nAttributes = count($attributeList);

    $station = new Station();

     $ale = AleFactory::getEVEOnline();
     $ale->setKey(contract_viewer_keyId, contract_viewer_vCode); //set user credentials, third parameter $characterID is also possible;
     $account = $ale->account->Characters(); //let's fetch characters first.
     
     //you can traverse <rowset> element with attribute name="characters" as array
     foreach ($account->result->characters as $character)
     {
         //this is how you can get attributes of element
         //$characterID = $character->characterID;
         
         //set characterID for Contracts
         $ale->setCharacterID($character->characterID);
         $contracts = $ale->char->Contracts();
         include 'structure/contractList.php';
     }

 }
 //and finally, we should handle exceptions
 catch (Exception $e)
 {
     echo $e->getMessage();
 }
 
 require_once 'structure/postload.php';
