<!--
Description: A table div layout. By mobile divs are block level, and from tablets upwards they transform to table cells
Tags: columns, layout, tables
Preview: true
-->

<div class="table-div table-div--links">

	<div class="table-div__row" data-count="3">

	<?php for($i=0; $i<3; $i++): ?>
		
		<div class="table-div__col table-div__col--span1">
			<div class="links-block__item">

				<div class="links-block__item__background" style=" background-image:url(http://fakeimg.pl/650x650/eeeeee/666/?text=img);"></div>

				<div class="links-block__item__overlay"></div>

				<div class="links-block__item__content">
					<h2>Component</h2>
					<div>
						<p>Within this block, we use the table div layout, and within this layout this would be a reusable component.</p>
					</div>
					<a href="1" class="btn">Read More</a>	
				</div>

			</div><!-- end of links block item -->
		</div><!-- end of table div col -->

	<?php endfor; ?> 

	</div><!-- end of table div row -->

</div><!-- end of table div links -->