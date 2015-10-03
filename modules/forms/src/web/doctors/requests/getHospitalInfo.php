<?php 
	  $subservice_url_id = 91;
      $soapAction = "urn:getHospitalInfo";
?>

<SOAP-ENV:Envelope xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="tns" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
   <SOAP-ENV:Header/>
   <ns0:Body>
      <ns1:getHospitalInfo>
         <ns1:parameters>
            <ns1:hospitalUid><?php echo $hospital_id; ?></ns1:hospitalUid>
         </ns1:parameters>
      </ns1:getHospitalInfo>
   </ns0:Body>
</SOAP-ENV:Envelope>
