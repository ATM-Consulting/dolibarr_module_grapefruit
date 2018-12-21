<?php
header('content-type: text/css');

header('Cache-Control: max-age=31536000, must-revalidate');

require __DIR__ . '/../config.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/usergroups.lib.php';

$highlightcolor1 = $user->conf->MAIN_COLOR_HIGHLIGHT_LINE_1;
$highlightcolor2 = $user->conf->MAIN_COLOR_HIGHLIGHT_LINE_2;
?>

.checkedAddClassHighLight {
	background: <?php echo $highlightcolor1 ?> !important;
	opacity:0.8;
}
.uncheckedAddClassHighLight {
	background: <?php echo $highlightcolor2 ?> !important;
	opacity:0.8;
}
.checkedAddClassHighLight:hover {
	background: <?php echo $highlightcolor1 ?> !important;
	opacity:1;
}
.uncheckedAddClassHighLight:hover {
	background: <?php echo $highlightcolor2 ?> !important;
	opacity:1;
}

