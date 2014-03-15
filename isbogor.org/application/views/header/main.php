<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo (!empty($title)) ?  $title : "International School Bogor"; ?></title>
	<link rel="shortcut icon" href="<?php echo base_url('favicon.ico'); ?>" />
   
   <?php

   if (!empty($cbd))
   {
      foreach ($cbd as $key => $each_value) {
         if ($key == 'link'){
            foreach ($each_value as $key => $value) {
               echo '<' . $value['type'] . ' href="' . base_url($value['path']) . '" rel="stylesheet" /> ';
            }

         }
         else if ($key == 'script'){
            foreach ($each_value as $key => $value) {
               echo '<' . $value['type'] . ' src="' . base_url($value['path']) . '"></script> ';
            }

         }
      }
   }   
   
   ?>