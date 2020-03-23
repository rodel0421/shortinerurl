<p class="lead">Department Status Update for <?= h($department->name) ?></p>

<table class='table'>
    <thead>
        <tr>
            <th>Name</th>
            <th>Expiring Certifications</th>
            <th>Expiring Registers</th>
        </tr>
    </thead>
    <tbody>

<?php 
foreach($users as $user):
    if(!empty($user->registers) || !empty($user->certifications)):?>
        <tr>
            <th><?= h($user->name)?></th>
            <td>
                <?php 
                if(!empty($user->certifications)):
                foreach($user->certifications as $certification):?>
                <?= $certification->has('certification_type')? h($certification->certification_type->name) : 'Unknown' ?>
                (<?=  $certification->expires->timeAgoInWords(); ?>)

                <br/>
                <?php endforeach;
                else:
                    echo '&nbsp;';
                endif;
                ?>
            </td>
            <td>
                <?php 
                if(!empty($user->registers)):
                foreach($user->registers as $register):?>
                <?= $register->has('register_template')? h($register->register_template->name) : 'Unknown' ?><br/>
                <?php endforeach;
                else:
                    echo '&nbsp;';
                endif;
                ?>
            </td>
        </tr>
<?php 
    endif;
endforeach;?>
    </tbody>
</table>

<p></p>
<p>If you do not wish to be notified of these anymore, please login and replace them with current certifications or delete them.</p>