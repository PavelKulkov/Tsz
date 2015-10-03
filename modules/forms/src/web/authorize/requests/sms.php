<?php 
	$subservice_url_id = 94;
	$soapAction = "urn:sendSMS";
	if (!isset($idRequest)) $idRequest="";
	if (!isset($forms)) $forms=null;
	if (!isset($sms_text)||!isset($sms_text)) die("Отсутствуют обязательные параметры");
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:rev="http://smev.gosuslugi.ru/rev120315" xmlns:inc="http://www.w3.org/2004/08/xop/include" xmlns:oep="http://oep-penza.ru/com/oep">
   <soapenv:Body>
      <rev:sendSMS>
	        <rev:Message>
		        <rev:Sender>
		          <rev:Code><?php echo(htmlspecialchars($sender[0]));?></rev:Code>
		          <rev:Name><?php echo(htmlspecialchars($sender[1]));?></rev:Name>
		        </rev:Sender>
		        <rev:Recipient>
		          <rev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></rev:Code>
		          <rev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></rev:Name>
		        </rev:Recipient>
		        <rev:Originator>
		          <rev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></rev:Code>
		          <rev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></rev:Name>
		        </rev:Originator>
		        <rev:TypeCode>GSRV</rev:TypeCode>
		        <rev:Status>REQUEST</rev:Status>
		        <rev:Date>2012-11-12T11:06:52.433Z</rev:Date>
		        <rev:ExchangeType/>
		        <rev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></rev:RequestIdRef>
		        <rev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></rev:OriginRequestIdRef>
		        <rev:ServiceCode>SMSService</rev:ServiceCode>
		        <rev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></rev:CaseNumber>
	      </rev:Message>
         <!--Optional:-->
         <rev:MessageData>
          <rev:AppData>
             <oep:result>
                  <oep:dataRow>
                     <oep:name>text</oep:name>
                     <oep:value><?php echo $sms_text;?></oep:value>
                  </oep:dataRow>
                  <oep:dataRow>
                     <oep:name>phone</oep:name>
                     <oep:value><?php echo $phone?></oep:value>
                  </oep:dataRow>
                   <oep:params>
                     <oep:app_id>0</oep:app_id>
                  </oep:params>
               </oep:result>
            </rev:AppData>
         </rev:MessageData>
      </rev:sendSMS>
   </soapenv:Body>
</soapenv:Envelope>