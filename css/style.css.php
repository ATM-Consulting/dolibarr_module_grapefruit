<?php
header('content-type: text/css');

header('Cache-Control: max-age=31536000, must-revalidate');

require __DIR__ . '/../config.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/usergroups.lib.php';

$highlightcolor1 = $user->conf->MAIN_COLOR_HIGHLIGHT_LINE;

?>

.checkedAddClassHighLight {
	background: <?php echo $highlightcolor1 ?> !important;
	opacity:0.8;
}
.uncheckedAddClassHighLight {
	background: #ffb84d !important;
	opacity:0.8;
}
.checkedAddClassHighLight:hover {
	background: <?php echo $highlightcolor1 ?> !important;
	opacity:1;
}
.uncheckedAddClassHighLight:hover {
	background: #ffa31a !important;
	opacity:1;
}

