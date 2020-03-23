<?php $this->assign('title', 'Login');?>

<?= $this->Flash->render('auth') ?>
<div class="login-box" style="max-width:350px;">
    <h1 id="logoImage">
        <?=
          $this->Html->link(
            $this->Html->image('taro_logo.png',['alt' => 'Taro Training']),
            '/',
            [
              'id' => 'logoImage1',
              'escape' => false
            ]
          );
        ?>
    </h1>
      <div class="login-box-body">
         
        <p class="login-box-msg">Sign in to start your session<br>or create an account <a href="./add?view=new">here</a>.</p>
        <?= $this->Form->create() ?>
        
       
        <?= $this->Form->input('target_url', ['type' => 'hidden','value' =>  $this->Url->build(['action' => 'gmaillogin'])]) ?>
        <?= $this->Form->input('target_urlfb', ['type' => 'hidden','value' =>  $this->Url->build(['action' => 'facebooklogin'])]) ?>
        <?= $this->Form->input('token', ['type' => 'hidden','value' =>  h($this->request->getParam('_csrfToken')) ]) ;?>

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
                <!-- <div class='col-xs-4'> -->
                    <div style="padding-top: 5px">
                    <?= $this->Html->link(__('Reset Password'), 
			        	['action' => 'recover']) ?>
                    </div>
                </div><!-- /.col -->
            </div>
        </div>
        <?= $this->Form->end(['data-type'=> 'hidden']) ?>
        <i><?= $app_tag_line?></i>
        
        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a class="btn btn-block btn-social btn-facebook btn-flat" onclick="fbLogin()"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a class="g-signin2 btn-block btn-google-plus btn-flat"  data-width="350" data-height="30" data-onsuccess="onSuccess" data-onfailure="onSuccess">Sign up with Google+</a>
        </div> -->
        <!-- /.social-auth-links -->

        <!--<a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->