<?php

function __autoload($class){	
	if(file_exists(__DIR__.'/controllers/'.$class.'.php')){
		require_once __DIR__.'/controllers/'.$class.'.php';
	}elseif(file_exists(__DIR__.'/models/'.$class.'.php')){
		require_once __DIR__.'/models/'.$class.'.php';
	}elseif(file_exists(__DIR__.'/classes/'.$class.'.php')){
		require_once __DIR__.'/classes/'.$class.'.php';
	}else{
		$classParts = explode('\\', $class);
		$classParts[0] = __DIR__;
		$classpath = implode(DIRECTORY_SEPARATOR, $classParts).'.php';
		if(file_exists($classpath)){
			require $classpath;
		}

	}
}


?>