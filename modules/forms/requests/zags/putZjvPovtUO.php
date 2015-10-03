<?php
	$subservice_url_id = 100;
	$soapAction = "urn:ZagsService";
?>

<S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">

    <S:Body wsu:Id="body">
        <ns2:ZagsService xmlns:ns2="http://smev.gosuslugi.ru/rev120315" xmlns:ns3="http://idecs.nvg.ru/privateoffice/ws/types/" xmlns:ns4="http://wsService.zags.com/" xmlns:typ="http://idecs.nvg.ru/privateoffice/ws/types/">
            <ns2:Message>
                <ns3:Sender>
                    <ns3:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></ns3:Code>
                    <ns3:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></ns3:Name>
                </ns3:Sender>
                <ns2:Recipient>
                    <ns2:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></ns2:Code>
                    <ns2:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></ns2:Name>
                </ns2:Recipient>
                <ns2:Originator>
                    <ns2:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></ns2:Code>
                    <ns2:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></ns2:Name>
                </ns2:Originator>
                <ns2:ServiceName>Запрос в орган ЗАГС</ns2:ServiceName>
                <ns2:TypeCode>GFNC</ns2:TypeCode>
                <ns2:Status>REQUEST</ns2:Status>
                <ns2:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></ns2:Date>
                <ns2:ExchangeType>2</ns2:ExchangeType>
                <ns2:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></ns2:RequestIdRef>
                <ns2:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></ns2:OriginRequestIdRef>
                <ns2:ServiceCode>000000001</ns2:ServiceCode>
                <ns2:CaseNumber><?php echo(htmlspecialchars($idRequest));?></ns2:CaseNumber>
                <ns2:TestMsg>true</ns2:TestMsg>
            </ns2:Message>
            <ns2:MessageData>
                <ns2:AppData>
                    <wsZagsPovtUO>
                        <putZjvPovtUO>
                            <use>true</use>
                            <zjv>
								<reservedNakhodka>without-sending-status</reservedNakhodka>
                                <idZags><?php echo $_POST['id_agency_in']; ?></idZags>
                                <email><?php echo $_POST['contact_email']; ?></email>
                                <zjvl>
                                    <fio>
                                        <fam><?php echo $_POST['declarant_type_lastname']; ?></fam>
                                        <nam><?php echo $_POST['declarant_type_firstname']; ?></nam>
                                        <otch><?php echo $_POST['declarant_type_middlename']; ?></otch>
                                    </fio>
                                    <pol><?php echo $_POST['declarant_sex']; ?></pol>
                                    <docum>
                                        <nam><?php echo $_POST['declarant_type_docs']; ?></nam>
                                        <seria><?php echo $_POST['declarant_type_doc_ser']; ?></seria>
                                        <num><?php echo $_POST['declarant_type_doc_number']; ?></num>
										<?php $documDate = explode("-",$_POST['declarant_type_doc_date']); ?>
                                        <dat>
											<dtDay><?php echo $documDate[0]; ?></dtDay>
											<dtMonth><?php echo $documDate[1]; ?></dtMonth>
											<dtYear><?php echo $documDate[2]; ?></dtYear>
                                        </dat>
                                        <ovd><?php echo $_POST['declarant_type_doc_place']; ?></ovd>
                                    </docum>
									
									
									<?php 
									
											$zjvlPerson = "";
												$country = $_POST['declarant_type_country'];
												if ($_POST['declarant_type_isHand'] == "on"){
													$state = $_POST['declarant_type_state'];
													$region = $_POST['declarant_type_region'];
													$settlement = $_POST['declarant_type_settlement'];
													$settlement_type = $_POST['declarant_type_settlement_type'];
													$street = $_POST['declarant_type_street'];
													$typeStr = $_POST['declarant_type_street_type'];
												}else{
													$state = $_POST['declarant_type_state_Rus'];
													$region = $_POST['declarant_type_settlementParent_Rus'];
													$settlement = $_POST['declarant_type_settlement_Rus'];
													$settlement_type = "";
													$street = $_POST['declarant_type_street_Rus'];
													$typeStr = "";
												}
												$city = $_POST['declarant_type_city'];

												$zjvlPerson .= "<gos>".$country."</gos>";
												$zjvlPerson .= "<subGos>".$state."</subGos>";
												$zjvlPerson .= "<rayon>".$region."</rayon>";
												$zjvlPerson .= "<gorod>".$city."</gorod>";
												$zjvlPerson .= "<nasPun>".$settlement."</nasPun>";
												$zjvlPerson .= "<typeNP>".$settlement_type."</typeNP>";
												$zjvlPerson .= "<street>".$street."</street>";
												$zjvlPerson .= "<typeStr>".$typeStr."</typeStr>";
												$zjvlPerson .= "<house>".$_POST['house_person']."</house>";
												$zjvlPerson .= "<korp>".$_POST['case_person']."</korp>";
												$zjvlPerson .= "<kvart>".$_POST['apart_person']."</kvart>";
											
											?>

                                    <mestoLive><?php echo $zjvlPerson; ?></mestoLive>
									
                                </zjvl>
                                <docKind><?php echo $_POST['document_type']; ?></docKind>
                                <namZagsTo><?php echo $_POST['namZagsTo']; ?></namZagsTo>
								
									<?php 
									
											$adrZagsTo = "";
												$country = $_POST['zags_type_country'];
												if ($_POST['zags_type_isHand'] == "on"){
													$state = $_POST['zags_type_state'];
													$region = $_POST['zags_type_region'];
													$settlement = $_POST['zags_type_settlement'];
													$settlement_type = $_POST['zags_type_settlement_type'];
													$street = $_POST['zags_type_street'];
													$typeStr = $_POST['zags_type_street_type'];
												}else{
													$state = $_POST['zags_type_state_Rus'];
													$region = $_POST['zags_type_settlementParent_Rus'];
													$settlement = $_POST['zags_type_settlement_Rus'];
													$settlement_type = "";
													$street = $_POST['zags_type_street_Rus'];
													$typeStr = "";
												}
												$city = $_POST['zags_type_city'];

												$adrZagsTo .= "<gos>".$country."</gos>";
												$adrZagsTo .= "<subGos>".$state."</subGos>";
												$adrZagsTo .= "<rayon>".$region."</rayon>";
												$adrZagsTo .= "<gorod>".$city."</gorod>";
												$adrZagsTo .= "<nasPun>".$settlement."</nasPun>";
												$adrZagsTo .= "<typeNP>".$settlement_type."</typeNP>";
												$adrZagsTo .= "<street>".$street."</street>";
												$adrZagsTo .= "<typeStr>".$typeStr."</typeStr>";
												$adrZagsTo .= "<house>".$_POST['house_person']."</house>";
												$adrZagsTo .= "<korp>".$_POST['case_person']."</korp>";
												$adrZagsTo .= "<kvart>".$_POST['apart_person']."</kvart>";
											
											?>
											
											
                                <adrZagsTo><?php echo $adrZagsTo; ?></adrZagsTo>
                                <docUO>
                                    <num><?php echo $_POST['uo_akt_num']; ?></num>
									  <dat>
											<?php $docRB = explode("-",$_POST['uo_akt_date']); ?>
											<dtDay><?php echo $docRB[0]; ?></dtDay>
											<dtMonth><?php echo $docRB[1]; ?></dtMonth>
											<dtYear><?php echo $docRB[2]; ?></dtYear>
									  </dat>
                                    <zgs><?php echo $_POST['uo_akt_zags']; ?></zgs>
                                    <childDo>
                                        <fam><?php echo $_POST['child_fatherhood_before_last_name']; ?></fam>
                                        <nam><?php echo $_POST['child_fatherhood_before_first_name']; ?></nam>
                                        <otch><?php echo $_POST['child_fatherhood_before_middle_name']; ?></otch>
                                    </childDo>
                                    <childDatRojd>
										<?php $docRB = explode("-",$_POST['fatherhood_child_birth_date']); ?>
										<dtDay><?php echo $docRB[0]; ?></dtDay>
										<dtMonth><?php echo $docRB[1]; ?></dtMonth>
										<dtYear><?php echo $docRB[2]; ?></dtYear>
                                    </childDatRojd>
									
									  <childMestoRojd>
										<?php
											$country = $_POST['child_country'];
											 if ($_POST['child_state_hand_input'] == "on"){
												$state = $_POST['child_state'];
												$region = $_POST['child_region'];
												$settlement = $_POST['child_settlement'];
												$settlement_type = $_POST['child_settlement_type'];
											 }else{
												$state = $_POST['child_region_kladr'];
												$region = $_POST['child_settlementParent_kladr'];
												$settlement = $_POST['child_settlement_kladr'];
												$settlement_type = "";
											 }
											 $city = $_POST['child_place'];
										?>
										<gos><?php echo $country; ?></gos>
										<subGos><?php echo $state; ?></subGos>
										<rayon><?php echo $region; ?></rayon>
										<gorod><?php echo $city; ?></gorod>
										<nasPun><?php echo $settlement; ?></nasPun>
										<typeNP><?php echo $settlement_type; ?></typeNP>
									  </childMestoRojd>
									
                                    <fath>
                                        <fam><?php echo $_POST['declarant_father_last_name']; ?></fam>
                                        <nam><?php echo $_POST['declarant_father_first_name']; ?></nam>
                                        <otch><?php echo $_POST['declarant_father_middle_name']; ?></otch>
                                    </fath>
                                    <childPosle>
                                        <fam><?php echo $_POST['child_fatherhood_after_last_name']; ?></fam>
                                        <nam><?php echo $_POST['child_fatherhood_after_first_name']; ?></nam>
                                        <otch><?php echo $_POST['child_fatherhood_after_middle_name']; ?></otch>
                                    </childPosle>
                                </docUO>
                            </zjv>
                        </putZjvPovtUO>
                    </wsZagsPovtUO>
                </ns2:AppData>
            </ns2:MessageData>
        </ns2:ZagsService>
    </S:Body>
</S:Envelope>