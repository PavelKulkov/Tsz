<?php 
      $soapAction = "urn:doQuery";

?>

<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:q1="http://oep-penza.ru/com/oep/nature/issue/hunter" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">  

<soap:Body>
<smev:doQuery>
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
        <smev:Status>REQUEST</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
        <smev:ExchangeType/>
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>issue-hunter</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>
      
      
  <smev:MessageData>
    <smev:AppData>
      <q1:queryData>
        <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding>
        <?php 
        	$birth_arr = explode('-', $_POST['birthDay']);
        	$birth = $birth_arr[2].'-'.$birth_arr[1].'-'.$birth_arr[0];
        ?>
        <q1:birthDay><?php echo $birth.'T16:36:30.228Z'; ?></q1:birthDay>
        <q1:birthPlace><?php echo $_POST['birthPlace']; ?></q1:birthPlace>
        <q1:contact>
          <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
          <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
        </q1:contact>
        <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
        <q1:flagHuntingTicketAvailable><?php echo ($_POST['flagHuntingTicketAvailable']  == "on") ? 'true' : 'false'; ?></q1:flagHuntingTicketAvailable>
        <q1:huntServiceType><?php echo $_POST['huntServiceType']; ?></q1:huntServiceType>
        <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument>
        <q1:jobPlace><?php echo $_POST['jobPlace']; ?></q1:jobPlace>
      </q1:queryData>
      <q3:inParams>
  			<q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id> 
  			<q3:form_id>1</q3:form_id> 
	  		<q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date> 
  		</q3:inParams>
    </smev:AppData>
    <smev:AppDocument>
          <smev:RequestCode/>
          <smev:BinaryData><?php echo($attachment->data);?></smev:BinaryData>
        </smev:AppDocument>
  	</smev:MessageData>
	</smev:doQuery>

  </soap:Body>

  </soap:Envelope>
