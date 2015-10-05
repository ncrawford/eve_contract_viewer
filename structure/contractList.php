<?php
echo '
Contracts by ',  $character->name, ' for ', $character->corporationName, '
<table class="tablesorter" id="contract_table" width="100%">
	<thead>
		<tr>';

// column headers
for ( $ii=0; $ii<$nAttributes; ++$ii )
	echo '
			<th>', $attributeList[$ii], '</th>';

echo '
		</tr>
	</thead>
	<tbody>';

// contract values output to rows
     foreach ( $contracts->result->contractList as $contract )
     {
     	// if I did not create the contract, skip it
     	// if the contract is not for my corporation or alliance, skip it
     	// if the contract is not Outstanding, skip it
          // if the contract is not ItemExchange, skip it
     	if ( $contract->issuerID != $character->characterID || ($contract->assigneeID != $character->corporationID && $contract->assigneeID != $character->allianceID) || strcasecmp($contract->status, 'Outstanding') != 0 || strcasecmp($contract->type, 'ItemExchange') != 0 )
     		continue;

     	// get solar system ID of the station


     	echo '
     <tr onClick="CCPEVE.showContract(\'', $station->getSolarSystemID($contract->startStationID), '\', \'', $contract->contractID, '\')">';

     	for ( $ii=0; $ii<$nAttributes; ++$ii )
     		echo '
     	<td>', ( is_numeric($contract->{$attributeList[$ii]}) ? number_format($contract->{$attributeList[$ii]}, 2, '.', ',') : $contract->{$attributeList[$ii]} ), '</td>';  // output formatted with decimals and thousands separator if it is numeric

     	echo '
     </tr>';
     }

echo '
	</tbody>
</table>';

//CCPEVE.showContract("', $station->getSolarSystemID($contract->startStationID), '", "', $contract->contractID, '")
//', $station->getSolarSystemID($contract->startStationID), '