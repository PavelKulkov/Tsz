<?php 
  $soapAction = 'urn:sendQuery';
?>
<soap:Envelope xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/' xmlns:ds='http://www.w3.org/2000/09/xmldsig#'
  xmlns:q1='http://oep-penza.ru/com/oep/edu/guardian/child'
  xmlns:q2='http://oep-penza.ru/com/oep/declarant'
  xmlns:q3='http://oep-penza.ru/com/oep'
  xmlns:smev='http://smev.gosuslugi.ru/rev120315' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'>
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
        <smev:Status>PING</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
        <smev:ExchangeType>33333333333</smev:ExchangeType>
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>LearnAct</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>
      <smev:MessageData>
        <smev:AppData>
          <q1:queryData>
            <q1:officeName><?php echo $_POST['officeName']; ?></q1:officeName>
            <q1:childInfo>
              <q1:childFIO><?php echo $_POST['childFIO']; ?></q1:childFIO>
              <q1:childBirthDay><?php echo $_POST['childBirthDay']; ?></q1:childBirthDay>
              <q1:birthDayChildrenDocumentScan><?php echo $_POST['birthDayChildrenDocumentScan']; ?></q1:birthDayChildrenDocumentScan>
            </q1:childInfo>
            <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
            <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument>
            <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding>
            <q1:SNILS><?php echo $_POST['SNILS']; ?></q1:SNILS>
            <q1:contact>
              <q1:phone><?php echo $_POST['phone']; ?></q1:phone>
              <q1:eMail><?php echo $_POST['eMail']; ?></q1:eMail>
            </q1:contact>
            <q1:flagMarriage><?php echo $_POST['flagMarriage']; ?></q1:flagMarriage>
            <q1:flagTraining><?php echo $_POST['flagTraining']; ?></q1:flagTraining>
            <q1:flagLiveTogetherDesicion><?php echo $_POST['flagLiveTogetherDesicion']; ?></q1:flagLiveTogetherDesicion>
            <q1:identityDocumentScan><?php echo $_POST['identityDocumentScan']; ?></q1:identityDocumentScan>
            <q1:petitionDocumentScan><?php echo $_POST['petitionDocumentScan']; ?></q1:petitionDocumentScan>
            <q1:incomeDocumentsScan><?php echo $_POST['incomeDocumentsScan']; ?></q1:incomeDocumentsScan>
            <q1:conclusionsDoctorsDocumentsScan><?php echo $_POST['conclusionsDoctorsDocumentsScan']; ?></q1:conclusionsDoctorsDocumentsScan>
            <q1:marriageDocumentScan><?php echo $_POST['marriageDocumentScan']; ?></q1:marriageDocumentScan>
            <q1:approvalFamilyMembersScan><?php echo $_POST['approvalFamilyMembersScan']; ?></q1:approvalFamilyMembersScan>
            <q1:trainingDocumentScan><?php echo $_POST['trainingDocumentScan']; ?></q1:trainingDocumentScan>
            <q1:autobiographyDocumentScan><?php echo $_POST['autobiographyDocumentScan']; ?></q1:autobiographyDocumentScan>
            <q1:otherDocumentsScan><?php echo $_POST['otherDocumentsScan']; ?></q1:otherDocumentsScan>
          </q1:queryData>
          <q3:inParams>
            <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id>
            <q3:form_id></q3:form_id>
            <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date>
          </q3:inParams>
        </smev:AppData>
        <smev:AppDocument>
          <smev:RequestCode/>
          <smev:BinaryData><?php echo ($attachment->data);?></smev:BinaryData>
        </smev:AppDocument>
      </smev:MessageData>
    </smev:doQuery>
  </soap:Body>
</soap:Envelope>
