<?php 
      $soapAction = "urn:sendQuery";

?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:rev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

<soapenv:Body>
        <rev:sendQuery>
		
        <rev:Message>
            <rev:Sender>
                <rev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></rev:Code>
                <rev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></rev:Name>
            </rev:Sender>
            <rev:Recipient>
                <rev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></rev:Code>
                <rev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></rev:Name>
            </rev:Recipient>
            <rev:Originator>
                <rev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></rev:Code>
                <rev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></rev:Name>
            </rev:Originator>
            <rev:ServiceName>IPGUSERVICE55813001</rev:ServiceName>
            <rev:TypeCode>GSRV</rev:TypeCode>
            <rev:Status>REQUEST</rev:Status>
            <rev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></rev:Date>
            <rev:ExchangeType>1</rev:ExchangeType>
            <rev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></rev:RequestIdRef>
            <rev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></rev:OriginRequestIdRef>
            <rev:ServiceCode>5800000010000013041</rev:ServiceCode>
            <rev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></rev:CaseNumber>
        </rev:Message>
		
	  
        <rev:MessageData>
                <rev:AppData>
                <q1:queryData xmlns:q1="http://attestation.rank.minaid.oep.com/" xmlns:q2="http://oep-penza.ru/com/oep/declarant">
    <q1:addressRegister><?php echo $_POST['addressRegister']; ?></q1:addressRegister>
    <q1:applicantType><?php echo $_POST['applicantType']; ?></q1:applicantType>
    <q1:categoryQualification><?php echo $_POST['categoryQualification']; ?></q1:categoryQualification>
    <q1:contacts>
        <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
        <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
    </q1:contacts>
	  <?php $dateCategory = explode('-', $_POST['dateCategory']); ?>
	  
        <q1:dateCategory>
		<?php echo $dateCategory[2].'-'.$dateCategory[1].'-'.$dateCategory[0]; ?>
		</q1:dateCategory>
        <q1:pastCategory><?php echo $_POST['pastCategory']; ?></q1:pastCategory>
    <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
    <q1:flagEarlierAppropriateCategory>
	<?php echo ($_POST['flagEarlierAppropriateCategory']  == "on") ? 'true' : 'false'; ?>
	</q1:flagEarlierAppropriateCategory>
    <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument>
    <q1:jobPlace><?php echo $_POST['jobPlace']; ?></q1:jobPlace>
    <q1:timeLengthJob><?php echo $_POST['timeLengthJob']; ?></q1:timeLengthJob>
</q1:queryData>
<q3:systemParams xmlns:q3="http://oep-penza.ru/com/oep">
  <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id>
  <q3:form_id>18</q3:form_id> 
  <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date>
</q3:systemParams>
                </rev:AppData>
<rev:AppDocument>
  <rev:RequestCode/> 
  <rev:BinaryData><?php echo ($attachment->data);?></rev:BinaryData> 
  </rev:AppDocument>
        </rev:MessageData>
        </rev:sendQuery>
    </soapenv:Body>
</soapenv:Envelope>