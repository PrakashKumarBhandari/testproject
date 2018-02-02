<div class="lists red">
	<ul>
		<?php if(count($rows)%2 == 0) $num = intval(count($rows)/2); else $num = intval(count($rows)/2) + 1; ?>
		<?php $j = 0; foreach($rows as $id => $row): $j++; ?>
			<?php print $row; ?>
		<?php if($j == $num){ ?>
	</ul>
	<ul>
		<?php } ?>
		<?php endforeach; ?>
	</ul>
</div>