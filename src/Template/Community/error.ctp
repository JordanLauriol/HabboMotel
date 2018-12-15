<?php

if($this->request->session()->read('Auth.User.rank') >= 3) {
	echo 'Debug (réservé aux staffs)';
	debug($error);
}

?>