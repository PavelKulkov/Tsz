<?php 

      $soapAction = "urn:listKindergartens";
?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:q0="urn:bars-web-dou" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <soapenv:Body>
    <q0:listKindergartens>
      <q0:ocatoCode>56000000000</q0:ocatoCode>
      <q0:node_id><?php echo $_GET['district']; ?></q0:node_id>
    </q0:listKindergartens>
  </soapenv:Body>
</soapenv:Envelope>