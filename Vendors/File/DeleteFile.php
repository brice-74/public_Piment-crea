<?php
namespace Vendors\File;


class DeleteFile {
	function deleteDirFiles($chemin){
	    if (substr($chemin, strlen($chemin) - 1, 1) != '/') {
	        $chemin .= '/';
	    }
	    $files = glob($chemin . '*', GLOB_MARK);
	    foreach ($files as $file) {
	        if (is_dir($file)) {
	            self::deleteDirFiles($file);
	        } else {
	            unlink($file);
	        }
	    }
	    rmdir($chemin);
	}
}
?>