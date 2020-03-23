<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="btn-group" role="group" aria-label="...">
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Course Questions', ['action' => 'index'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'List Questions']) ?>
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Course Tests', ['controller' => 'Tests', 'action' => 'index'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'List Modules']) ?>
    <?= $this->Html->link('<i class="fa fa fa-plus" aria-hidden="true"></i> Add Test', ['controller' => 'Tests', 'action' => 'add'] , ['escape' => false, 'class'=>'btn btn-default','title' => 'Add Test']) ?>
</div>
<div class="courseQuestions form large-9 medium-8 columns content">
    <?= $this->Form->create($courseQuestion, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add Course Question') ?></legend>
            <?= $this->Form->control('course_test_id', ['options' => $courseTests,  'value' => $courseTestID, ($courseTestID) ? 'disabled' : '']); ?>
            <?= ($courseTestID) ? $this->Form->hidden('course_test_id', ['value' => $courseTestID]) : '' ?>
            <?= $this->Form->control('title'); ?>
            <?= $this->Form->control('question'); ?>
            <?= $this->Form->control('course_question_type_id', ['options' => $courseQuestionTypes, 'id' => 'question_type_select']); ?>
            <div id="choices-container">
                <div id="choices-modal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modify Choices</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table" id="choices-table">
                                <thead>
                                    <tr>
                                        <th>Choices</th>
                                        <th> <?= $this->Form->button('+', ['class' => ['btn','btn-sm','btn-success'], 'type' => 'button', 'onclick' => "addChoice()"]) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?= $this->Form->input('choices[]',['label' => false]) ?>
                                        </td>
                                        <td>
                                            <?= $this->Form->button('&times;', ['class' => ['btn','btn-sm','btn-danger'], 'type' => 'button', 'disabled']) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
                <?= $this->Form->button('Choices', ['type' => 'button', 'class' => ['btn','btn-sm','btn-success'], 'data-toggle' => 'modal', 'data-target' => '#choices-modal']) ?>
                <span>Required</span>
            </div>
            <div id="img-div" style="display:none">
                <?= $this->Form->control('img', ['type' => 'file']); ?>
            </div>
            <?= $this->Form->control('active'); ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
    const addChoice = () => {
        let choice = $('[name="choices[]"]');
        let choice_tr = $('#choices-table tbody tr:first').clone();
        let tr_id = Math.floor(Math.random() * 90 + 10);
        while($( '#tr'+tr_id ).length > 0){
            console.log($('#choices-table tbody tr').length);
            tr_id = Math.floor(Math.random() * 90 + 10);
        }
        choice_tr.attr('id', 'tr'+tr_id);
        choice_tr.find('button').removeAttr('disabled');
        choice_tr.find('button').click(e => removeTr('#tr'+tr_id));
        choice_tr.find('input').val('');
        $('#choices-table tbody').append(choice_tr);
    }
    const removeTr = (id) => {
        $(id).remove();
    }
</script>