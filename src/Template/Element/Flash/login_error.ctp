<?php
$current = $this->request->params['controller'];
$action = $this->request->params['action'];

if(in_array($current, ['Tests', 'Users']) && in_array($action, ['login', 'newPassword'])):
    if (!isset($params['escape']) || $params['escape'] !== false) {
        $message = h($message);
    }
?>
    <small class="text-danger text-center font-weight-bold"><?= h($message) ?></small>
<?php endif; ?>