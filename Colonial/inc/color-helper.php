<?php
	/**
	 * Find the contrasting (black/white) color to any given color
	 */
	function get_contrasting_color($color) {
		// Variables
		$black = 0;
		$white = hexdec( 'ff' );
		$red   = hexdec( substr( $color, 1, 2 ) );
		$green = hexdec( substr( $color, 3, 2 ) );
		$blue  = hexdec( substr( $color, 5, 2 ) );

		// Calculate the difference
		$redBlackDiff   = $red   - $black;
		$redWhiteDiff   = $white - $red;
		$greenBlackDiff = $green - $black;
		$greenWhiteDiff = $white - $green;
		$blueBlackDiff  = $blue  - $black;
		$blueWhiteDiff  = $white - $blue;

		// Find if the color is closer to black or white
		$blackDiff = $redBlackDiff + $greenBlackDiff + $blueBlackDiff;
		$whiteDiff = $redWhiteDiff + $greenWhiteDiff + $blueWhiteDiff;

		// If the color is closer to black, return white. And vice-versa.
		return $blackDiff < $whiteDiff
			? '#ffffff'
			: '#000000';
	}
?>
