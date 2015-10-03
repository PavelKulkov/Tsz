<?php 
	$subservice_url_id = 107;
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
   <soapenv:Body wsu:Id="body" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
      <mfc:RequestData xmlns:mfc="http://mfcinfo.ru/">
         <smev:Message xmlns:smev="http://smev.gosuslugi.ru/rev120315">
            <smev:Sender>
               <smev:Code>MFCR01581</smev:Code>
               <smev:Name>ГАУ "МФЦ" г. Пенза</smev:Name>
            </smev:Sender>
            <smev:Recipient>
               <smev:Code />
               <smev:Name />
            </smev:Recipient>
            <smev:ServiceName />
            <smev:TypeCode>GSRV</smev:TypeCode>
            <smev:Status>REQUEST</smev:Status>
            <smev:Date>2015-02-05T10:10:03.000+03:00</smev:Date>
            <smev:ExchangeType>2</smev:ExchangeType>
         </smev:Message>
         <smev:MessageData xmlns:smev="http://smev.gosuslugi.ru/rev120315">
            <smev:AppData>
               <mfc:Function name="get_request_list" version="1.0" paramcount="1" assoc="1">
                  <Param name="snils" type="string"><?php echo $_POST['SNILS']; ?></Param>
               </mfc:Function>
            </smev:AppData>
         </smev:MessageData>
      </mfc:RequestData>
   </soapenv:Body>
</soapenv:Envelope>