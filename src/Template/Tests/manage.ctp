<?php
    // dump($students );exit;
    $open_btn = $this->Form->button('<span class="glyphicon glyphicon-triangle-right" status="open"></span>', 
        [
            'status' => 'open',
            'class' => 'btn btn-xs btn-success open-btn status',
            'title' => 'open exam for student',
            'escape' => false
        ]);
    $reopen_btn = $this->Form->button('<span class="glyphicon glyphicon-triangle-right" status="reopen"></span>', 
    [
        'status' => 'reopen',
        'class' => 'btn btn-xs btn-success reopen-btn status',
        'title' => 'reopen exam for student',
        'escape' => false
    ]);
    $view_btn = $this->Form->button('<span class="glyphicon glyphicon-zoom-in"></span>', 
    [
        'class' => 'btn btn-xs btn-primary view-btn',
        'title' => 'view exam',
        'escape' => false
    ]);
    $disable_btn = $this->Form->button('<span class="glyphicon glyphicon-stop" status="disable"></span>', 
    [
        'status' => 'disable',
        'class' => 'btn btn-xs btn-danger disable-btn status',
        'title' => 'disable exam',
        'escape' => false
    ]);
    $check_btn = $this->Form->button('<span class="glyphicon glyphicon-ok"></span>', 
    [
        'class' => 'btn btn-xs btn-warning check-btn',
        'title' => 'check exam',
        'escape' => false
    ]);
    $show_btn = $this->Form->button('<span class="glyphicon glyphicon-eye-open"></span>', 
    [
        'class' => 'btn btn-xs btn-primary show-btn',
        'title' => 'show credentials',
        'escape' => false
    ]);


    $open_btn_group = [
        $disable_btn,
        $show_btn,
    ];
    $available_btn_group = [
        $open_btn,
    ];
    $disabled_btn_group = [
        $reopen_btn,
        $view_btn
    ];
    $failed_btn_group = [
        $reopen_btn,
        $view_btn,
        $show_btn
    ];
    $expired_btn_group = [
        $reopen_btn,
        $show_btn
    ];
    $submitted_btn_group = [
        $check_btn,
        $show_btn
    ];
    $passed_btn_group = [
        $view_btn,
        $show_btn
    ];
    $btn_groups = [
        'open' => $open_btn_group,
        'failed' => $failed_btn_group,
        'available' => $available_btn_group,
        'submitted' => $submitted_btn_group,
        'expired' => $expired_btn_group,
        'disabled' => $disabled_btn_group,
        'passed' => $passed_btn_group
    ]

