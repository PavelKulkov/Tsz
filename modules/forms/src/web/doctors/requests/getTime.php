<?php 
	  $subservice_url_id = 92;
      $soapAction = "urn:getScheduleInfo";
?>

<SOAP-ENV:Envelope xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="tns" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
   <SOAP-ENV:Header/>
   <ns0:Body>
      <ns1:getScheduleInfo>
         <ns1:parameters>
         	<ns1:startDate><?php echo $startDate; ?></ns1:startDate>
            <ns1:endDate><?php echo $endtDate; ?></ns1:endDate>
         
            <ns1:doctorUid><?php echo $doctorId; ?></ns1:doctorUid>
            <ns1:hospitalUid><?php echo $hospitalId; ?></ns1:hospitalUid>
         </ns1:parameters>
      </ns1:getScheduleInfo>
   </ns0:Body>
</SOAP-ENV:Envelope>