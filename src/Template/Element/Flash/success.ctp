<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div id="flashMessage" class="alert alert-success alert-dismissable">
	<i class="fa fa-check"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Success</b> <?= h($message) ?>
</div>