<?php 
	  $subservice_url_id = 90;
      $soapAction = "urn:listHospitals";
?>

<SOAP-ENV:Envelope xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="tns" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
   <SOAP-ENV:Header/>
   <ns0:Body>
      <ns1:listHospitals>
         <ns1:parameters>
            <ns1:ocatoCode><?php echo $ocatoCode; ?></ns1:ocatoCode>
         </ns1:parameters>
      </ns1:listHospitals>
   </ns0:Body>
</SOAP-ENV:Envelope>
