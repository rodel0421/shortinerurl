<style>
    th.text-center{
    background: #4f6d7a;

    }

button.btn.btn-sm.btn-success.pull-right {
    margin-top: 3px;
}

.inner-header thead th a {
    margin-top: 3px;
}

th.text-center {
    text-align: left !important;
}

.inner-header h3{
    margin-top: 5px;
    margin-bottom: 5px;
    margin-left: 5px;
    /* text-align: left; */
    display: inline-block;

}
.modal-body {
    height: 50vh;
}

</style>



<?php //dump($course);exit; ?>
<div class="courses view large-9 medium-8 columns content">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../">Course</a></li>
    <li class="breadcrumb-item active" aria-current="page">View</li>
  </ol>
</nav>
    <table class="table table-striped inner-header">
        <thead>
            <tr class="bg-primary text-white">
                <th class="text-center" colspan="2"><h3><?= h($course->name)?></h3></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="50%" class="bg-gray">Code</td>
                <td width="50%"><?= h($course->code)?></td>
            </tr>
            <tr>
                <td width="50%" class="bg-gray">Description</td>
                <td width="50%"><?= $course->description ?></td>
            </tr>
        </tbody>
    </table>

    <table class="table table-striped double-click inner-header">
        <thead>
            <tr class="bg-primary text-white">
                <th colspan="3" class="text-center">
                    <h3 >Modules</h3>
                    <?= $this->Html->link('Add module', [
                        'controller' => 'Modules',
                        'action' => 'add',
                        $course->id
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
            <tr>
                <th>#</th>
                <th>Module</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($course->modules)): ?>
                <?php foreach($course->modules as $module):?>
                <tr data-id="<?= $module->id ?>">
                    <td><?= h($module->id) ?></td>
                    <td><?= h($module->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'Modules','action' => 'view', $module->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'Modules','action' => 'edit', $module->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                        <?php if($module->active):?>
                            <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),['controller' => 'Modules','action' => 'delete', $module->id],['confirm' => __('Are you sure you want to delete # {0}?', $module->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')])?>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
            <?php else:?>
                <tr>
                    <td colspan="7" class="text-center">No related modules</td>
                </tr>
            <?php endif;?>
        </tbody>
    </table>
    <?php if (!empty($course->modules)): ?>
        <table class="table table-striped inner-header">
            <thead>
                <tr class="bg-primary text-white">
                    <th colspan="4" class="text-center">
                        <h3>Enrolled Users</h3>
                        <?= $this->Form->button('Invite users', [
                            'type' => 'button',
                            'class' => [
                                'btn',
                                'btn-sm',
                                'btn-success',
                                'pull-right'
                            ],
                            'data-toggle' => 'modal',
                            'data-target' => '#inviteModal'
                        ]); ?>
                    </th>
                </tr>
            </thead>    
            <tbody>
                <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>View</th>
                </tr>
                <?php if (!empty($course->course_enrolled_users)): ?>
                        <?php foreach($course->course_enrolled_users as $user):?>
                        <?php if($user->status != 'invited') : ?>
                    <tr width="100%">
                                <td>
                                    <?= h($user->user->id); ?>  
                                </td>

                                <td>                            
                                    <?= h($user->user->given_name. ' ' .$user->user->surname);  ?>
                                </td>
                                <td>
                                    <?php echo "Enrolled"; ?>
                                </td>
                                <td>
                                    <?= $this->Html->link('<span class="glyphicon glyphicon-eye-open">', ['controller' => 'Users', 'action' => 'view', $user->user->id ], ['escape' => false]) ?>
                                </td>
                    </tr>
                        <?php endif;?>
                            <?php endforeach;?>
                       
                <?php else:?>
                    <tr>
                        <td class="text-center">No enrolled user</td>
                    </tr>
                <?php endif;?>
            </tbody>
        </table>
    <?php endif;?>
</div>

<?php if (!empty($course->modules)): ?>
    <!-- Modal -->
    
    <div class="modal fade" id="inviteModal" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">ADD USERS</h4>
            </div>
            <div class="modal-body " style="min-height: auto;">
                <?= $this->Form->create(false, ['url' => ['controller' => 'Courses', 'action' => 'invite', $course->id], 'id' =>'invite-form']) ?>
                <div class="form-group">
                    <?= $this->Form->label('modules')?>
                    <?= $this->Form->select('modules', $modules_list , ['multiple' => true, 'class' => ['chosen-select', 'w-100'], 'id' => 'modules_select', 'value' => $course->modules[0]->id]); ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->label('students')?>
                    <?= $this->Form->select('students', 
                        $students , 
                        ['multiple' => true, 
                        'class' => ['chosen-select', 'w-100'], 
                        'id' => 'students_select']); ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
            <div class="modal-footer">
                <?= $this->Form->button('Send Invites', [
                    'id' => 'send-invites',
                    'class' => [
                        'btn',
                        'btn-success'
                    ],
                    'type' => 'button'
                ]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            
        </div>
    </div>
    
    <script type="text/javascript"> 

        const isEmail = (email) => {
            let format = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
            return (email.match(format) == null) ? false : true;
        }

        const emailExists = (email) => {
            let res = false;
            $("#students_select option").each((index) => {
                if($($("#students_select option")[index]).text() == email){
                    res = true;
                };
            });
            return res;
        }

        $('#send-invites').click((e) => {
            let el = $(e.target);
            let form = $($('#invite-form')[0]);
            console.log(form.attr('action'));
            $.ajax({
                type    : 'POST',
                url     : form.attr('action'),
                data    : form.serializeArray(),
            }).done(function(data) {
                alert(data.message);
                window.location.reload();
            })
            .fail(function() {
                alert('Error inviting users');
            })
        });
        $("#invite-form").submit((e) => {
            e.preventDefault();
        });

        $('#modules_select').change(() => {
            let url = "<?= $this->Url->build(['controller'=>'Courses','action'=>'refreshStudentOptions']) ?>";
            let modules = $('#modules_select').val();
            let data = {
                modules : modules,
            }
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : data,
            }).done(function(data) {
                console.log(data);
                if(data){
                let select = $('#students_select');
                select.empty();
                $.each(data, (value, key) => {
                        select.append($("<option></option>")
                            .attr("value", value).text(key));
                })
                select.trigger('chosen:updated');
                }
            })
            .fail(function() {
                alert('Error inviting users');
            })
        });

        $(document).on('keyup','#students_select_chosen input',(e) => {
            let el = $(e.target);
            let value = el.val();
            let keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                if(isEmail(value) && !emailExists(value)){
                    let select = $('#students_select');
                    select.append('<option value="'+value+'" selected>'+value+'</option>');
                    select.trigger('chosen:updated');
                }
            }
        })

        $('table.double-click tbody tr').dblclick(function (){
            var url = "<?php echo $this->Url->build(array('controller' => 'Modules', 'action'=>'view'));?>/"+$(this).attr('data-id');    
            window.location.href = url;
        });
    </script>
<?php endif;?>