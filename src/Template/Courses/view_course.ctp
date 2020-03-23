<section class="banner">	
</section>
<?php $this->assign('title', $course->name);?>
<section>
    <div class="container mb-5">
        <h3 class="header-title">
            <?= h($course->name) . ' - '; ?>
            <small> <?= h($course->code); ?></small>
        </h3>
        <p class="text-muted"><?= $course->description; ?></p>

        <div class="containter my-4">
            <h4 class="font-weight-bold" >
                Modules
            </h4>
            <?php if(count($course->modules) > 0):?>
                    <ul>
                        <?php if($isEnrolled): ?>
                            <?php foreach($course->modules as $module):?>
                                <li><?= $this->Html->link($module->name, ['controller' => 'modules', 'action' => 'viewModule', $module->id]) ?></li>
                            <?php endforeach;?>
                        <?php else: ?>
                            <?php foreach($course->modules as $module):?>
                                <li><?= $module->name ?></li>
                            <?php endforeach;?>                    
                        <?php endif; ?>
                    </ul>
            <?php else: ?>
                <p class="text-danger">This course has no modules yet, please contact your trainer</p>
            <?php endif;?>
        </div>
        <?php if(!$isEnrolled): ?>
            <div class="containter text-right">
                <button class="btn btn-warning btn-lg btn-main">Enroll Now!</button>
            </div>
        <?php endif;?>
    </div>
</section>