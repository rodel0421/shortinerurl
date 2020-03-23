<?php $this->assign('title', 'Search By Machine Results');?>
<?= $this->Html->css('tarosearch.css')?>

<!-- content -->

<section class="banner">
    <div class="machine-search p-4 bg-white">
        <?=
            $this->Form->create(null, [
                'url' => [
                    'controller' => 'Student',
                    'action' => 'search'
                ]
            ]);
        ?>
        <?= $this->Form->hidden('searchMethod', ['value' => 'person']);?>
        <div class="input-group">
                <?= $this->Form->text('searchValue',
                [ 
                    'placeholder' => "Search By Person",
                    'class' => ["form-control"] 
                ]) ?>
            <div class="input-group-append">
                <?= $this->Form->button('Search', [
                    'class' => ['btn','btn-warning'],
                    'type' => 'submit'
                ]) ?>
            </div>
        </div>
        <?= $this->Form->end(); ?>
    </div>		
</section>

<section class="result-section">
    <div class="container">
        <h3 class="header-title">
            SEARCH RESULTS
        </h3>
        <div class="results-container">
            <?php if($results): ?>
                <?php foreach($results as $index=>$result):?>
                    <div class="search-result">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-1 py-3 pl-3">
                                    <?= $this->Html->image($result['profile_picture'],
                                        [
                                            "class" => ["card-img", "w-100"]
                                        ]
                                    ) ?>
                                </div>
                                <div class="col-md-11">
                                <div class="card-body" id=<?= $result['id'].'-parent'?>>
                                    <h5 class="card-title font-weight-bold text-warning"><?= $result['name'] ?></h5>
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target=<?= '#'.$result['id'].'-div'?> aria-expanded="true" aria-controls="collapseOne"> View qualifications > </button>
                                    <div class="passers-div collapse" id=<?= $result['id'].'-div'?> data-parent=<?= '#'.$result['id'].'-parent'?>>
                                        <?php if($result['qualifications']): ?>
                                            <table class="table">
                                                <tbody>
                                                    <?php foreach($result['qualifications'] as $qualifications):?>
                                                        <tr>
                                                            <td width="5%">
                                                                <?= $this->Html->image($qualifications['img'],
                                                                    [
                                                                        "class" => ["td-icon"]
                                                                    ]
                                                                ) ?>
                                                            </td>
                                                            <td>
                                                                <?= $qualifications['machine_name']?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        <?php else:?>
                                            <h5 class="text-danger">
                                                No Qualifications yet!.
                                            </h5>
                                        <?php endif;?>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else :?>
                <h2 class="text-danger">
                    No matches for search!
                </h2>
            <?php endif;?>
        </div>
        
    </div>
</section>