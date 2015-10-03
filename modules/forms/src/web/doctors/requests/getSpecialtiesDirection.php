<?php 
	  $subservice_url_id = 90;
      $soapAction = "urn:listSpecialities";
?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tns="tns" xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="tns" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
   <soapenv:Header/>
   <soapenv:Body>
      <tns:listSpecialities>
         <tns:parameters>
            <tns:hospitalUid><?php echo $subdivision_id; ?></tns:hospitalUid>
         </tns:parameters>
      </tns:listSpecialities>
   </soapenv:Body>
</soapenv:Envelope>