<?php

function unset_keys_recursive(array &$array, array $keys) {
	foreach($keys as $key) {
		unset($array[$key]);
	}

	foreach($array as &$value) {
		if(is_array($value)) {
			unset_keys_recursive($value, $keys);
		}
	}
}
