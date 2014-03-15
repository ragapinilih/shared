<?php 

	if (!empty($cbd))
	{
	  foreach ($cbd as $key => $each_value) {
     	if ($key == 'script'){
	        foreach ($each_value as $key => $value) {
	           echo '<' . $value['type'] . ' src="' . base_url($value['path']) . '"></script> ';
	        }

	     }
	  
	  }

	}   

?>

<script src="<?php echo base_url('asset/custom_1/themes/js/common.js'); ?>"></script>
<script src="<?php echo base_url('asset/custom_1/themes/js/jquery.flexslider-min.js'); ?>"></script>
<script type="text/javascript">
	$(function() {
		$(document).ready(function() {
			$('.flexslider').flexslider({
				animation: "fade",
				slideshowSpeed: 4000,
				animationSpeed: 600,
				controlNav: false,
				directionNav: true,
				controlsContainer: ".flex-container" // the container that holds the flexslider
			});
		});
	});
</script>

	<script>
	$(document).ready(function() {
        var scntDiv = $('#field_group');
        var i = $('#control-group').size() + 1;

        $('#generateData').live('click', function() {
	        var field_name = $('#field_name').val();
	        var name_field_form = field_name.replace(/ /g, '_').toLowerCase();
	        // var avaible_field = field_name;
			var str1 = $('avaible_field').val();
	        console.log(str1);

	        var rid_field_name = "'"+field_name+"'";
            $('<div id="group_'+field_name+'" class="control-group"><label class="control-label">' + field_name + '</label><div class="controls"><div class="row"><div class="span9"><div class="row"><div class="span3"><input type="text" id="' + field_name + '" name="' + name_field_form +'" value="" placeholder="Input ' + field_name + '" /></div><a href="#" onClick="remField('+rid_field_name+')" id="remField">remove</a></div></div></div></div></div>').appendTo(scntDiv);
            i++;
            $('#field_name').val("");
            return false;
        });
        
	});

	function remField(idToRemove)
	{
		idToRemove = "#group_" + idToRemove;
		$(idToRemove).remove();
	}
	</script>

</head>
<body>
