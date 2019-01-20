<?php
  include 'config.php'
 ?>
<select size="1" name="<?=$date_name?>">
<?php
for ($i = 1; $i <= 31; $i++)
	{
		echo '<option value="'.substr('0'.$i, -2).'" '.($datess+0==$i?'selected="selected"':'').'>' . $i . '</option>';
  }
?>
</select>

<select size="1" name="<?=$month_name?>" class="SELECT">
																		<option value="1" <?php if ($monthss==1){ echo "selected";}else{}?>>มกราคม</option>
																		<option value="2" <?php if ($monthss==2){ echo "selected";}else{}?>>กุมภาพันธ์</option>
																		<option value="3" <?php if ($monthss==3){ echo "selected";}else{}?>>มีนาคม</option>
																		<option value="4" <?php if ($monthss==4){ echo "selected";}else{}?>>เมษายน</option>
																		<option value="5" <?php if ($monthss==5){ echo "selected";}else{}?>>พฤษภาคม</option>
																		<option value="6" <?php if ($monthss==6){ echo "selected";}else{}?>>มิถุนายน</option>
																		<option value="7" <?php if ($monthss==7){ echo "selected";}else{}?>>กรกฎาคม</option>
																		<option value="8" <?php if ($monthss==8){ echo "selected";}else{}?>>สิงหาคม</option>
																		<option value="9" <?php if ($monthss==9){ echo "selected";}else{}?>>กันยายน</option>
																		<option value="10" <?php if ($monthss==10){ echo "selected";}else{}?>>ตุลาคม</option>
																		<option value="11" <?php if ($monthss==11){ echo "selected";}else{}?>>พฤศจิกายน</option>
																		<option value="12" <?php if ($monthss==12){ echo "selected";}else{}?>>ธันวาคม</option>
																		</select>

                                    <?php
                                    																		echo "<select size='' name='$month_name' class='SELECT'>";
                                    																		for ($i = $Year; $i >= $Year - 100; $i--)
                                    																		{
                                    																			$years = $i-543;
                                    																			echo '<option value="'.$years.'" '.($yearss+0==$i?'selected="selected"':'').'>' . $i . '</option>';
                                    																		}
                                    																		echo " </select>";
                                    																		?>
