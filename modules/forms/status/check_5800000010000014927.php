<?php 
      $soapAction = "urn:doQuery";

?>

  
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/minaid/finance/pensioner" xmlns:q2="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">


<soapenv:Body xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" wsu:Id="doQuery">

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
        <smev:Status>PING</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
        <smev:ExchangeType/>
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>FundAidPensionerService</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
 
  </smev:Message>

  <smev:MessageData>

  <smev:AppData>

  <q1:queryData>

  <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO> 

  <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument> 

  <q1:officeName><?php echo $_POST['officeName']; ?></q1:officeName> 

  <q1:phone><?php echo $_POST['phone']; ?></q1:phone> 

  <q1:SNILS><?php echo $_POST['SNILS']; ?></q1:SNILS> 

  </q1:queryData>

  <q2:inParams>

  <q2:app_id><?php echo(htmlspecialchars($idRequest));?></q2:app_id> 

  <q2:form_id>8</q2:form_id> 

  <q2:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q2:status_date> 

  </q2:inParams>

  </smev:AppData>

  <smev:AppDocument>

  <smev:RequestCode/> 

  <smev:BinaryData><?php echo ($attachment->data); ?></smev:BinaryData> 

  </smev:AppDocument>

  </smev:MessageData>

  </smev:doQuery>

  </soapenv:Body>

  </soapenv:Envelope>