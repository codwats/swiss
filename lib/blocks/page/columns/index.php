<?php
// lets keep block data in class for encapsulation and stopping conflicts across blocks
$block = new \Swiss\Block;

// set and get the repeater columns for this post
$block->getFields(['columns', 'columns_reverse_desktop', 'columns_vertical_alignment','columns_horizontal_alignment']);

$blockExtraClass = "l-columns--".$block->get('columns_reverse_desktop')." l-columns--".$block->get('columns_vertical_alignment')." l-columns--horizontal-".$block->get('columns_horizontal_alignment');

if(!empty($block->get('columns'))) include(__DIR__.'/view.php');
