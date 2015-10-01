<?php

include(get_template_directory() . '/em/classes/class.pageelements.php');
$page_elements = new PageElements();
?>

<ul class="nav nav-tabs nav-tabs-example">
	<li><a href="#introduction" data-toggle="tab">Introduction</a></li>
	<li class="active"><a href="#layouts" data-toggle="tab">Layouts</a></li>
	<li><a href="#components" data-toggle="tab">Components</a></li>
	<li><a href="#animations" data-toggle="tab">Animations</a></li>
	<li><a href="#markups" data-toggle="tab">Markups</a></li>
</ul>

<div class="tab-content" id="tabs">



	<!-- Introduction -->
	<div class="tab-pane" id="introduction">
		<section class="example-template">
			<div class="container">
				<h2>Welcome to the base theme!</h2>
				<p>I assigned this to Julius on bitbucket but for some weird reason he didn't do it. Hmmh.</p>
			</div>
		</section>
	</div>



	<!-- Layouts -->
	<div class="tab-pane active" id="layouts">
		<section class="example-template">
			<?php
			$layouts = $page_elements->get_layouts();
			foreach ($layouts as $layout) {
				?>
				<div class="container container--layout-info">
					<h2>
						<?php echo $layout['name'] ?>
					</h2>
					<div class="row">
						<div class="col-xs-8">
							<?php echo $layout['description'] ?>
						</div>
						<div class="col-xs-4">
							<i title="<?php echo $layout['jspath'] ?>" class="fa fa-file-text-o <?php echo $component['jsexists'] ? 'file-exists' : 'file-not-found' ?>"></i>
							<i title="<?php echo $layout['csspath'] ?>" class="fa fa-css3 <?php echo $component['cssexists'] ? 'file-exists' : 'file-not-found' ?>"></i>
							<?php if (count($layout['tags']) > 0) : ?>
								<ul class="example-tags">
									<?php foreach ($layout['tags'] as $tag) : ?>
										<li><?php echo $tag ?></li>
									<?php endforeach ?>
								</ul>
							<?php endif ?>
						</div>
					</div>
				</div>

				<?php

				include(locate_template('templates/layouts/' . $layout['filename']));

			}
			?>
		</section>
	</div>



	<!-- Components -->
	<div class="tab-pane" id="components">
		<section class="example-template">
			<div class="container">
				<h2><i class="fa fa-coffee"></i>  Components</h2>
			</div>
			<div class="text-center">
				<?php
				$components = $page_elements->get_components();
				foreach ($components as $component) {
					?>
					<div class="example-template__element-container text-left">
						<div class="example-template__element-container__info">
							<b><?php echo $component['name'] ?></b>
							<p><?php echo $component['description'] ?></p>
							<?php if (count($component['tags']) > 0) : ?>
								<ul class="example-tags example-tags--align-bottom">
									<?php foreach ($component['tags'] as $tag) : ?>
										<li><?php echo $tag ?></li>
									<?php endforeach ?>
								</ul>
							<?php endif ?>

							<div class="example-template__element-container__info__footer">
								<a href="?element-viewer=<?php echo $component['filename'] ?>" target="_blank" class="btn">Open</a>
								<div class="example-template__element-container__info__footer__icons">
									<i title="<?php echo $component['jspath'] ?>" class="fa fa-file-text-o <?php echo $component['jsexists'] ? 'file-exists' : 'file-not-found' ?>"></i>
									<i title="<?php echo $component['csspath'] ?>" class="fa fa-css3 <?php echo $component['cssexists'] ? 'file-exists' : 'file-not-found' ?>"></i>
								</div>
							</div>
						</div>
						<div class="example-template__element-container__cup cup">
							<?php include(locate_template('templates/components/' . $component['filename'])); ?>
						</div>
					</div>
					<?php
					/*
					echo '<div class="example-template__wrapper cup">';
					echo '<a class="cup-menu" href="?element-viewer='.$component['filename'].'" target="_blank">Open in viewer</a>';
					include(locate_template('templates/components/' . $component['filename']));
					echo '</div>';
					*/
				}
				?>
			</div>
		</section>
	</div>



	<!-- Animations -->
	<div class="tab-pane" id="animations">
		<section class="example-template">
			<div class="container">
				<h2>Animations</h2>
				<p>data-vp-add-class="animated fadeIn" makes the element fadeIn when the </p>
				<table class="example-template__table">
					<tr>
						<th>Animations</th>
						<td>
							<div class="example-template__smalle" data-vp-add-class="animated fadeIn">.fadeIn</div>
							<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">.fadeInUp</div>
							<div class="example-template__smalle" data-vp-add-class="animated fadeInDown">.fadeInDown</div>
							<div class="example-template__smalle" data-vp-add-class="animated fadeInLeft">.fadeInLeft</div>
							<div class="example-template__smalle" data-vp-add-class="animated fadeInRight">.fadeInRight</div>
							<div class="example-template__smalle" data-vp-add-class="animated flipInX">.flipInX</div>
							<div class="example-template__smalle" data-vp-add-class="animated flipInY">.flipInY</div>
						</td>
					</tr>
					<tr>
						<th>Animation Times</th>
						<td>
							<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">.animated</div>
							<div class="example-template__smalle" data-vp-add-class="animatedslow fadeInUp">.animatedslow</div>
							<div class="example-template__smalle" data-vp-add-class="animatedsuperslow fadeInUp">.animatedsuperslow</div>

						</td>
					</tr>
					<tr>
						<th>Animation Delay</th>
						<td>
							<div class="example-template__smalle" data-vp-add-class="animated animateddelay1 fadeInUp">.animateddelay1</div>
							<div class="example-template__smalle" data-vp-add-class="animated animateddelay2 fadeInUp">.animateddelay2</div>
							<div class="example-template__smalle" data-vp-add-class="animated animateddelay3 fadeInUp">.animateddelay3</div>
							<div class="example-template__smalle" data-vp-add-class="animated animateddelay4 fadeInUp">.animateddelay4</div>
							<div class="example-template__smalle" data-vp-add-class="animated animateddelay5 fadeInUp">.animateddelay5</div>
							<div class="example-template__smalle" data-vp-add-class="animated animateddelay6 fadeInUp">.animateddelay6</div>
							<div class="example-template__smalle" data-vp-add-class="animated animateddelay7 fadeInUp">.animateddelay7</div>
							<div class="example-template__smalle" data-vp-add-class="animated animateddelay8 fadeInUp">.animateddelay8</div>
							<div class="example-template__smalle" data-vp-add-class="animated animateddelay9 fadeInUp">.animateddelay9</div>
							<div class="example-template__smalle" data-vp-add-class="animated animateddelay10 fadeInUp">.animateddelay10</div>

						</td>
					</tr>
					<tr>
						<th>.delay-sequence</th>
						<td>
							<div class="delay-sequence">
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
							</div>
						</td>
					</tr>
					<tr>
						<th>.delay-sequence2</th>
						<td>
							<div class="delay-sequence2">
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
								<div class="example-template__smalle" data-vp-add-class="animated fadeInUp">parent delay</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</section>
	</div>



	<!-- Markups -->
	<div class="tab-pane" id="markups">
		<section class="example-template">
			<div class="container">
				<h2>Typography</h2>
				<table class="example-template__table">
					<tr>
						<th>.headline--xxxl</th>
						<td><h1 class="headline headline--xxxl">This is a Headline</h1></td>
					</tr>
					<tr>
						<th>.headline--xxl</th>
						<td><h2 class="headline headline--xxl">This is a Headline</h2></td>
					</tr>
					<tr>
						<th>.headline--xl</th>
						<td><h3 class="headline headline--xl">This is a Headline</h3></td>
					</tr>
					<tr>
						<th>.headline--lg</th>
						<td><h4 class="headline headline--lg">This is a Headline</h4></td>
					</tr>
					<tr>
						<th>.headline--md</th>
						<td><h5 class="headline headline--md">This is a Headline</h5></td>
					</tr>
					<tr>
						<th>.headline--sm</th>
						<td><h6 class="headline headline--sm">This is a Headline</h6></td>
					</tr>
					<tr>
						<th>p.large</th>
						<td><p class="large">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi odio totam ullam ab voluptates omnis sapiente! Quaerat aliquid aut, ex, incidunt libero culpa ipsam dolores minus commodi iste consequatur maiores!</p></td>
					</tr>
					<tr>
						<th>p</th>
						<td><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi odio totam ullam ab voluptates omnis sapiente! Quaerat aliquid aut, ex, incidunt libero culpa ipsam dolores minus commodi iste consequatur maiores!</p></td>
					</tr>
					<tr>
						<th>p.small</th>
						<td><p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi odio totam ullam ab voluptates omnis sapiente! Quaerat aliquid aut, ex, incidunt libero culpa ipsam dolores minus commodi iste consequatur maiores!</p></td>
					</tr>
					<tr>
						<th>p.accent</th>
						<td><p class="accent">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi odio totam ullam ab voluptates omnis sapiente! Quaerat aliquid aut, ex, incidunt libero culpa ipsam dolores minus commodi iste consequatur maiores!</p></td>
					</tr>
				</table>
			</div>
		</section>
		<section class="example-template">
			<div class="container">
				<h2>Buttons</h2>
				<table class="example-template__table">
					<tr>
						<th>Default Styles</th>
						<td>
							<a class="btn">.btn</a>
							<a class="btn--white">.btn--white</a>
						</td>
					</tr>
					<tr>
						<th>Transition Effects inside Cup</th>
						<td>
							<div class="example-template__wrapper-vertical cup">
								<div class="listing-item-vertical coffee">
									<div class="content">
										<a class="btn btn-overflow">.btn-overflow</a>
									</div>
								</div>
							</div>

						</td>
					</tr>
				</table>
			</div>
		</section>

		<section class="example-template">
			<div class="container">
				<h2>Wysiwyg HTML</h2>
				<table class="example-template__table">
					<tr>
						<td>
							<div class="wysiwyg-html">
								<h1>This is the primary heading and there should only be one of these per page</h1>
								  <p>A small paragraph to <em>emphasis</em> and show <strong>important</strong> bits.</p>
								  <ul>
								      <li>This is a list item</li>
								      <li>So is this - there could be more</li>
								      <li>Make sure to style list items to:
								          <ul>
								              <li>Not forgetting child list items</li>
								              <li>Not forgetting child list items</li>
								              <li>Not forgetting child list items</li>
								              <li>Not forgetting child list items</li>
								          </ul>
								      </li>
								      <li>A couple more</li>
								      <li>top level list items</li>
								  </ul>
								  <p>Don't forget <strong>Ordered lists</strong>:</p>
								  <ol>
								     <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
								     <li>Aliquam tincidunt mauris eu risus.
								      <ol>
								          <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
								          <li>Aliquam tincidunt mauris eu risus.</li>
								      </ol>
								      </li>
								     <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
								     <li>Aliquam tincidunt mauris eu risus.</li>
								  </ol>
								  <h2>A sub heading which is not as important as the first, but is quite imporant overall</h2>
								  <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
								  <table>
								      <tr>
								          <th>Table Heading</th>
								          <th>Table Heading</th>
								      </tr>
								      <tr>
								          <td>table data</td>
								          <td>table data</td>
								      </tr>
								      <tr>
								          <td>table data</td>
								          <td>table data</td>
								      </tr>
								      <tr>
								          <td>table data</td>
								          <td>table data</td>
								      </tr>
								      <tr>
								          <td>table data</td>
								          <td>table data</td>
								      </tr>
								  </table>

								  <h3>A sub heading which is not as important as the second, but should be used with consideration</h3>
								  <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
								  <blockquote><p>“Ooh - a blockquote! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.”</p></blockquote>
								  <h4>A sub heading which is not as important as the second, but should be used with consideration</h4>
								  <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
								  <pre><code>
								#header h1 a {
								    display: block;
								    width: 300px;
								    height: 80px;
								}
								</code></pre>
								  <h5>A sub heading which is not as important as the second, but should be used with consideration</h5>
								  <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
								  <dl>
								 <dt>Definition list</dt>
								 <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
								aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
								commodo consequat.</dd>
								   <dt>Lorem ipsum dolor sit amet</dt>
								   <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
								aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
								commodo consequat.</dd>
								</dl>
								<h6>This heading plays a relatively small bit part role, if you use it at all</h6>
								  <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

							</div>
						</td>
					</tr>
				</table>
			</container>
		</section>
	</div>
</div>
