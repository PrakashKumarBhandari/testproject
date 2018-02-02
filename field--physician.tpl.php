<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>> 
<?php 
$output='';
if($element['#field_name']=='field_hcmg'){
	$raw=$items['0']['#markup'];
	$raw=='Y' || $raw=='y' || $raw=='YES' || $raw=='yes' || $raw=='Yes' ? $output = 'Yes' : $output = 'No';
}

if (!$label_hidden && $output != 'No') : ?> 
<div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</div> 
<?php endif; ?> 
<div class="field-items"<?php print $content_attributes; ?>> 


<?php 
//format phone 1
if($element['#field_name']=='field_tel_1'){
	$raw=$items['0']['#markup'];
	$output='('.substr($raw,0,3).') '.substr($raw,3,3).'-'.substr($raw,6,4);
	$items['0']['#markup']=$output;
} ?>

<?php 
//format phone 2
if($element['#field_name']=='field_tel_2'){
	$raw=$items['0']['#markup'];
	$output='('.substr($raw,0,3).') '.substr($raw,3,3).'-'.substr($raw,6,4);
	$items['0']['#markup']=$output;
} ?>

<?php 
//format phone fax
if($element['#field_name']=='field_fax'){
	$raw=$items['0']['#markup'];
	$output='('.substr($raw,0,3).') '.substr($raw,3,3).'-'.substr($raw,6,4);
	$items['0']['#markup']=$output;
} ?>

<?php 
//format HCMG
if($element['#field_name']=='field_hcmg'){
	$raw=$items['0']['#markup'];
	$raw=='Y' || $raw=='y' || $raw=='YES' || $raw=='yes' || $raw=='Yes' ? $output = 'Yes' : $output = 'No';
	$items['0']['#markup']=$output;
	if($output == 'No') {
		$items['0']['#prefix']='<div style="display:none;">';
		$items['0']['#suffix']='</div>';
	}
} ?>

<?php if ($element['#view_mode']=="teaser") { ?> 
<div class="field-item even"<?php print $item_attributes[0]; ?>><?php print render($items[0]); ?></div> 
<?php } else { ?> 
<?php foreach ($items as $delta => $item) : ?> 
<div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>><?php print render($item); ?></div> 
<?php endforeach; ?> 
<?php } ?>
<div class="clearfix"></div> 
</div> 
</div>