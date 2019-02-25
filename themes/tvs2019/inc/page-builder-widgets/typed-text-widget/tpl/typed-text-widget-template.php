<?php 
?>
<div class="typed-text-container ">
<span class="typed-text">
	
</span>
</div>

<script>
	var typed2 = new Typed('.typed-text', {
	    strings: ["",<?php if($text_1){ echo "'" . addslashes($text_1) . "',";} ?>
					<?php if($text_2){ echo "'" . addslashes($text_2) . "',";} ?>
					<?php if($text_3){ echo "'" . addslashes($text_3) . "',";} ?>
					<?php if($text_4){ echo "'" . addslashes($text_4) . "'";} ?>],
	    typeSpeed: 60,
	    backSpeed: 40,
	    loop: true,
	  });
</script>