<section class="example<?php echo $block->getCss('section');?>">
	<div class="example__container">

		<header class="section-header section-header--example">
	        <?php echo Helper::sprint('<h1 class="section-header__title">%s</h1>', str_replace(get_template_directory(), '',  __DIR__)); ?>
	    </header>

		<div class="row">
			<div class="col-xs-12">
				<h2>Wooo! This block works :)</h2>
				<p>Your seeing this message as the view has been loaded succesfully from <b><?php echo str_replace(get_template_directory(), '',  __DIR__); ?></b>.</p>
				<p>For development:</p>
				<ol>
					<li>Duplicate this block folder and rename accordingly to naming convention typically of how you named the ACF block.</li>
					<li>Duplicate <b>/assets/css/scss/components/_example.scss</b> and rename the file and the parent selector to the name of the block.</li>
					<li>If JS is needed also duplicate <b>/assets/js/components/example.js</b> and rename the file and the object key <b>base</b> to the name of the block.</li>
				</ol>
				<p>This will provide a boilerplate to get you started. And keeping the same name from block, to section name, css file, js file will help development and others navigate the project.</p>	
			</div>
		</div><!-- end of row -->

	</div><!-- end of example container -->
</section><!-- end of example section--> 