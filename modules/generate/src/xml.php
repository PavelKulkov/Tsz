<?php
	$subservice_url_id = 14;
	$soapAction = "urn:putData";
?>

<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

    <soap:Body>
        <smev:putData>
            <smev:Message>
                <smev:Sender>
                    <smev:Code><?php echo(htmlspecialchars($sender[0]));?></smev:Code>
                    <smev:Name><?php echo(htmlspecialchars($sender[1]));?></smev:Name>
                </smev:Sender>
                <smev:Recipient>
                    <smev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></smev:Code>
                    <smev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></smev:Name>
                </smev:Recipient>
                <smev:Originator>
                    <smev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></smev:Code>
                    <smev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></smev:Name>
                </smev:Originator>
                <smev:ServiceName>UniversalMVV</smev:ServiceName>
                <smev:TypeCode>GSRV</smev:TypeCode>
                <smev:Status>REQUEST</smev:Status>
                <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
                <smev:ExchangeType>123</smev:ExchangeType>
                <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
                <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
                <smev:ServiceCode>111111111111</smev:ServiceCode>
                <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
            </smev:Message>
            <smev:MessageData>
                <smev:AppData>
                    <q1:result>
                    	<q1:dataRow>
                            <q1:name>procedureCode</q1:name>
                            <q1:value><?php echo $regNumber; ?></q1:value>
                       	</q1:dataRow>
                    <?php foreach ($_POST as $key => $val): ?>
					<?php if (strpos($key, 'cloneBlock') !== false): ?>
					
					<?php                     		
						$cloneBlockName = explode('cloneBlock_', $key);
					    $cloneBlockName = end($cloneBlockName);
						$cloneBlockCount = $val;
					?>
						<q1:dataRow>
                            <q1:name><?php echo $cloneBlockName; ?></q1:name>
                            <q1:value><?php echo $cloneBlockCount; ?></q1:value>
                        </q1:dataRow>
					
					
					<?php  foreach ($_POST as $key => $val): ?>
						<?php if ( (strpos($key, $cloneBlockName) !== false) && (strpos($key, 'cloneBlock_'.$cloneBlockName) === false) ): ?>
							<?php 
								$cloneBlockFieldName = explode($cloneBlockName.'_', $key); 
								$cloneBlockFieldName = end($cloneBlockFieldName);
								$cloneBlockFieldName = explode('_', $cloneBlockFieldName);
								$cloneBlockFieldName = array_shift($cloneBlockFieldName);
								
							?>
								<q1:dataRow>
		                            <q1:name><?php echo $key; ?></q1:name>
		                            <?php
		                            	if (preg_match('/\d{2}\-\d{2}\-\d{4}/', $val, $match)) {
											$val = explode('-', $match[0]);
											$val = $val[0].'/'.$val[1].'/'.$val[2].'/';
										}		                            
		                            ?>
		                            <q1:value><?php echo $val; ?></q1:value>
		                        </q1:dataRow>							
						<?php endif; ?>
					<?php  endforeach; ?>
					
					<?php else: ?>
                    	<q1:dataRow>
						    <q1:name><?php echo $key; ?></q1:name>
						    
						    <?php
                            	if (preg_match('/\d{2}\-\d{2}\-\d{4}/', $val, $match)) {
									$val = explode('-', $match[0]);
									$val = $val[0].'/'.$val[1].'/'.$val[2].'/';
								}
								if ($val  == "on") {
									$val = 'true';
								}		                            
                            ?>
						    
						    <q1:value><?php echo $val; ?></q1:value>
						</q1:dataRow>					
					<?php endif; ?>
					<?php endforeach; ?>
						<q1:params>
                            <q1:app_id><?php echo(htmlspecialchars($idRequest));?></q1:app_id>
                            <q1:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q1:status_date>
                        </q1:params>
                    </q1:result>
                </smev:AppData>
				<smev:AppDocument>
				  <smev:RequestCode>metadata</smev:RequestCode>
				  <smev:BinaryData><?php echo ($attachment->data); ?></smev:BinaryData>
				</smev:AppDocument>
            </smev:MessageData>
        </smev:putData>
    </soap:Body>
</soap:Envelope>