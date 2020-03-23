<p class="lead" style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:400;line-height:1.6;margin:0;margin-bottom:10px;padding:0;text-align:left">
    Requested password reset</p>
<p>Hi <?= h($name) ?>,</p>
<p>Your username is: <?= h($userName)?></p>
<p>If you wish to reset your account password, please click on the following link. If you did not issue a password reset you can safely ignore this email. </p>
<p><a style="Margin:0;color:#2199e8;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none" 
      href="<?= $link ?>"><?= $link ?></a></p>
<p>Have a nice day,</p>
<p>This email was sent by a user triggered event and thus can't really be unsubscribed from.<br/>
    If you keep getting these messages and don't want to, please contact 
<a style="Margin:0;color:#2199e8;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none" 
href="<?= $support ?>">customer support</a>.</p> 
