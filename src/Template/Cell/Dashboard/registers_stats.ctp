<div class='box box-solid box-primary'>
    <div class='box-header'><h3 class='box-title'><?= ($dashboardItem->title) ? h($dashboardItem->title):  __('Registers Stats')  ?></h3>
    	<div class="box-tools pull-right">
    	
      </div>
    </div>
    <div class='box-body dashboardModule'>
        <table class='table'>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Type</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
        <?php 
        foreach ($data as $row): ?>
        <tr>
            <th><?= h($row['year'])?></th>
            <td><?= h($row['type'])?></td>
            <td><?= h($row['count'])?></td>
        </tr>
        <?php 
        endforeach; ?>
            </tbody>
        </table>
</div>
</div>