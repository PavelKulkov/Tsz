<?php 
	  $subservice_url_id = 71;
	  $sign = false;
      $soapAction = "urn:listBenefits";
?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:q0="urn:bars-web-dou" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <soapenv:Body>
    <q0:listBenefits>
      <q0:ocatoCode>56000000000</q0:ocatoCode>
    </q0:listBenefits>
  </soapenv:Body>
</soapenv:Envelope>