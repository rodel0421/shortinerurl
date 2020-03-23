<?php
$auth_user = $this->request->session()->read('Auth');
if(isset($auth_user['User'])):

$avatar = 'img/profile.jpg';
if(!empty($auth_user['User']['profile_url'])){
    
    $avatar = $auth_user['User']['profile_url'];
    $this->Dak->allow_file($avatar);
}
?>


<li class="dropdown user user-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <?php echo $this->Html->image($avatar,array('class'=>'user-image','alt'=>'', 'id'=>'top-userimage', 'pathPrefix' => ''));?>
  <span class="hidden-xs"><?php echo h($auth_user['User']['name']);?></span>
</a>
<ul class="dropdown-menu">
  <!-- User image -->
  <li class="user-header">
    <?php echo $this->Html->image($avatar,array('class'=>'img-circle','alt'=>'User Image', 'id'=>'profile-userimage', 'pathPrefix' => ''));?>
    <p>
      <?php echo h($auth_user['User']['name']); ?> 
      <small>Member since <?php echo $auth_user['User']['created'];?></small>
    </p>
  </li>
  <!-- Menu Body -->
  <li class="user-body">

  </li>
  <!-- Menu Footer-->
  <li class="user-footer">
    <div class="pull-left">

        <?php echo $this->Html->link('Profile',array('plugin' => null,'controller'=>'Users','action'=>'view',$auth_user['User']['id']),array('class'=>'btn btn-default btn-flat'));?>    </div>
    <div class="pull-right">

    <?php echo $this->Html->link('Sign out',array('plugin' => null,'controller'=>'Users','action'=>'logout'),array('class'=>'btn btn-default btn-flat','onclick'=>'signOut();'));?>
    </div>
  </li>
</ul>
</li>
<?php else:?>
<li>
    <?= $this->Html->link('Login', 
    ['plugin' => null,'controller'=>'Users','action' => 'login'],
    ['escape'=>false]) ?>
</li>
<?php endif;?>
