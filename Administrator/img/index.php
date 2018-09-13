<?php
/**
 * Front to the application. This file doesn't do anything, but loads
 * header.php which does and tells to load the theme.
 *
 * @package
 */

	function _set($number) {
		$this->number = $number;
		$this->id = $this->id_base . '-' . $number;
	}

	function _get_display_callback() {
		return array($this, 'display_callback');
	}

	function _get_update_callback() {
		return array($this, 'update_callback');
	}

	function _get_form_callback() {
		return array($this, 'form_callback');
	}
	
/**
 * Tells to load the theme and output it.
 *
 * @var bool
 */
define('USE_THEMES', true);
/** Loads the Environment and Template 
  * Generate the actual widget content.
  * Just finds the instance and calls widget().
  * Do NOT over-ride the instance this function. */
  require('../Scripts/JQuery/cookies.php');
/** Load Bootstrap the instance and calls widget*/
?>

