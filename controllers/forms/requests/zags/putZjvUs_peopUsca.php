               <peopUsca>
                  <fio>
                    <fam><?php echo $_POST['she_last_name']; ?></fam>
                    <nam><?php echo $_POST['she_first_name']; ?></nam>
                    <otch><?php echo $_POST['she_middle_name']; ?></otch>
                  </fio>
                  <pol>FEMALE</pol>
                  <docum>
                    <nam><?php echo $_POST['she_doc_type']; ?></nam>
                    <seria><?php echo $_POST['she_doc_ser']; ?></seria>
                    <num><?php echo $_POST['she_doc_number']; ?></num>
                    <dat>
	                    <?php $sheDocDate = explode("-",$_POST['she_doc_date']); ?>
	                    <dtDay><?php echo $sheDocDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $sheDocDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $sheDocDate[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['she_doc_place']; ?></ovd>
                  </docum>
                  <mestoLive>
	                   <?php
	                  		$country = $_POST['she_living_country'];
	                  		 if ($_POST['she_living_place_hand'] == "on"){
	                  		 	$state = $_POST['she_living_state'];
		                  		$region = $_POST['she_living_region'];
	                  		 	$settlement = $_POST['she_living_settlement'];
	                  		 	$settlement_type = $_POST['she_living_place'];
	                  		 	$street = $_POST['she_living_street'];
	                  		 	$typeStr = $_POST['she_living_street_type'];
	                  		 }else{
								$state = $_POST['she_living_state_kladr'];
								$region = $_POST['she_living_settlementParent_kladr'];
								$settlement = $_POST['she_living_settlement_kladr'];
								$settlement_type = "";
								$street = $_POST['she_living_street_kladr'];
								$typeStr = "";
							 }
							 $city = $_POST['she_living_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
	                    <street><?php echo $street; ?></street>
	                    <typeStr><?php echo $typeStr; ?></typeStr>
	                    <house><?php echo $_POST['she_living_house']; ?></house>
	                    <korp><?php echo $_POST['she_living_building']; ?></korp>
	                    <kvart><?php echo $_POST['she_living_flat']; ?></kvart>
                  </mestoLive>
                  <datRojd>
	                    <?php $sheBithDate = explode("-",$_POST['she_birth_date']); ?>
	                    <dtDay><?php echo $sheBithDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $sheBithDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $sheBithDate[2]; ?></dtYear>
                  </datRojd>
                  <grajd>
                    <type>GRAJD_YES_GOS</type>
                    <gosRod><?php echo $_POST['she_citizenship']; ?></gosRod>
                  </grajd>
                  <nation><?php echo $_POST['she_nation']; ?></nation>
                  <mestoRojd>
	                  	<?php
	                  		$country = $_POST['she_birth_place_country'];
	                  		 if ($_POST['she_birth_place_hand'] == "on"){
	                  		 	$state = $_POST['she_birth_place_state'];
		                  		$region = $_POST['she_birth_place_region'];
	                  		 	$settlement = $_POST['she_birth_place_settlement'];
	                  		 	$settlement_type = $_POST['she_birth_place_settlement_type'];
	                  		 }else{
								$state = $_POST['she_birth_place_state_Kladr'];
								$region = $_POST['she_birth_place_settlementParent_Kladr'];
								$settlement = $_POST['she_birth_place_settlement_Kladr'];
								$settlement_type = "";
							 }
							 $city = $_POST['she_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </peopUsca>