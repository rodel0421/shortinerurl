<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Test $test
  */
?>

<style>
.inner-header h3{
    margin-top: 5px;
    margin-bottom: 5px;
    margin-left: 5px;
    /* text-align: left; */
    display: inline-block;

}

.inner-header thead th a {
    margin-top: 3px;
}

th.text-center {
    text-align: left !important;
}
th.text-center{
background: #4f6d7a;

}


</style>
<div class="tests view large-9 medium-8 columns content">
<div class='box box-primary'>
    <div class='box-header'>
    </br>
        <!-- <h3><#?= h($test->id) ?></h3> -->
    	<div class="box-tools pull-right">    	
            <?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                            . '</span>', ['action' => 'index'], 
                            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                            
            <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                            . '</span>', ['action' => 'edit', $test->id], 
                            ['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
            <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                            . '</span>', ['action' => 'delete', $test->id], 
                            ['confirm' => __('Are you sure you want to delete # {0}?', $test->id), 'escape' => false, 
                                    'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
            <?= $this->element('guide', array("section" => 'formTemplates')) ?>
      </div>
    </div>
    <div class='box-body'>
    <table class="table table-striped inner-header">
        <thead>
            <tr class="bg-primary text-white">
                <th class="text-center" colspan="2"><h3><?= 'Details' ?></h3></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="50%" class="bg-gray">Type</td>
                <td width="50%"><?= h($test->course_test_type->value) ?></td>
            </tr>
            <tr>
                <td width="50%" class="bg-gray">Module</td>
                <td width="50%"><?= $test->has('module') ? $this->Html->link($test->module->name, ['controller' => 'Modules', 'action' => 'view', $test->module->id]) : '' ?></td>
            </tr>
        </tbody>
    </table>
    
</div>
<?php if($test->course_test_type->value == 'Practical'): ?>
    <div class="related">
        <div class='box-body'>
            <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th class="text-center" colspan="7">
                                    <h3><?= 'Related Questions' ?></h3>
                                    <?= $this->Html->link('Add question', [
                                        'controller' => 'CourseQuestions',
                                        'action' => 'practicaladd',
                                        $test->id
                                    ],
                                    [
                                        'type' => 'button',
                                        'class' => [
                                            'btn',
                                            'btn-sm',
                                            'btn-success',
                                            'pull-right'
                                        ]
                                    ]); ?>
                                </th>
                            </tr>
                            <tr class="bg-gray">
                                <th scope="col"><?= __('ID') ?></th>
                                <th scope="col"><?= __('Title') ?></th>
                                <th scope="col"><?= __('Marks') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>

                            </tr>
                        </thead>
                        <tbody id="sortable">
                            <?php if (!empty($test->questions)): ?>
                                <?php foreach ($test->questions as $questions): ?>
                                    <tr data-id="<?= $questions->id ?>" class="sortable">
                                        <td><?= h($questions->id) ?></td>
                                        <td><?= h($questions->title) ?></td>
                                        <td>
                                            <?php
                                                $output = "";
                                                foreach($questions->course_question_choices as $index => $choice)
                                                {
                                                    $output .= $choice->value;
                                                    if($index < (count($questions->course_question_choices) - 1)){
                                                        $output .= '<br> ';
                                                    }
                                                }
                                                echo $output;
                                            ?>
                                        </td>  
                           
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>',
                                                [
                                                    'controller' => 'CourseQuestions',
                                                    'action' => 'view',
                                                    $questions->id], 
                                                [
                                                    'escape' => false,
                                                    'class' => 'btn btn-xs btn-success',
                                                    'title' => __('View')
                                                ]);
                                            ?>
                                            <?= $this->Html->link(
                                                '<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                                                [
                                                    'controller' => 'CourseQuestions',
                                                    'action' => 'edit',
                                                    $questions->id
                                                ],
                                                [
                                                    'escape' => false,
                                                    'class' => 'btn btn-xs btn-warning',
                                                    'title' => __('Edit')
                                                ]);
                                            ?>
                                            <?php if($questions->active):?>
                                                <?= $this->Form->postLink(
                                                    '<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                                                    [
                                                        'controller' => 'CourseQuestions',
                                                        'action' => 'delete'
                                                        , $questions->id
                                                    ],
                                                    [
                                                        'confirm' => __('Are you sure you want to delete # {0}?', $questions->id),
                                                        'escape' => false,
                                                        'class' => 'btn btn-xs btn-danger',
                                                        'title' => __('Delete')
                                                    ]);
                                                ?>
                                            <?php endif;?>
                                            <?php if(!$questions->active):?>
                                                <?= $this->Form->postLink(
                                                    '<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') . '</span>',
                                                    [
                                                        'controller' => 'CourseQuestions',
                                                        'action' => 'restore'
                                                        , $questions->id
                                                    ], 
                                                    [
                                                        'confirm' => __('Are you sure you want to restore this?'),
                                                        'escape' => false,
                                                        'class' => 'btn btn-xs btn-info',
                                                        'title' => __('Restore')]);
                                                ?>
                                            <?php endif;?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php endif;?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
