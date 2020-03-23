<?php 
    $this->assign('title', 'Login');
    echo $this->Html->css('/libs/shibboleth/idpselect.css');
    
    $idpSelectOptions = [
        'alwaysShow'=>true,
        'defaultLanguage'=>'en',
        'defaultLogo'=>$this->Url->build('/img/home-icon.png',true),
        'showListFirst'=>true,
        'doNotCollapse'=>false,
        'ie6Hack'=>false,
        'testGUI'=>false,
        'myEntityID'=>null,
        'ignoreURLParams'=> true,
        'maxResults'=>10,
        'setFocusTextBox'=>true,
        'insertAtDiv'=>'idpSelect',
        'defaultLogoHeight'=>80,
        'defaultLogoWidth'=>90,
        'helpURL'=> $this->Url->build('/help',true),
        'dataSource'=> $this->Url->build($dataSource,true),
        'defaultReturn'=> $this->Url->build($url,true)
    ];
    
    //helpURL, defaultLogoHeight, insertAtDiv, defaultLogo
    
?>
<?= $this->Flash->render('auth') ?>
<div class="login-box" style="max-width:550px; width: 560px;">
    <div class="login-logo">
    <?= $client_name?>
    </div>
      <div class="login-box-body">
          <p class="login-box-msg">Sign in to start your session<br>or create an account <a href="./add?view=new">here</a>.</p>
          <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                        <?= h($title)?>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                    <div class="box-body">
                        <div id="idpSelect" data-options='<?= h(json_encode($idpSelectOptions,JSON_UNESCAPED_SLASHES));?>'></div>
                        <noscript>
                        <p>
                        <strong>Login:</strong> Javascript is not available for your web browser. 
                        Therefore, please <?= $this->Html->link('proceed manually',$url)?>.
                        </p>
                        </noscript>
                    </div>
                  </div>
                </div>
                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                        Local Login
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                      <?= $this->Form->create() ?>
          <div class="form-group has-feedback">
            <?= $this->Form->input('username',['label'=>false,'placeholder'=>'Username','div'=>false]) ?>
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?= $this->Form->input('password',['label'=>false,'placeholder'=>'Password','div'=>false,'value'=>'']) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
                <?= $this->Form->input('remember_me',['type'=>'checkbox']) ?>                       
            </div><!-- /.col -->
            <div class='row'>
                <div class="col-xs-4">
                  <?= $this->Form->button(__('Sign In'),[
                      'class'=>'btn-block btn-flat',
                      'div'=>false,
                      'bootstrap-type'=>'primary']); ?>
                </div><!-- /.col -->
                <div class='col-xs-4'>
                    <div style="padding-top: 5px">
                    <?= $this->Html->link(__('Reset Password'), 
			        	['action' => 'recover']) ?>
                    </div>
                </div><!-- /.col -->
            </div>
        </div>
        <?= $this->Form->end() ?>
                    </div>
                  </div>
                </div>
                
              </div>
        <i><?= $app_tag_line?></i>
        <!--
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        <!--<a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>-->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <?php 
    echo $this->Html->script('/libs/shibboleth/idpselect_config.js');
    echo $this->Html->script('/libs/shibboleth/idpselect.js');
    ?>