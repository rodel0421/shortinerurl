<style>
img {
    vertical-align: middle;
    /* height: 300px; */
}
.box-title {
    padding-top: 7px;
    padding-bottom: 15px;
}

.main-evidence{
    text-align: left;
}

.evidence{
    display: inline-block;
    background: #605ca8;
    margin-right: 5px;
    margin-bottom: 15px;
    box-shadow: 0px 3px 10px #abababaa;
}
.evidence img {
    border: 3px solid #605ca8;
    height: 300px;

}

.evidence h4{
    color: white;
    padding-left: 8px;
    font-size: 12px;
    font-weight: 400;
    text-align: left;
}

.m-evidence{
    display: inline-block;
    text-align: center;
}


</style>
<!-- <#?php dump($students); ?> -->

<!-- <#?php echo $evidenceSelect[0]->photo_url; ?> -->
<div class="view large-9 medium-8 columns content">
    <h4>
        <small>
            Name: 
        </small>
       <a href="user somthing"> <?php echo $evidence->toArray()[0]->user->name ?></a>
    </h4>
<div class='box box-primary'>
    <div class='box-header'>
    <div class="header-title">
        <h1 class='box-title'>Practical Evidence </h1>
    </div>

    <?php foreach ($tests->questions as $key => $rawr):?>
        <div class="title-test ">
            <h4><?php echo $rawr['title'] ?></h4>
        </div>
    <?php endforeach ?>

        <!-- <#?php dump($tests);
        exit;
        ?> -->
     <!-- <#?php dump($tests->questions[0]->course_question_choices) ?> -->

    <?php foreach ($tests->questions[0]->course_question_choices as $key => $choices)
            foreach ($evidenceSelect as $key => $value){
                
            if($choices->id == $value->answer_id){
        echo  "<div class='m-evidence'>" ;
         echo "  <div class='main-evidence'>";
          echo " <div class='evidence'> ";
            echo  "<img src='$value->photo_url'>";
            echo "<h4>$choices->id</h4>";
            echo "<h4>$value->answer_id                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     </h4>";
            
        echo "</div>";
        echo "</div>";
        echo "</div>";
    
            }
        }
    ?> 

<?= $this->Form->create($evidenceSelect, ['type' => 'file']); ?>
        <div class='row'>
            <div class='col-md-6'><?= $this->Form->input('file_url', [
                'type' => 'file',
                'help'=>'.pdf, .gif, .jpg, .png, .jpeg (max file size 5Mb)',
                'label' => 'Upload Scanned Document'
                ])?></div>
        </div>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?> 

</div>
</div>
