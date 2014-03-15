<?php 

	if (!empty($link))
	{
		foreach ($link as $key => $each_value) {
			
			$linkStr = '<link ';
			foreach ($each_value as $attrib => $value) {
				$linkStr .= $attrib . '= "' . $value . '"';
			}

			$linkStr .= ' />';
			echo $linkStr;
		}

	}

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

</head>
<body>
