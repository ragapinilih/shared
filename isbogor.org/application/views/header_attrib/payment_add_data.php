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

	<script>
	$(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents p').size() + 1;
        
        $('#addScnt').live('click', function() {
                $('<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt_' + i +'" value="" placeholder="Input Value" /></label> <a href="#" id="remScnt">Remove</a></p>').appendTo(scntDiv);
                i++;
                return false;
        });
        
        $('#remScnt').live('click', function() { 
                if( i > 2 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
	});
	</script>

</head>
<body>
