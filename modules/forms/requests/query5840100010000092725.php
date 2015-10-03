<?php 
      $subservice_url_id = 104;
      $soapAction = "urn:UnifoTransferMsg";
?>


<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:smev="http://smev.gosuslugi.ru/rev111111" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
   <SOAP-ENV:Body wsu:Id="UnifoTransferMsg">
      <SOAP-WS:UnifoTransferMsg xmlns:SOAP-WS="http://roskazna.ru/SmevUnifoService/">
         <smev:Message>
            <smev:Sender>
               <smev:Code><?php echo(htmlspecialchars($sender[0]));?></smev:Code>
               <smev:Name><?php echo(htmlspecialchars($sender[1]));?></smev:Name>
            </smev:Sender>
            <smev:Recipient>
               <smev:Code>RKZN35001</smev:Code>
               <smev:Name>ГИС ГМП</smev:Name>
            </smev:Recipient>
            <smev:Originator>
               <smev:Code><?php echo(htmlspecialchars($sender[0]));?></smev:Code>
               <smev:Name><?php echo(htmlspecialchars($sender[1]));?></smev:Name>
            </smev:Originator>
            <smev:TypeCode>GFNC</smev:TypeCode>
            <smev:Status>REQUEST</smev:Status>
            <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
            <smev:ExchangeType>6</smev:ExchangeType>
            <smev:CaseNumber>139823954263469811</smev:CaseNumber>
            <!-- <smev:TestMsg>Первичный запрос</smev:TestMsg> -->
         </smev:Message>
         <smev:MessageData>
            <smev:AppData>
               <unifo:exportData xmlns:unifo="http://rosrazna.ru/xsd/SmevUnifoService" xmlns:pdrq="http://roskazna.ru/xsd/PGU_DataRequest" xmlns:pirq="http://roskazna.ru/xsd/PGU_ImportRequest">
                  <pdrq:DataRequest kind="CHARGESTATUS">
                     <PostBlock>
                        <ID>e6aaca35-377a-4dbd-960e-5b1c3acaf304</ID>
                        <TimeStamp><?php echo(htmlspecialchars($nowTimeWithFormat));?></TimeStamp>
                        <SenderIdentifier>363566</SenderIdentifier>
                     </PostBlock>
		     <?php
			if(!empty($_POST["uinCheck"]) && $_POST["uinCheck"] == "on") {			
		     ?>
		     <SupplierBillIDs>
			<SupplierBillID><?php echo $_POST["uin"]?></SupplierBillID>
		     </SupplierBillIDs>
		     <?php
			}else{			
		     ?>
                     <?php
			     if(!empty($_POST["startDate"])) {	
				$start_date = explode('-', $_POST["startDate"]);
				echo "<StartDate>".$start_date[2].'-'.$start_date[1].'-'.$start_date[0]."T00:00:00.000</StartDate>";	 
			     }
		     ?>
                     <?php 
	       		     if(!empty($_POST["endDate"])) {			
			     	$end_date = explode('-', $_POST["endDate"]);
				echo "<EndDate>".$end_date[2].'-'.$end_date[1].'-'.$end_date[0]."T00:00:00.000</EndDate>";
			     }
		     ?>
                     <Payers>
                        <PayerIdentifier><?php 	
					//0100000000000004444444643				
					$name_mas['01'] = "doc_passport_type";
					$name_mas['02'] = "doc_birthDayChildren_type";
					$name_mas['03'] = "doc_passportSeaman_type";
					$name_mas['04'] = "doc_military_type";
					$name_mas['05'] = "doc_militaryID_type";
					$name_mas['06'] = "doc_temporaryCertificate_type";
					$name_mas['07'] = "doc_referenceDeprivation_type";
					$name_mas['08'] = "doc_passportForeignCitizen_type";
					$name_mas['09'] = "doc_residencePermit_type";
					$name_mas['10'] = "doc_temporaryStay_type";
					$name_mas['11'] = "doc_refugee_type";
					$name_mas['12'] = "doc_migrationCard_type";
					$name_mas['13'] = "doc_passportUSSR_type";
					$name_mas['21'] = "INNFL";
					$name_mas['22'] = "doc_driverLicense_type";
					$name_mas['23'] = "doc_registrationCodeFMS_type";
					$name_mas['24'] = "doc_register_type";									
					if(!empty($_POST))  {
						if ($_POST["typeDocuments"] == 20) {
							$result = preg_replace("([^0-9])", "", $_POST["SNILS"]);
							echo "1".$result; 
						} 
						else if ($_POST["typeDocuments"] <= 13) {
							$ind_mas = $_POST["typeDocuments"];
							$name = $name_mas[$ind_mas];
							$num_doc = $_POST[$name];
							//$num_doc = preg_replace("([^0-9])", "", $num_doc);	//   ??????????????????????
							$str = "";
							$lth = strlen(utf8_decode($num_doc));
							if ($lth < 20) {
								$lth = 20 - $lth;
								for ($i = 0; $i < $lth; $i++ ) {
									$str.="0";
								}
							}							
							//if(strlen($num_doc)<20) {							
							//echo $_POST["typeDocuments"].str_pad($num_doc, 20, "0", STR_PAD_LEFT).$_POST["citizenship"];
							echo $_POST["typeDocuments"].$str.$num_doc.$_POST["citizenship"];
							//}							
						}
						else if ($_POST["typeDocuments"] > 20 && $_POST["typeDocuments"]<=24) {
							$ind_mas = $_POST["typeDocuments"];
							$name = $name_mas[$ind_mas];							
							$num_doc = $_POST[$name];
							//$num_doc = preg_replace("([^0-9])", "", $num_doc);	//  ??????????????????????
							/*if(strlen($num_doc)<20)  {
								echo $_POST["typeDocuments"].str_pad($num_doc, 20, "0", STR_PAD_LEFT)."643";	
							}*/
							$str = "";	
							$lth = strlen(utf8_decode($num_doc));
							if ($lth < 20) {
								$lth = 20 - $lth;
								for ($i = 0; $i < $lth; $i++ ) {
									$str.="0";
								}
							}
							echo $_POST["typeDocuments"].$str.$num_doc."643";
						}
					}	
				?></PayerIdentifier>
                     </Payers>
		     <?php
			}			
		     ?>
                  </pdrq:DataRequest>
               </unifo:exportData>
            </smev:AppData>
         </smev:MessageData>
      </SOAP-WS:UnifoTransferMsg>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>