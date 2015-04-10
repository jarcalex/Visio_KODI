<?php

$full_link = "";

foreach($nav_bar as $onglet)
{
?>
<li <?php echo $onglet['class']; ?> style="cursor:pointer">
    <?php if ($onglet['haveinderlink'] != "FALSE") { ?>
		<a class='dropdown-toggle' data-toggle='dropdown' >
        <i class='<?php echo $onglet['style']; ?>' ></i>
		<?php echo $onglet['label']; ?>
        <span class='caret'></span>
        <span class='sr-only'>Toggle Dropdown</span> </a>
		<ul class='dropdown-menu'>
		<?php foreach($onglet['Child'] as $underlink) {
			if ($underlink['label'] == "") {
			    echo "<li class='divider'></li>\n";
		    } else {
				echo "<li> <a href='".$HOME."index.php/".$underlink['label']."'>";
			    if ($underlink['style'] != "") {
                    echo "<i class='".$underlink['style']."'></i>  ";
			    }
			    echo $underlink['label']."</a></li>\n ";
		    }
	    } ?>
	    </ul>
<?php
    } else {
?>
		<a href='<?php echo $onglet['label']; ?>'>
		<i class='".$onglet['style']."'></i>
		<?php echo $onglet['label']; ?></a>
<?php
}
?>
</li>
<?php
}
?>