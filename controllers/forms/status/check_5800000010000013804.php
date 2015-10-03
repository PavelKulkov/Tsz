<?php 
      $soapAction = "urn:doOnce1Query";

?>

<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/minaid/finance/child" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">


<soap:Body>

  <smev:doOnce1Query>

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
          <smev:ExchangeType>33333333333</smev:ExchangeType> 
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>FundChildAidService</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>

  <smev:MessageData>

  <smev:AppData>

  <q1:queryData>

  <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding> 

  <q1:contacts>

  <q2:phone><?php echo $_POST['phone']; ?></q2:phone> 

  <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>

  </q1:contacts>

  <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO> 

  <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument> 

  <q1:officeName><?php echo $_POST['officeName']; ?></q1:officeName> 

  </q1:queryData>

  <q1:marriageData>

  <q1:childInfo>

  <?php $childBirthDayArr = explode('-', $_POST['childBirthDay']); ?>
 
  <q1:childBirthDay><?php echo $childBirthDayArr[2].'-'.$childBirthDayArr[1].'-'.$childBirthDayArr[0]; ?></q1:childBirthDay> 

  <q1:childFIO><?php echo $_POST['childFIO']; ?></q1:childFIO> 

  </q1:childInfo>

  </q1:marriageData>

  <q3:inParams>

  <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id> 

  <q3:form_id>25</q3:form_id> 

  <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date> 

  </q3:inParams>

  </smev:AppData>

  <smev:AppDocument>

  <smev:RequestCode/> 

  <smev:BinaryData><?php echo ($attachment->data);?></smev:BinaryData> 

  </smev:AppDocument>

  </smev:MessageData>

  </smev:doOnce1Query>

  </soap:Body>

  </soap:Envelope>