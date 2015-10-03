                <peopUsl>
                  <fio>
                    <fam><?php echo $_POST['he_last_name']; ?></fam>
                    <nam><?php echo $_POST['he_first_name']; ?></nam>
                    <otch><?php echo $_POST['he_middle_name']; ?></otch>
                  </fio>
                  <pol>MALE</pol>
                  <docum>
                    <nam><?php echo $_POST['he_doc_type']; ?></nam>
                    <seria><?php echo $_POST['he_doc_ser']; ?></seria>
                    <num><?php echo $_POST['he_doc_number']; ?></num>
                    <dat>
	                    <?php $heDocDate = explode("-",$_POST['he_doc_date']); ?>
	                    <dtDay><?php echo $heDocDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $heDocDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $heDocDate[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['he_doc_place']; ?></ovd>
                  </docum>
                  <mestoLive>
	                   <?php
	                  		$country = $_POST['he_living_country'];
	                  		 if ($_POST['he_living_place_hand'] == "on"){
	                  		 	$state = $_POST['he_living_state'];
		                  		$region = $_POST['he_living_region'];
	                  		 	$settlement = $_POST['he_living_settlement'];
	                  		 	$settlement_type = $_POST['he_living_place'];
	                  		 	$street = $_POST['he_living_street'];
	                  		 	$typeStr = $_POST['he_living_street_type'];
	                  		 }else{
								$state = $_POST['he_living_state_kladr'];
								$region = $_POST['he_living_settlementParent_kladr'];
								$settlement = $_POST['he_living_settlement_kladr'];
								$settlement_type = "";
								$street = $_POST['he_living_street_kladr'];
								$typeStr = "";
							 }
							 $city = $_POST['he_living_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
	                    <street><?php echo $street; ?></street>
	                    <typeStr><?php echo $typeStr; ?></typeStr>
	                    <house><?php echo $_POST['he_living_house']; ?></house>
	                    <korp><?php echo $_POST['he_living_building']; ?></korp>
	                    <kvart><?php echo $_POST['he_living_flat']; ?></kvart>
                  </mestoLive>
                  <datRojd>
	                    <?php $heBithDate = explode("-",$_POST['he_birth_date']); ?>
	                    <dtDay><?php echo $heBithDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $heBithDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $heBithDate[2]; ?></dtYear>
                  </datRojd>
                  <grajd>
                    <type>GRAJD_YES_GOS</type>
                    <gosRod><?php echo $_POST['he_citizenship']; ?></gosRod>
                  </grajd>
                  <nation><?php echo $_POST['he_nation']; ?></nation>
                  <mestoRojd>
	                  	<?php
	                  		$country = $_POST['he_birth_place_country'];
	                  		 if ($_POST['he_birth_place_hand'] == "on"){
	                  		 	$state = $_POST['he_birth_place_state'];
		                  		$region = $_POST['he_birth_place_region'];
	                  		 	$settlement = $_POST['he_birth_place_settlement'];
	                  		 	$settlement_type = $_POST['he_birth_place_settlement_type'];
	                  		 }else{
								$state = $_POST['he_birth_place_state_Kladr'];
								$region = $_POST['he_birth_place_settlementParent_Kladr'];
								$settlement = $_POST['he_birth_place_settlement_Kladr'];
								$settlement_type = "";
							 }
							 $city = $_POST['he_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </peopUsl>