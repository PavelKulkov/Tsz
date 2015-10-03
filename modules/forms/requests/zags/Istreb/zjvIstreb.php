                 <idZags><?php echo $_POST['id_agency_in']; ?></idZags>
                <gosIstrebDoc><?php echo $_POST['gosIstrebDoc']; ?></gosIstrebDoc>
                <namZagsIstrebDoc><?php echo $_POST['namZagsIstrebDoc']; ?></namZagsIstrebDoc>
                <zjvl>
				<reservedNakhodka>without-sending-status</reservedNakhodka>
                  <fio>
                  	<fam><?php echo $_POST['fam']; ?></fam>
                    <nam><?php echo $_POST['name']; ?></nam>
                    <otch><?php echo $_POST['otch']; ?></otch>
                  </fio>
                  <pol><?php echo $_POST['pol']; ?></pol>
                  <docum>
                  	<nam><?php echo $_POST['nam']; ?></nam>
                    <seria><?php echo $_POST['seria']; ?></seria>
                    <num><?php echo $_POST['num']; ?></num>
                    <dat>
						<?php $zjvlDocumDate = explode("-",$_POST['date_doc']); ?>
		                <dtDay><?php echo $zjvlDocumDate[0]; ?></dtDay>
		                <dtMonth><?php echo $zjvlDocumDate[1]; ?></dtMonth>
		                <dtYear><?php echo $zjvlDocumDate[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['ovd']; ?></ovd>
                  </docum>
                  <mestoLive>
                  <?php
                  		$country = $_POST['gos'];
                  		 if ($_POST['hand_input'] == "on"){
                  		 	$state = $_POST['subGos'];
	                  		$region = $_POST['rayon'];
                  		 	$settlement = $_POST['nasPun'];
                  		 	$settlement_type = $_POST['typeNP'];
                  		 	$street = $_POST['street'];
                  		 	$typeStr = $_POST['typeStr'];
                  		 }else{
							$state = $_POST['subGos_kladr'];
							$region = $_POST['nasPunParent_kladr'];
							$settlement = $_POST['nasPun_kladr'];
							$settlement_type = "";
							$street = $_POST['street_kladr'];
							$typeStr = "";
						 }
						 $city = $_POST['gorod'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                    <street><?php echo $street; ?></street>
                    <typeStr><?php echo $typeStr; ?></typeStr>
                    <house><?php echo $_POST['house']; ?></house>
                    <korp><?php echo $_POST['korp']; ?></korp>
                    <kvart><?php echo $_POST['kvart']; ?></kvart>
                    <indMal><?php echo $_POST['indMal']; ?></indMal>
                  </mestoLive>
                </zjvl>
                <grajdZjvl>
                	<type>GRAJD_YES_GOS</type>
                    <gosRod><?php echo $_POST['grajd']; ?></gosRod>
                </grajdZjvl>
                <teleph><?php echo $_POST['contact_phone']; ?></teleph>
                <rightsOnDoc><?php echo $_POST['rightsOnDoc']; ?></rightsOnDoc>
                <namZagsTo><?php echo $_POST['namZagsTo']; ?></namZagsTo>
                <adrZagsTo>
                   <?php
                  		$country = $_POST['strana_zags'];
                  		 if ($_POST['hand_input_zags'] == "on"){
                  		 	$state = $_POST['obl_zags'];
	                  		$region = $_POST['raion_zags'];
                  		 	$settlement = $_POST['locality'];
                  		 	$settlement_type = $_POST['locality_type'];
                  		 	$street = $_POST['ul_zags'];
                  		 	$typeStr = $_POST['typeul_zags'];
                  		 }else{
							$state = $_POST['obl_zags_kladr'];
							$region = $_POST['localityParent_kladr'];
							$settlement = $_POST['locality_kladr'];
							$settlement_type = "";
							$street = $_POST['ul_zags_kladr'];
							$typeStr = "";
						 }
						 $city = $_POST['gorod_zags'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                    <street><?php echo $street; ?></street>
                    <typeStr><?php echo $typeStr; ?></typeStr>
                    <house><?php echo $_POST['dom_zags']; ?></house>
                    <korp><?php echo $_POST['korp_zags']; ?></korp>
                    <kvart><?php echo $_POST['kvart_zags']; ?></kvart>
                    <indMal><?php echo $_POST['index_zags']; ?></indMal>
                </adrZagsTo>
                <prichIstreb><?php echo $_POST['prichIstreb']; ?></prichIstreb>
                <kindDoc><?php echo $_POST['kindDoc']; ?></kindDoc>
                <actInfo>
                	<num><?php echo $_POST['num_act']; ?></num>
                    <dat>
						<?php 
                        	if ($_POST['exact_date'] == 'true'){
                        		$actInfoDocumDate = explode("-",$_POST['date_act_day']);
                        	}else{
								$actInfoDocumDate = explode("-",$_POST['date_act_since']);
							} 
                    	?>
	                	<dtDay><?php echo $actInfoDocumDate[0]; ?></dtDay>
	                	<dtMonth><?php echo $actInfoDocumDate[1]; ?></dtMonth>
	                	<dtYear><?php echo $actInfoDocumDate[2]; ?></dtYear>
                    </dat>
                    <zgs><?php echo $_POST['organ_zags']; ?></zgs>
                    <?php
                    	if ($_POST['exact_date'] == 'false'){
							echo "<datAZ_2>";
							$actInfoDocumDateUntil = explode("-",$_POST['date_act_until']);
							echo "<dtDay>".$actInfoDocumDateUntil[0]."</dtDay>";
							echo "<dtMonth>".$actInfoDocumDateUntil[1]."</dtMonth>";
							echo "<dtYear>".$actInfoDocumDateUntil[2]."</dtYear>";
							echo "</datAZ_2>";
						}
                    ?>
                </actInfo>