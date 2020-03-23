<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CourseQuestion[]|\Cake\Collection\CollectionInterface $courseQuestions
  */
//   dump($courseQuestions);exit;
?>



<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar"> -->
    <div class="btn-group" role="group" aria-label="...">
        <?= $this->Html->link('<i class="fa fa fa-plus" aria-hidden="true"></i> Add Question', ['action' => 'add'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'Add question']) ?>
        <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Tests', ['controller' => 'Tests', 'action' => 'index'],['escape' => false, 'class'=>'btn btn-default','title' => 'List all tests']) ?>
        <?= $this->Html->link('<i class="fa fa fa-plus" aria-hidden="true"></i> Add Test', ['controller' => 'Tests', 'action' => 'add'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'Add test']) ?>
    </div>
<!-- </nav> -->

<div class="box">
<div class='box-header'><h3 class='box-title'>
            <i class="fa fa-pencil-square-o"></i> <?= $this->request->query('archived')?'Deleted':''?> Course Questions</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
      </div>
      </div>
    </div>
        <table class="table table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('course_test_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Choices') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Answers') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($courseQuestions as $courseQuestion): ?>
            <tr data-id="<?= $courseQuestion->id?>">
                <td><?= h($courseQuestion->id) ?></td>
                <td><?= h($courseQuestion->course_test_id) ?></td>
                <td><?= h($courseQuestion->question) ?></td>
                <?php if($courseQuestion->course_test->course_test_type_id == '2'): ?> 
                <td></td>
                <td></td>
                <td></td>
                <?php else: ?>
                    <td><?= h($courseQuestion->course_question_type->value) ?></td>
                <td>
                    <?php
                        $output = "";
                        foreach($courseQuestion->course_question_choices as $index => $choice)
                        {
                            $output .= $choice->value;
                            if($index < (count($courseQuestion->course_question_choices) - 1)){
                                $output .= ',<br> ';
                            }
                        }
                        echo $output;
                    ?>
                </td>                
                <td>
                    <?php
                        $output = "";
                        foreach($courseQuestion->answers as $index => $answer)
                        {
                            $output .= $answer->value;
                            if($index < (count($courseQuestion->answers) - 1)){
                                $output .= ',<br> ';
                            }
                        }
                        echo $output;
                    ?>
                </td>
                <?php endif;?>
                

                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $courseQuestion->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $courseQuestion->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    <?php if($courseQuestion->active):?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),['action' => 'delete', $courseQuestion->id],['confirm' => __('Are you sure you want to delete # {0}?', $courseQuestion->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')])?>
                    <?php endif;?>
                    <?php if(!$courseQuestion->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $test->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                    <?php endif;?>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>