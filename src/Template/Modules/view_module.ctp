<?php $this->assign('title', $module->name);?>
<?= $this->Html->css('tarosearch.css')?>


<!-- content -->

<section class="banner">
 
</section>
<section class="mb-5">
    <div class="container">
        <h3 class="header-title">
            <?= h($module->name) . ' - '; ?>
            <small> <?= h($module->code); ?></small>
        </h3>
        <?= $module->description; ?>
        <!-- <?php if(isset($module->tests)):?>
                <?php 
                    $passed = [];
                    $reopened = [];
                    $incomplete = [];
                    $open = [];
                    $submitted = [];
                ?>
                <?php foreach($module->tests as $test): ?>
                    <?php 
                        if(isset($test->user_tests[0])){
                            $status = $test->user_tests[0]->status;
                            if($status == "passed"){
                                echo 'passed';
                                array_push($passed, $test);
                            }
                            elseif($status == 'reopened'){
                                array_push($reopened, $test);
                            }
                            elseif($status == 'incomplete'){
                                array_push($incomplete, $test);
                            }
                            elseif($status == 'submitted'){
                                array_push($submitted, $test);
                            }
                        }else{
                            array_push($open, $test);
                        }
                    ?>
                <?php endforeach;?>
            <div class="containter my-4">
                <?php if ($open): ?>
                    <h4 class="font-weight-bold" >
                        Open Tests
                    </h4>
                    <?php foreach($open as $index=>$test):?>
                        <ul>
                            <li><?= $this->Html->link($test->name.' - '. $test->course_test_type->value, ['controller' => 'tests', 'action' => 'takeTest', $test->id], ['confirm' => 'Do you want to take this test now?']); ?></li>
                        </ul>
                    <?php endforeach;?>
                <?php endif;?>
                <?php if ($submitted): ?>
                    <h4 class="font-weight-bold" >
                        Submitted Tests
                    </h4>
                    <?php foreach($submitted as $index=>$test):?>
                        <ul>
                            <li><?= $this->Html->link($test->name.' - '. $test->course_test_type->value, ['controller' => 'tests', 'action' => 'takeTest', $test->id], ['confirm' => 'Do you want to take this test now?']) ?></li>
                        </ul>
                    <?php endforeach;?>
                <?php endif;?>
                <?php if ($incomplete): ?>
                    <h4 class="font-weight-bold" >
                        Incomplete Tests
                    </h4>
                    <?php foreach($incomplete as $index=>$test):?>
                        <ul>
                            <li><?= $this->Html->link($test->name.' - '. $test->course_test_type->value, ['controller' => 'tests', 'action' => 'takeTest', $test->id], ['confirm' => 'Do you want to take this test now?']) ?></li>
                        </ul>
                    <?php endforeach;?>
                <?php endif;?>
                <?php if ($reopened): ?>                
                    <h4 class="font-weight-bold" >
                        Reopened Tests
                    </h4>
                    <?php foreach($reopened as $index=>$test):?>
                        <ul>
                            <li><?= $this->Html->link($test->name.' - '. $test->course_test_type->value, ['controller' => 'tests', 'action' => 'takeTest', $test->id], ['confirm' => 'Do you want to take this test now?']) ?></li>
                        </ul>
                    <?php endforeach;?>
                <?php endif;?>
                <?php if ($open): ?>                
                    <h4 class="font-weight-bold" >
                        Passed Tests
                    </h4>
                    <?php foreach($passed as $index=>$test):?>
                        <ul>
                            <li><?= $this->Html->link($test->name.' - '. $test->course_test_type->value, ['controller' => 'tests', 'action' => 'takeTest', $test->id], ['confirm' => 'Do you want to take this test now?']) ?></li>
                        </ul>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        <?php endif;?> -->
    </div>
</section>