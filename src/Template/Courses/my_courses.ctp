<section class="banner">	
</section>

<section class="mb-3">
    <div class="container">
        <h3 class="header-title">
            Courses
        </h3>
        <p class="text-muted">Taro Training is committed to providing quality training and assessment in accordance with the Standards for Nationally Recognised Qualifications in both the Civil and Mining industry.</p>
        <div class="w-100 my-4">
            <?php if($courses): ?>
                <?php foreach($courses as $course):?>
                    <h5>
                        <?= $this->Html->link($course->course->name,['plugin' => null,'controller'=>'Courses','action'=>'viewCourse', $course->course->id],['escape'=>false])?>
                    </h5>
                <?php endforeach;?>
            <?php else:?>
                <h5 class="text-danger">You are not enrolled to any courses yet.</h5>
            <?php endif;?>
        </div>
    </div>
</section>