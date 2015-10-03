<!-- Предоставление путёвок детям, находящимся в трудной жизненной ситуации, в организации отдыха детей и их оздоровления  -->

<?php 
      $soapAction = "urn:doRequest";

?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/minaid/trip/child" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">


<soap:Body>
      <smev:doRequest>
         <smev:Message>
            <smev:Sender>
               <smev:Code><?php echo(htmlspecialchars($sender[0]));?></smev:Code>
               <smev:Name><?php echo(htmlspecialchars($sender[1]));?></smev:Name>
            </smev:Sender>
            <smev:Recipient>
               <smev:Code><?php echo(htmlspecialchars($sender[0]));?></smev:Code>
               <smev:Name><?php echo(htmlspecialchars($sender[1]));?></smev:Name>
            </smev:Recipient>
            <smev:Originator>
               <smev:Code><?php echo(htmlspecialchars($sender[0]));?></smev:Code>
               <smev:Name><?php echo(htmlspecialchars($sender[1]));?></smev:Name>
            </smev:Originator>
            <smev:ServiceName>SanatoryActService</smev:ServiceName>
            <smev:TypeCode>GSRV</smev:TypeCode>
            <smev:Status>REQUEST</smev:Status>
            <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
            <smev:ExchangeType>111111111111</smev:ExchangeType>
            <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
            <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
            <smev:ServiceCode>111111111</smev:ServiceCode>
            <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
         </smev:Message>
         <smev:MessageData>
            <smev:AppData>
               <q1:querySanatory>
                  <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding>
                  <q1:contacts>
                     <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
                  </q1:contacts>
                  <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
                  <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument>
                  <q1:officeName><?php echo $_POST['officeName']; ?></q1:officeName>
                  <q1:queryChilds>
                     <q1:campName><?php echo $_POST['campName']; ?></q1:campName>
                     <q1:campType><?php echo $_POST['campType']; ?></q1:campType>
                     <q1:change><?php echo $_POST['change']; ?></q1:change>
                     <q1:childAddress><?php echo $_POST['childAddress']; ?></q1:childAddress>
                     <q1:childBirthDay><?php echo $_POST['childBirthDay']; ?></q1:childBirthDay>
                     <q1:childFIO><?php echo $_POST['childFIO']; ?></q1:childFIO>
                  </q1:queryChilds>
               </q1:querySanatory>
               <q3:inParams>
				  <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id> 
				  <q3:form_id>23</q3:form_id> 
				  <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date> 
               </q3:inParams>
            </smev:AppData>
            <smev:AppDocument>
               <smev:RequestCode />
               <smev:BinaryData><?php echo ($attachment->data);?></smev:BinaryData>
            </smev:AppDocument>
         </smev:MessageData>
      </smev:doRequest>
   </soapenv:Body>
</soapenv:Envelope>