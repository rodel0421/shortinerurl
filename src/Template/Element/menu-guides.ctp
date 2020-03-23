<li>
    <?= $this->Html->link('<i class="fa fa-question-circle fa-2x"></i>', 
    ['controller'=>'Guides','action' => 'open','c'=>$this->request->controller],
    ['title'=>'Documentation','escape'=>false,'class'=>'btnPreview','style'=>'padding-top: 9px;padding-bottom: 10px;']) ?>
</li>