?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="glyphicon glyphicon-cog"></i>
            Manage
            <?= h($test->name)?>
        </h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($students as $index=>$student): ?>
                        <tr student_id="<?= $student->id?>" test_id="<?=$test->id?>" student_name="<?= $student->name ?>" user_test_id="<?= ($student->user_tests) ? $student->user_tests[0]->id : '' ?>">
                            <td><?= h($student->id) ?></td>
                            <td><?= h($student->name) ?></td>
                            <td class="status">
                            <?php if($test->course_test_type_id == '2'): ?>
                               
                            
                                <?php if(empty($student->user_tests[0]->status)):?>
                                    <span class="status submitted">
                                    <?php echo 'Pending'; ?> 
                                    </span>
                                <?php elseif($student->user_tests[0]->status == 'passed'): ?>
                                    <span class="status passed">
                                    <?php echo $student->user_tests[0]->status;?>
                                    </span>
                                <?php elseif($student->user_tests[0]->status == 'failed'): ?>
                                    <span class="status failed">
                                    <?php echo $student->user_tests[0]->status;?>
                                    </span>
                                <?php else: ?>
                                    <span class="status available">
                                    <?php echo 'Pending';?>
                                    </span>
                                <?php endif;?>
                             

                            <?php else: ?>
                                <?php if($student->user_tests) : ?>
                                <span class="status <?= $student->user_tests[0]->status?>"><?= h($student->user_tests[0]->status) ?></span>
                                <?php if($student->user_tests[0]->status == 'open'){
                                    echo 'until '.$student->user_tests[0]->user_test_credential->open_until;
                                }?>
                                <?php else : ?>
                                    <span class="status available">available</span>
                                <?php endif; ?>
                            <?php endif; ?>
                            </td>
                            <td class="actions">
                                 <?php if($test->course_test_type_id == '2'): ?>
                            
                                <?php if(empty($student->user_tests[0]->status)): ?> 
                                <?= $this->Html->link('<span class="glyphicon glyphicon-check"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'checklist', $test->id, $student->id], ['escape' => false, 'class' => 'btn btn-xs btn-primary', 'title' => __('Take Practical Test')]) ?>
                                <?php elseif($student->user_tests[0]->status == 'failed'): ?>
                                <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'UserTests','action' => 'clview', $student->user_tests[0]->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View Practical Test')]) ?>
                            
                                <?= $this->Html->link('<span class="glyphicon glyphicon-refresh"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'checklist', $test->id, $student->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Redo Practical')]) ?>
                                <!-- <#?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'evidence', $test->id, $student->id], ['escape' => false, 'class' => 'btn btn-xs btn-primary', 'title' => __('Evidence Practical')]) ?> -->

                             
                                <?php elseif($student->user_tests[0]->status == 'passed'):?>
                                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'UserTests','action' => 'clview', $student->user_tests[0]->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View Practical Test')]) ?>
                                    <!-- <#?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'evidence', $test->id, $student->id], ['escape' => false, 'class' => 'btn btn-xs btn-primary', 'title' => __('Evidence Practical')]) ?> -->

                                <?php else:?>
                            <!-- <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'Users', 'action' => 'view', $student->id], ['escape' => false, 'class' => 'btn btn-xs btn-primary', 'title' => __('Take Practical')]) ?> -->
                                <?= $this->Html->link('<span class="glyphicon glyphicon-check"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'checklist', $test->id, $student->id], ['escape' => false, 'class' => 'btn btn-xs btn-primary', 'title' => __('Take Practical Test')]) ?>
                                <?php endif;?>
                            <?php else: ?>
                                
                                <?php if($student->user_tests) : ?>
                                    <?php foreach($btn_groups[$student->user_tests[0]->status] as $btn) :?>
                                        <?= $btn ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <?php foreach($btn_groups['available'] as $btn) :?>
                                        <?= $btn ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                            <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="output_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <small class="text-uppercase">
                    id:
                </small>
                <h4 id="test_id">1</h4>
                <small class="text-uppercase">
                    pin:
                </small>
                <h4 id="test_pin">2</h4>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    let status_tr, status_td, action_td, date_opened, date_until;
    let open_btn_group = (
        '<?php foreach($btn_groups['open'] as $btn) :?>
            <?= $btn ?>
        <?php endforeach; ?>'
    );
    let failed_btn_group = (
        '<?php foreach($btn_groups['failed'] as $btn) :?>
            <?= $btn ?>
        <?php endforeach; ?>'
    );
    let submitted_btn_group = (
        '<?php foreach($btn_groups['submitted'] as $btn) :?>
            <?= $btn ?>
        <?php endforeach; ?>'
    );
    let disabled_btn_group = (
        '<?php foreach($btn_groups['disabled'] as $btn) :?>
            <?= $btn ?>
        <?php endforeach; ?>'
    );
    let expired_btn_group = (
        '<?php foreach($btn_groups['expired'] as $btn) :?>
            <?= $btn ?>
        <?php endforeach; ?>'
    );
    let available_btn_group = (
        '<?php foreach($btn_groups['available'] as $btn) :?>
            <?= $btn ?>
        <?php endforeach; ?>'
    );
    let btn_groups = [];

    btn_groups['open'] = open_btn_group;
    btn_groups['disabled'] = disabled_btn_group;

    $(document).on('click','button.status',(e) => {
        let el = $(e.target);
        let status = el.attr('status');
        let tr = el.closest('tr');
        let url = "<?= $this->Url->build(['controller'=>'UserTests','action'=>'changeUserTestStatus']) ?>";
        let data = {
                student_id: tr.attr('student_id'),
                test_id: tr.attr('test_id'),
                status: status
            }
        if(status != 'open'){
            data = {
                user_test_id : tr.attr('user_test_id'),
                status: status
            }
        }
        $.ajax({
            type    : 'GET',
            url     : url,
            data    : data,
        }).done((data) => {
            status_tr = $('tr[student_id="'+data.user_id+'"]');
            status_td = status_tr.find('td.status');
            action_td = status_tr.find('td.actions');
            content = "<span class='status "+data.status+"'>"+data.status+"</span>"
            if(data.status == 'open'){
                $('#output_modal .modal-title').text(data.user.name + "'s Credentials");
                $('#test_id').text(data.user_test_credential.login_id);
                $('#test_pin').text(data.user_test_credential.login_pin);
                $('#output_modal').modal('show');                
                content += ' until ' + data.user_test_credential.open_until;
                tr.attr('student_id', data.user.id);
                tr.attr('test_id', data.course_test_id);
                tr.attr('user_test_id', data.id);
                tr.attr('student_name', data.user.id);
            }
            status_td.html(content);
            action_td.html(btn_groups[data.status]);
        })
        .fail(function() {
            alert('Error opening user test. Please try again later');
        })
    });

    $(document).on('click','button.check-btn', (e) => {
        let el = $(e.target);
        let status = el.attr('status');
        let tr = el.closest('tr');
        let url = "<?= $this->Url->build(['controller'=>'UserTests','action'=>'check']) ?>";
        url += '/' + tr.attr('user_test_id')
        location.replace(url);
    })
    $(document).on('click','button.view-btn', (e) => {
        let el = $(e.target);
        let status = el.attr('status');
        let tr = el.closest('tr');
        let url = "<?= $this->Url->build(['controller'=>'UserTests','action'=>'check']) ?>";
        url += '/' + tr.attr('user_test_id')
        location.replace(url);
    })
    $(document).on('click','button.show-btn', (e) => {
        let el = $(e.target);
        let status = el.attr('status');
        let tr = el.closest('tr');
        let url = "<?= $this->Url->build(['controller'=>'UserTests','action'=>'getCredentials']) ?>";
        if(status != 'open'){
            data = {
                user_test_id : tr.attr('user_test_id'),
                status: status
            }
        }
        $.ajax({
            type    : 'GET',
            url     : url,
            data    : data,
        }).done((data) => {
            console.log(data);
            $('#output_modal .modal-title').text(data.user.name + "'s Credentials");
            $('#test_id').text(data.user_test_credential.login_id);
            $('#test_pin').text(data.user_test_credential.login_pin);
            $('#output_modal').modal('show');                
        })
        .fail(function() {
            alert('Error opening user test. Please try again later');
        })
    })

</script>