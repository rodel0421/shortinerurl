<p class="lead">Account Status Update</p>
<p>Hi <?= h($user->name)?>,</p>
<?php if (!empty($user->registers)): ?>
<p>Here is a list of your registers that are expired or will be expiring soon:</p>
<table class="table">
    <thead>
        <tr>
            <th><?= __('Type') ?></th>
            <th><?= __('Certs') ?></th>
            <th><?= __('Class') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($user->registers as $registers): ?>
        <tr>
            <td><?php
            $link = $registers->has('register_template') ? h($registers->register_template->name) :'Register';
            echo $this->Html->link($link,['controller'=>'Registers','action'=>'view',$registers->id,'_full' => true]);
             ?></td>
            <td><?= $this->Dak->getStatus($registers->cert_status) ?>&nbsp;</td>
            <td><?= $registers->has('register_class')? h($registers->register_class->title):'' ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif;?>
<?php if (!empty($user->certifications)): ?>
<p>Here is a list of your certifications that are expired or will be expiring soon:</p>
<table class='table'>
    <thead>
        <tr>
            <th>Certification Type</th>
            <th>Issuer</th>
            <th>Issued</th>
            <th>Expires</th>
            <th>Status</th>
        </tr>    
    </thead>
    <tbody>
        <?php foreach ($user->certifications as $certifications): ?>
        <tr>
            <td><?php
            $link = $certifications->has('certification_type') ? $certifications->certification_type->name : 'Certification';
            echo $this->Html->link($link,['controller'=>'Certifications','action'=>'view',$certifications->id,'_full' => true]);
             ?></td>
            <td><?= h($certifications->issuer) ?></td>
            <td><?= h($certifications->issued) ?></td>
            <td><?= h($certifications->expires) ?></td>
            <td><?= $this->Dak->getStatus($certifications->status) ?>&nbsp;
            <?= $this->Html->link('Replace', [
                'controller' => 'Certifications', 
                'action' => 'add',
                'replacing'=> $certifications->id,
                '_full' => true], ['escape' => false,'title' => __('Replace')])?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif;?>
<p></p>
<p>If you do not wish to be notified of these anymore, please login and replace them with current certifications or delete them.</p>