<?php else: ?>

    <div class="related">
        <div class='box-body'>
            <div class="table-responsive">
                    <table class="table table-hover inner-header">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th class="text-center" colspan="7">
                                    <h3><?= 'Related Questions' ?></h3>
                                    <?= $this->Html->link('Add question', [
                                        'controller' => 'CourseQuestions',
                                        'action' => 'add',
                                        $test->id
                                    ],
                                    [
                                        'type' => 'button',
                                        'class' => [
                                            'btn',
                                            'btn-sm',
                                            'btn-success',
                                            'pull-right'
                                        ]
                                    ]); ?>
                                </th>
                            </tr>
                            <tr class="bg-gray">
                                <th scope="col"><?= __('ID') ?></th>
                                <th scope="col"><?= __('Title') ?></th>
                                <th scope="col"><?= __('Type') ?></th>
                                <th scope="col"><?= __('Choices') ?></th>
                                <th scope="col"><?= __('Answer') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            <?php if (!empty($test->questions)): ?>
                                <?php foreach ($test->questions as $questions): ?>
                                    <tr data-id="<?= $questions->id ?>" class="sortable">
                                        <td><?= h($questions->id) ?></td>
                                        <td><?= h($questions->title) ?></td>
                                        <td><?= h($questions->course_question_type->value) ?></td>
                                        <td>
                                            <?php
                                                $output = "";
                                                foreach($questions->course_question_choices as $index => $choice)
                                                {
                                                    $output .= $choice->value;
                                                    if($index < (count($questions->course_question_choices) - 1)){
                                                        $output .= '<br> ';
                                                    }
                                                }
                                                echo $output;
                                            ?>
                                        </td>  
                                        <td>
                                            <?php
                                                $output = "";
                                                foreach($questions->answers as $index => $answer)
                                                {
                                                    $output .= $answer->value;
                                                    if($index < (count($questions->answers) - 1)){
                                                        $output .= ',<br> ';
                                                    }
                                                }
                                                echo $output;
                                            ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>',
                                                [
                                                    'controller' => 'CourseQuestions',
                                                    'action' => 'view',
                                                    $questions->id], 
                                                [
                                                    'escape' => false,
                                                    'class' => 'btn btn-xs btn-success',
                                                    'title' => __('View')
                                                ]);
                                            ?>
                                            <?= $this->Html->link(
                                                '<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                                                [
                                                    'controller' => 'CourseQuestions',
                                                    'action' => 'edit',
                                                    $questions->id
                                                ],
                                                [
                                                    'escape' => false,
                                                    'class' => 'btn btn-xs btn-warning',
                                                    'title' => __('Edit')
                                                ]);
                                            ?>
                                            <?php if($questions->active):?>
                                                <?= $this->Form->postLink(
                                                    '<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                                                    [
                                                        'controller' => 'CourseQuestions',
                                                        'action' => 'delete'
                                                        , $questions->id
                                                    ],
                                                    [
                                                        'confirm' => __('Are you sure you want to delete # {0}?', $questions->id),
                                                        'escape' => false,
                                                        'class' => 'btn btn-xs btn-danger',
                                                        'title' => __('Delete')
                                                    ]);
                                                ?>
                                            <?php endif;?>
                                            <?php if(!$questions->active):?>
                                                <?= $this->Form->postLink(
                                                    '<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') . '</span>',
                                                    [
                                                        'controller' => 'CourseQuestions',
                                                        'action' => 'restore'
                                                        , $questions->id
                                                    ], 
                                                    [
                                                        'confirm' => __('Are you sure you want to restore this?'),
                                                        'escape' => false,
                                                        'class' => 'btn btn-xs btn-info',
                                                        'title' => __('Restore')]);
                                                ?>
                                            <?php endif;?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php endif;?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="related">
        <?php if (!empty($test->user_tests)): ?>
        <table cellpadding="0" cellspacing="0">
              <tr class="bg-primary text-white">
                <th class="text-center" colspan="6"><h3><?= 'Related Users' ?></h3></th>
            </tr>
            <tr class="bg-gray">
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Test Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Answer') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($test->user_tests as $userTests): ?>
            <tr>
                <td><?= h($userTests->id) ?></td>
                <td><?= h($userTests->test_id) ?></td>
                <td><?= h($userTests->user_id) ?></td>
                <td><?= h($userTests->status) ?></td>
                <td><?= h($userTests->answer) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserTests', 'action' => 'view', $userTests->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserTests', 'action' => 'edit', $userTests->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserTests', 'action' => 'delete', $userTests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userTests->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript"> 
//<![CDTA[

$(document).ready(function(){
    $('#sortable').sortable({
    placeholder             : 'drop-placeholder',
    stop                    : function( event, ui ) {
        var id = ui.item.attr('data-id');
        var position = ui.item.index() + 1;
        if(id){
            var url = "<?= $this->Url->build(['controller'=>'CourseQuestions','action'=>'reorder']) ?>/" + id +"?position="+ position;
            $.get( url, function( data ) {
            });
        }
        
    }
    });
  $('tr.sortable').css('cursor', 'move');
  
});

//]]>
</script>