<?php $this->assign('title', 'DDMS Setup');
$OK = true;
?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Environment</h3>
            </div>
            
            <div class="box-body">
              <ul class="list-unstyled">
        <?php if (version_compare(PHP_VERSION, '5.6.0', '>=')): ?>
            <li class="text-green">Your version of PHP is 5.6.0 or higher (detected <?= PHP_VERSION ?>).</li>
        <?php else: $OK = false;?>
            <li class="text-red">Your version of PHP is too low. You need PHP 5.6.0 or higher to use CakePHP (detected <?= PHP_VERSION ?>).</li>
        <?php endif; ?>

        <?php if (extension_loaded('mbstring')): ?>
            <li class="text-green">Your version of PHP has the mbstring extension loaded.</li>
        <?php else:  $OK = false;?>
            <li class="text-red">Your version of PHP does NOT have the mbstring extension loaded.</li>;
        <?php endif; ?>

        <?php if (extension_loaded('openssl')): ?>
            <li class="text-green">Your version of PHP has the openssl extension loaded.</li>
        <?php elseif (extension_loaded('mcrypt')): ?>
            <li class="text-green">Your version of PHP has the mcrypt extension loaded.</li>
        <?php else:  $OK = false;?>
            <li class="text-red">Your version of PHP does NOT have the openssl or mcrypt extension loaded.</li>
        <?php endif; ?>

        <?php if (extension_loaded('intl')): ?>
            <li class="text-green">Your version of PHP has the intl extension loaded.</li>
        <?php else:  $OK = false;?>
            <li class="text-red">Your version of PHP does NOT have the intl extension loaded.</li>
        <?php endif; ?>
        </ul>
            </div>
          </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Filesystem</h3>
            </div>
            
            <div class="box-body">
              <ul class="list-unstyled">
        <?php if (is_writable(TMP)): ?>
            <li class="text-green">Your tmp directory is writable.</li>
        <?php else:  $OK = false;?>
            <li class="text-red">Your tmp directory is NOT writable.</li>
        <?php endif; ?>

        <?php if (is_writable(LOGS)): ?>
            <li class="text-green">Your logs directory is writable.</li>
        <?php else:  $OK = false;?>
            <li class="text-red">Your logs directory is NOT writable.</li>
        <?php endif; ?>

        <?php  ?>
        <?php if (!empty($settings)): ?>
            <li class="text-green">The <em><?= $settings['className'] ?>Engine</em> is being used for core caching. To change the config edit config/app.php</li>
        <?php else:  $OK = false;?>
            <li class="text-red">Your cache is NOT working. Please check the settings in config/app.php</li>
        <?php endif; ?>
        </ul>
    </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Database Connections</h3>
                    </div>
                    <div class="box-body">
                        <ul class="list-unstyled">
                    <?php if ($defaultConnected): ?>
                        <li class="text-green">Default connection OK.</li>
                    <?php else:  $OK = false;?>
                        <li class="text-red">Default connection Failed.<br /><?= $errors['default'] ?></li>
                        <li class="text-red">Please check the settings in config/app.php</li>
                    <?php endif; ?>
                    <?php if ($connected): ?>
                        <li class="text-green">Migrate connection OK.</li>
                    <?php else:  $OK = false;?>
                        <li class="text-red">Migrate connection Failed.<br /><?= $errors['migrate'] ?></li>
                        <li class="text-red">Please check the settings in config/app.php</li>
                    <?php endif; ?>
                    <?php if ($reportsConnected): ?>
                        <li class="text-green">Reports connection OK.</li>
                    <?php else:  $OK = false;?>
                        <li class="text-red">Reports connection Failed.<br /><?= $errors['reports'] ?></li>
                        <li class="text-red">Please check the settings in config/app.php</li>
                    <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Test Email Configuration</h3>
                    </div>
                    <div class="box-body">
                        <?= $this->Form->create($email_test); ?>
                            <div class="row">
                                <div class="col-md-10"><?= $this->Form->input('email',['label'=>'Send test email to:']); ?></div>
                                <div class="col-md-2"><?= $this->Form->button('Send'); ?></div>
                            </div>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Database Updates</h3>
            </div>
            
            <div class="box-body">
              <ul class="list-unstyled">
        <?php if (!empty($DBstatus)): ?>
            <?php foreach($DBstatus as $dbUpdate):
                if($dbUpdate['status']!='up')  $OK = false;
                ?>
            <li class="<?= ($dbUpdate['status']=='up')?'text-green':'text-red' ?>"><?= h($dbUpdate['name'])?> <small><?= h($dbUpdate['id'])?></small></li>
            <?php endforeach;?>
        <?php endif; ?>  
        </ul>
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php if($OK):?>
        <?= $this->Html->link('Continue',['action'=>'complete'],['class'=>'btn btn-success']);?>
        <?php else:?>
        <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Please address all issues above before continuing.
                <br/>
                <br/>
                <?= $this->Html->link('Check Again',['action'=>'index'],['class'=>'btn btn-info']);?>
              </div>
        <?php endif;?>
    </div>
</div>

