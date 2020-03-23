<?php //dump($courses);exit;?>
<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-plus"></i>
            Invite Users
        </h3>

        <h3>
            Select Course
        </h3>
        <div class="panel-group">
            <?php foreach($courses as $index=>$course): ?>
                <div class="panel panel-warning">
                    <div class="panel-heading" role="tab">
                        <h5>
                            <?= $this->Html->link($course->name, '#toggle_'.$course->id, [
                                'data-toggle' => 'collapse',
                                'role'        => 'button'
                            ]) ?>
                        </h5>
                    </div>
                    <div id="toggle_<?= $course->id ?>" class="panel-collapse collapse" role="tabpanel">
                        <div class="panel-body">
                            <?php if($course->modules): ?>
                                <?= $this->Form->create(false, ['id' => $course->id.'_form']) ?>
                                    <h3>Select Modules</h3>
                                    <?php foreach($course->modules as $module_index=>$module): ?>
                                        <div class="d-inline">
                                            <?= $this->Form->input('modules['.$module_index.']', 
                                                [
                                                    'type'  => 'checkbox',
                                                    'label' => $module->name,
                                                    'value' => $module->id
                                                ])?>
                                        </div>
                                    <?php endforeach; ?>
                                <?= $this->Form->end();?>
                                <h3>Select Users</h3>
                                <?= $this->Form->control('test') ?>
                            <?php else: ?>
                                <h4>No Modules on this course yet</h4>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>