<?php $this->assign('title', 'Taro Training');?>

<!-- content -->

<section class="hero__background">
    	<!-- <div class="container pt-5">
    		<div class="row">
    			<div class="col-md-12 hero__background_content">
    				<h3>REAL MACHINES AND REAL TRAINING</h3>
    				<p>With over 15 years experience in the heavy equipment industry and one of the largest</p>
    				<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim, voluptas.</p>
    				<p>nationally recognised heavy equipment training companies, collaborating with one of the leading</p>
    				<p>recognised training organisations in QLD. We offer a growing range of courses, flexible course </p>
    				<p>options, onsite conduct training on our site or on yours, we have a solution for you.</p>
    				<p class="mt-3 mb-4"><i>Find out more about getting RII qualified.</i></p>
    				<button class="btn btn-outline-warning btn-lg text-light btn-main">COURSE</button>
    			</div>
			</div>
    	</div> -->
		<div class="search-div p-4 bg-white">
				<?= $this->Form->create(null, [ 'url' => ['controller' => 'Users', 'action' => 'studentSearch']]); ?>
					<div class="input-group mb-2">
						<?= $this->Form->text('search', [  'placeholder' => "Search By Machine", 'class' => ["form-control"] ]) ?>
						<div class="input-group-append">
							<?= $this->Form->button('Search', ['class' => ['btn','btn-warning', 'font-weight-bold'], 'type' => 'submit' ]) ?>
						</div>
					</div>
				<?= $this->Form->end(); ?>
				<?= $this->Form->create(null, [ 'url' => ['controller' => 'Users', 'action' => 'search'], 'type' => 'GET']); ?>
					<div class="input-group">
						<?= $this->Form->text('search', [ 'placeholder' => "Search By Person", 'class' => ["form-control"] ]) ?>
						<div class="input-group-append">
							<?= $this->Form->button('Search', ['class' => ['btn','btn-warning', 'font-weight-bold'], 'type' => 'submit' ]) ?>
						</div>
					</div>
				<?= $this->Form->end(); ?>	
			</div>
		</div>		
    </section>