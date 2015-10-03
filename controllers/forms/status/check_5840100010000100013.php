<?php 
      $soapAction = "urn:doRequestForUr";

?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/estate/register" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">


<soapenv:Body>
  <smev:doQueryUr>
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
        <smev:TypeCode>GSRV</smev:TypeCode>
        <smev:Status>PING</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
        <smev:ExchangeType/>
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>FundWomenService</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>
  
  <smev:MessageData>
  <smev:AppData>
  <q1:queryUrData>
  <q1:contact>
  <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
  <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>  
  </q1:contact>
  <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO> 
  <q1:organizationAddress><?php echo $_POST['organizationAddress']; ?></q1:organizationAddress> 
  <q1:organizationFirmName><?php echo $_POST['organizationFirmName']; ?></q1:organizationFirmName> 
  <q1:organizationName><?php echo $_POST['organizationName']; ?></q1:organizationName> 
  <q1:organizationShortName><?php echo $_POST['organizationShortName']; ?></q1:organizationShortName> 
  <q1:post><?php echo $_POST['post']; ?></q1:post> 
  <q1:statementNumber><?php echo $_POST['statementNumber']; ?></q1:statementNumber> 
  </q1:queryUrData>
  <q1:queryData>
  <q1:objectQuery>

  <?php 
	
	for ($i=1; $i <= $_POST['countInfoObject']; $i++) {
	
	echo '
  <q1:name>'.$_POST['name_'.$i].'</q1:name>
  <q1:address>'.$_POST['address_'.$i].'</q1:address>
  <q1:type>'.$_POST['type_'.$i].'</q1:type>
  <q1:square>'.$_POST['square_'.$i].'</q1:square>
  <q1:length>'.$_POST['length_'.$i].'</q1:length>
  <q1:construction>'.$_POST['construction_'.$i].'</q1:construction>';
	}
	 
  ?>
  
  </q1:objectQuery>
  </q1:queryData>
  <q3:inParams>
  <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id> 
  <q3:form_id>1</q3:form_id> 
  <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date> 
  </q3:inParams>
  </smev:AppData>
  <smev:AppDocument>
  <smev:RequestCode/> 
  <smev:BinaryData><?php echo ($attachment->data); ?></smev:BinaryData>
  </smev:AppDocument>
  </smev:MessageData>
  </smev:doQueryUr>
  </soapenv:Body>
  </soapenv:Envelope>