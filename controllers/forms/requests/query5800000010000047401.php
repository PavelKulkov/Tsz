<?php 
      $soapAction = "urn:putZjvZB";

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
                <!-- <ns2:TestMsg>true</ns2:TestMsg> -->
            </ns2:Message>
            <ns2:MessageData>
                <ns2:AppData>
                    <wsZagsZb>
                        <putZjvZB>
                            <use>true</use>
                            <zjv>
                                <requestHeader>
                                    <typ:authToken>NAKHODKA:530-fdlpw0-49jbsx00dp:20310101</typ:authToken>
                                    <typ:requestId>0e027230-da41-4eb9-a03d-4894bd05e7f8</typ:requestId>
                                </requestHeader>
                                <idZags><?php echo $_POST['id_agency']; ?></idZags>
                                <email></email>
                                <needActive>false</needActive>
                                <timeZB>
                                    <dateZB><?php echo $_POST['reg_date']; ?></dateZB>
									<?php $HourTime = explode(":",$_POST['reg_time']); ?>
									<?php $NamZal = explode("|",$_POST['reg_time']); ?>
									<hourZB><?php echo $HourTime[0]; ?></hourZB>
                                    <minZB><?php echo $HourTime[1]; ?></minZB>
                                    <blTorj><?php echo (($_POST['reg_is_grand'] == "ZB_TORG") ? 'true' : 'false'); ?></blTorj>
                                    <namZal><?php echo trim($NamZal[1]); ?></namZal>
                                    <status>ST_TIMEZB_FREE</status>
                                    <guidTimeZB />
                                </timeZB>
                                <idPersonal>242530264</idPersonal>
                                <heFamPosle><?php echo $_POST['groom_new_last_name']; ?></heFamPosle>
                                <sheFamPosle><?php echo $_POST['bride_new_last_name']; ?></sheFamPosle>
                                <he>
                                    <fio>
                                        <fam><?php echo $_POST['groom_last_name']; ?></fam>
                                        <nam><?php echo $_POST['groom_first_name']; ?></nam>
                                        <otch><?php echo $_POST['groom_middle_name']; ?></otch>
                                    </fio>
                                    <pol>MALE</pol>
                                    <docum>
                                        <nam><?php echo $_POST['groom_doc_type_foreign']; ?></nam>
                                        <seria><?php echo $_POST['groom_doc_ser']; ?></seria>
                                        <num><?php echo $_POST['groom_doc_num']; ?></num>
										<?php $heDocDate = explode("-",$_POST['groom_doc_date']); ?>
										<dat>
                                            <dtDay><?php echo $heDocDate[0]; ?></dtDay>
                                            <dtMonth><?php echo $heDocDate[1]; ?></dtMonth>
                                            <dtYear><?php echo $heDocDate[2]; ?></dtYear>
                                        </dat>
                                        <ovd><?php echo $_POST['groom_doc_source']; ?></ovd>
                                    </docum>
                                    <mestoLive>
                                        <gos><?php echo $_POST['groom_country']; ?></gos>
                                        <subGos><?php echo $_POST['groom_state_Rus']; ?></subGos>
                                        <rayon>
										<?php echo $_POST['groom_settlementParent_Rus']; ?>
										<?php echo $_POST['groom_settlement_Rus']; ?>
										</rayon>
                                        <gorod><?php echo $_POST['groom_city']; ?></gorod>
                                        <street><?php echo $_POST['groom_street_Rus']; ?></street>
                                        <typeStr><?php echo $_POST['groom_country']; ?></typeStr>
                                        <house><?php echo $_POST['groom_house']; ?></house>
                                        <korp><?php echo $_POST['groom_building']; ?></korp>
                                        <kvart><?php echo $_POST['groom_flat']; ?></kvart>
                                        <indMal></indMal>
                                    </mestoLive>
									<?php $heBirth = explode("-",$_POST['groom_date_of_birth']); ?>
                                    <datRojd>
                                        <dtDay><?php echo $heBirth[0]; ?></dtDay>
                                        <dtMonth><?php echo $heBirth[1]; ?></dtMonth>
                                        <dtYear><?php echo $heBirth[2]; ?></dtYear>
                                    </datRojd>
                                    <grajd>
                                        <type>GRAJD_YES_GOS</type>
                                        <gosRod><?php echo $_POST['groom_citizenship']; ?></gosRod>
                                    </grajd>
                                    <nation><?php echo $_POST['groom_nationality']; ?></nation>
                                    <mestoRojd>
                                        <subGos><?php echo $_POST['groom_birth_country']; ?></subGos>
                                        <rayon><?php echo $_POST['groom_birth_settlementParent_kladr']; ?></rayon>
                                        <nasPun><?php echo $_POST['groom_birth_settlement_kladr']; ?></nasPun>
                                        <typeNP><?php echo $_POST['']; ?></typeNP>
                                    </mestoRojd>
                                </he>
                                <she>
                                    <fio>
                                        <fam><?php echo $_POST['bride_last_name']; ?></fam>
                                        <nam><?php echo $_POST['bride_first_name']; ?></nam>
                                        <otch><?php echo $_POST['bride_middle_name']; ?></otch>
                                    </fio>
                                    <pol>FEMALE</pol>
                                    <docum>
                                        <nam><?php echo $_POST['bride_doc_type_foreign']; ?></nam>
                                        <seria><?php echo $_POST['bride_doc_ser']; ?></seria>
                                        <num><?php echo $_POST['bride_doc_num']; ?></num>
										<?php $sheDocDate = explode("-",$_POST['bride_doc_date']); ?>
										<dat>
                                            <dtDay><?php echo $sheDocDate[0]; ?></dtDay>
                                            <dtMonth><?php echo $sheDocDate[1]; ?></dtMonth>
                                            <dtYear><?php echo $sheDocDate[2]; ?></dtYear>
                                        </dat>
                                        <ovd><?php echo $_POST['bride_doc_source']; ?></ovd>
                                    </docum>
                                    <mestoLive>
                                        <gos><?php echo $_POST['bride_country']; ?></gos>
                                        <subGos><?php echo $_POST['bride_state_Rus']; ?></subGos>
                                        <rayon>
										<?php echo $_POST['bride_settlementParent_Rus']; ?>
										<?php echo $_POST['bride_settlement_Rus']; ?>
										</rayon>
                                        <gorod><?php echo $_POST['bride_city']; ?></gorod>
                                        <street><?php echo $_POST['bride_street_Rus']; ?></street>
                                        <typeStr><?php echo $_POST['bride_country']; ?></typeStr>
                                        <house><?php echo $_POST['bride_house']; ?></house>
                                        <korp><?php echo $_POST['bride_building']; ?></korp>
                                        <kvart><?php echo $_POST['bride_flat']; ?></kvart>
                                        <indMal></indMal>
                                    </mestoLive>
									<?php $sheBirth = explode("-",$_POST['bride_date_of_birth']); ?>
                                    <datRojd>
                                        <dtDay><?php echo $sheBirth[0]; ?></dtDay>
                                        <dtMonth><?php echo $sheBirth[1]; ?></dtMonth>
                                        <dtYear><?php echo $sheBirth[2]; ?></dtYear>
                                    </datRojd>
                                    <grajd>
                                        <type>GRAJD_YES_GOS</type>
                                        <gosRod><?php echo $_POST['bride_citizenship']; ?></gosRod>
                                    </grajd>
                                    <nation><?php echo $_POST['bride_nationality']; ?></nation>
                                    <mestoRojd>
                                        <subGos><?php echo $_POST['bride_birth_country']; ?></subGos>
                                        <rayon><?php echo $_POST['bride_birth_settlementParent_kladr']; ?></rayon>
                                        <nasPun><?php echo $_POST['bride_birth_settlement_kladr']; ?></nasPun>
                                        <typeNP><?php echo $_POST['']; ?></typeNP>
                                    </mestoRojd>
                                </she>
                                <heDocRB>
                                    <num><?php echo $_POST['groom_merried_doc_num']; ?></num>
                                    <restored>false</restored>
									<?php $heDatRB = explode("-",$_POST['groom_merried_doc_date']); ?>
                                    <dat>
                                        <dtDay><?php echo $heDatRB[0]; ?></dtDay>
                                        <dtMonth><?php echo $heDatRB[1]; ?></dtMonth>
                                        <dtYear><?php echo $heDatRB[2]; ?></dtYear>
                                    </dat>
                                    <zgs><?php echo $_POST['groom_merried_doc_source']; ?></zgs>
                                </heDocRB>
                                <heDocOther></heDocOther>
                                <sheDocSm>
                                    <num><?php echo $_POST['bride_merried_doc_num']; ?></num>
                                    <restored>false</restored>
									<?php $sheDatRB = explode("-",$_POST['bride_merried_doc_date']); ?>
                                    <dat>
                                        <dtDay><?php echo $sheDatRB[0]; ?></dtDay>
                                        <dtMonth><?php echo $sheDatRB[1]; ?></dtMonth>
                                        <dtYear><?php echo $sheDatRB[2]; ?></dtYear>
                                    </dat>
                                    <zgs><?php echo $_POST['bride_merried_doc_source']; ?></zgs>
                                </sheDocSm>
                                <sheDocOther></sheDocOther>
                            </zjv>
                        </putZjvZB>
                    </wsZagsZb>
                </ns2:AppData>
            </ns2:MessageData>
        </ns2:ZagsService>
    </S:Body>
</S:Envelope>