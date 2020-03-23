<?php $this->assign('title', 'taro Training');?>

<section class="hero__background">
<div class="search-div p-4 bg-white">
			<?=
				$this->Form->create(null, [
					'url' => [
						'controller' => 'Search',
						'action' => 'search'
					]
				]);
			?>
			<div class="input-group">
				<div class="input-group-prepend w-25">
					<?= $this->Form->select('searchMethod',
						[ 
							'machine' => "Search By Machine",
							'person' => "Search By Person", ],
						[ 'class' => 'form-control' 
					]) ?>
				</div>
					<?= $this->Form->text('searchValue',
					[ 
						'placeholder' => "Search",
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
<div class="container">

<hgroup class="mb20">
    <h1>Search <?= $select ?> Results</h1>
    <h2 class="lead"><strong class="text-danger">3</strong> results were found for the search for <strong class="text-danger"><?= $searchvalue ?></strong></h2>								
</hgroup>

<?php if($select == 'machine'): ?>
<section class="col-xs-12 col-sm-6 col-md-12">
    <article class="search-result row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <a href="#" title="Lorem ipsum" class="thumbnail"><img class="list" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /></a>
        </div>
    
        <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
            <h3><a href="#" title="">Turn of the Screw</a></h3>
            <ul class="meta-search">
                <li><i class="glyphicon glyphicon-tags"></i> <span class="lead font-weight-bold">People</span></li>
            </ul>
            <ul class="list-meta-search">
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">William R. Kay</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Marcos K. Ybarra</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Bradley K. Harrison</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Stuart C. Hamilton</span></li>
                <span id="dots"></span><span id="more">
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">William R. Kay</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Marcos K. Ybarra</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Bradley K. Harrison</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Stuart C. Hamilton</span></li>
                
                </span>
                <li><i class="glyphicon glyphicon-tags"></i><button class="btn btn-warning btn-sm font-weight-bold" onclick="myFunction()" id="myBtn">Read more</button></li>

            </ul>
					
       
        </div>
			<span class="clearfix borda"></span>
        <span class="clearfix borda"></span>
       
    </article>
			
    <article class="search-result row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <a href="#" title="Lorem ipsum" class="thumbnail"><img class="list" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /></a>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
            <h3><a href="#" title="">Turn of the Screw</a></h3>
            <ul class="meta-search">
                <li><i class="glyphicon glyphicon-tags"></i> <span class="lead font-weight-bold">People</span></li>
            </ul>
            <ul class="list-meta-search">
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">William R. Kay</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Marcos K. Ybarra</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Bradley K. Harrison</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Stuart C. Hamilton</span></li>
            </ul>
        </div>
        <span class="clearfix borda"></span>
    </article>

    <article class="search-result row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <a href="#" title="Lorem ipsum" class="thumbnail"><img class="list" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /></a>
        </div>

         <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
            <h3><a href="#" title="">Turn of the Screw</a></h3>
            <ul class="meta-search">
              <li><i class="glyphicon glyphicon-tags"></i> <span class="lead font-weight-bold">People</span></li>
            </ul>
            <ul class="list-meta-search">
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">William R. Kay</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Marcos K. Ybarra</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Bradley K. Harrison</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Stuart C. Hamilton</span></li>
            </ul>
           </div>
        <span class="clearfix borda"></span>
    </article>			

</section>
</div>
<?php else:?>
<section class="col-xs-12 col-sm-6 col-md-12">
    <article class="search-result row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <a href="#" title="Lorem ipsum" class="thumbnail"><img class="list" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /></a>
        </div>
    
        <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
            <h3><a href="#" title="">Turn of the Screw</a></h3>
            <ul class="meta-search">
                <li><i class="glyphicon glyphicon-tags"></i> <span class="lead font-weight-bold">Machine </span></li>
            </ul>
            <ul class="list-meta-search">
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">William R. Kay</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Marcos K. Ybarra</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Bradley K. Harrison</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Stuart C. Hamilton</span></li>
                <span id="dots"></span><span id="more">
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">William R. Kay</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Marcos K. Ybarra</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Bradley K. Harrison</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Stuart C. Hamilton</span></li>
                
                </span>
                <li><i class="glyphicon glyphicon-tags"></i><button class="btn btn-warning btn-sm font-weight-bold" onclick="myFunction()" id="myBtn">Read more</button></li>

            </ul>
					
       
        </div>
			<span class="clearfix borda"></span>
        <span class="clearfix borda"></span>
       
    </article>
			
    <article class="search-result row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <a href="#" title="Lorem ipsum" class="thumbnail"><img class="list" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /></a>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
            <h3><a href="#" title="">Turn of the Screw</a></h3>
            <ul class="meta-search">
                <li><i class="glyphicon glyphicon-tags"></i> <span class="lead font-weight-bold">People</span></li>
            </ul>
            <ul class="list-meta-search">
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">William R. Kay</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Marcos K. Ybarra</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Bradley K. Harrison</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Stuart C. Hamilton</span></li>
            </ul>
        </div>
        <span class="clearfix borda"></span>
    </article>

    <article class="search-result row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <a href="#" title="Lorem ipsum" class="thumbnail"><img class="list" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /></a>
        </div>

         <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
            <h3><a href="#" title="">Turn of the Screw</a></h3>
            <ul class="meta-search">
              <li><i class="glyphicon glyphicon-tags"></i> <span class="lead font-weight-bold">People</span></li>
            </ul>
            <ul class="list-meta-search">
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">William R. Kay</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Marcos K. Ybarra</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Bradley K. Harrison</span></li>
                <li><i class="glyphicon glyphicon-tags"></i> <img class="profile rounded-circle" src="../img/hero-banner.jpeg" alt="Lorem ipsum" /> <span class="list-name">Stuart C. Hamilton</span></li>
            </ul>
           </div>
        <span class="clearfix borda"></span>
    </article>			

</section>
</div>
<?php endif;?>