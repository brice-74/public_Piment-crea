<?php
echo "<div class=\"recherche\">";
	if(isset($result)){
		echo $result["form"][0]->getForm();
	}
echo "</div>";

?>