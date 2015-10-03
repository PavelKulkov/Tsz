<?php 
      $soapAction = "urn:sendQuery";

?>


<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/minaid/guardian/citizen" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">


<soapenv:Body>

  <smev:sendQuery>

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
        <smev:ServiceCode>RegistrationCareByHumanService</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>

  <smev:MessageData>

  <smev:AppData>

  <q1:queryData>

  <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding> 

  <q1:contact>

  <q2:phone><?php echo $_POST['phone']; ?></q2:phone> 

  <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail> 

  </q1:contact>

  <q1:dateWard><?php echo $_POST['dateWard']; ?></q1:dateWard> 

  <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO> 

  <q1:FIOward><?php echo $_POST['FIOward']; ?></q1:FIOward> 

  <q1:flagLiveTogetherDesicion><?php echo (($_POST['flagLiveTogetherDesicion'] == "on") ? 'true' : 'false'); ?></q1:flagLiveTogetherDesicion> 

  <q1:flagMarriage><?php echo (($_POST['flagMarriage'] == "on") ? 'true' : 'false'); ?></q1:flagMarriage> 

  <q1:flagTraining><?php echo (($_POST['flagTraining'] == "on") ? 'true' : 'false'); ?></q1:flagTraining> 

  <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument> 

  <q1:officeName><?php echo $_POST['officeName']; ?></q1:officeName> 

  <q1:SNILS><?php echo $_POST['SNILS']; ?></q1:SNILS> 

  </q1:queryData>

  <q3:systemparams>

  <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id>
  
  <q3:form_id>5</q3:form_id>
  
  <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date> 

  </q3:systemparams>

  </smev:AppData>

  <smev:AppDocument>

  <smev:RequestCode/> 

  <smev:BinaryData><?php echo ($attachment->data); ?></smev:BinaryData>

  </smev:AppDocument>

  </smev:MessageData>

  </smev:sendQuery>

  </soapenv:Body>

  </soapenv:Envelope>