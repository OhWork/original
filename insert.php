<?php

	@$rs = $db->insert('test',array(
			'Test_name' => 1234
			))->Stement()->runStmSql($rs);
	if($rs){
		echo "สำเร็จนะจ๊ะ";
	}else{
		echo "ไม่สำเร็จนะจ๊ะ";
	}
 ?>
