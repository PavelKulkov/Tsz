<?php
	$subservice_url_id = 95;
	$soapAction = "urn:adoptionStatement";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:dec="Declaration.xsd" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:inc="http://www.w3.org/2004/08/xop/include" xmlns:ser="http://service/" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:tinf="TransitInfo.xsd" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
   
   <soapenv:Body wsu:Id="StiId-6ea6f04e000000004534'">
      <ser:adoptionStatement>
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
				<smev:ServiceName>adoptionStatement</smev:ServiceName>
               <smev:TypeCode>GSRV</smev:TypeCode>
               <smev:Status>PING</smev:Status>               
               <smev:Date><?php echo htmlspecialchars(time());?></smev:Date>
               <smev:ExchangeType>2</smev:ExchangeType>               
               <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>		       
		       <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
               
               <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
           </smev:Message>
         <smev:MessageData>
         <smev:AppData>
     
             </smev:AppData>
          </smev:MessageData>
      </ser:adoptionStatement>
   </soapenv:Body>
</soapenv:Envelope>