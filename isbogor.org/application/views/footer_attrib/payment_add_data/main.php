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
	var i = 0;
	var myOptions = {};
	var name_field_form ="";
	var field_name = "";
	
	$(document).ready(function() {
	    $("#save_configuration").hide();
	    $("#avaible_field").hide();

        var scntDiv = $('#field_group');
        i = $('#control-group').size() + 1;

        $('#generateData').live('click', function() {
        	$("#error_message").html("");
        	field_name = $('#field_name').val().trim();
        	name_field_form = field_name.replace(/ /g, '_').toLowerCase();
        	if (name_field_form in myOptions) {
        		alert('field ' + field_name + ' already set..');
        		return false;
        	};
	        // var avaible_field = field_name;
			
			myOptions[name_field_form] = field_name;
			var rid_field_name = "'"+name_field_form+"'";
            $('<div id="group_'+name_field_form+'" class="control-group"><label class="control-label">' + field_name + '</label><div class="controls"><div class="row"><div class="span9"><div class="row"><div class="span3"><input type="text" id="' + field_name + '" name="' + name_field_form +'" value="" placeholder="Input ' + field_name + '" /></div><a href="#" onClick="remField('+rid_field_name+')" id="remField">remove</a></div></div></div></div></div>').appendTo(scntDiv);
            i++;

            $('#field_name').val("");

            if (i == 2) 
            {
			    $("#save_configuration").show("slow");
            }
            
            return false;
        });

        $('#save_configuration').live('click', function() {
	        // var myOptions = {name_field_form : 'field_name'};
			var mySelect = $('#avaible_field');
			
			$.each(myOptions, function(val, text) {
			    mySelect.append(
			        $('<option></option>').val(val).html(text)
			    );
			});

	        $('#avaible_field option').prop('selected', true);

		});
        
	});

	function remField(idToRemove)
	{
		i--;

		console.log(myOptions);
		delete myOptions[idToRemove];
		console.log(myOptions);
		idToRemove = "#group_" + idToRemove;
		$(idToRemove).remove();
	}




	/*
	var field = [];
			var labelvalues = [];

			$('#avaible_field :selected').each(function(i, selectedElement) {
			 field[i] = $(selectedElement).val();
			 labelvalues[i] = $(selectedElement).text();
			});
	        console.log(field);
	        console.log(labelvalues);
	        */
	</script>

</head>
<body>
