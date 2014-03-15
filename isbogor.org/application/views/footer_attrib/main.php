</body>

<?php 

	if (!empty($script) && is_array($script))
	{
		foreach ($script as $key => $each_value) {
			
			$scriptStr = '<script ';
			foreach ($each_value as $attrib => $value) {
				$scriptStr .= $attrib . '= "' . $value . '"';
			}

			$scriptStr .= ' />';
			echo $scriptStr;
		}

	}
	else if (!empty($script)) echo "<script>" . $script . "</script>";

?>
