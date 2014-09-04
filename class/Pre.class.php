<?php
Class Pre{	
	public static function dump( $data ){
		echo '<pre>' . print_r( $data, true ) . '</pre>';
	}	
}