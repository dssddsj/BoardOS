<?PHP

class view extends showIndex {
function __construct() {
global $categories, $forums;


for ($i=0; $i<=count($categories)-1; $i++){
echo '
<table class="categories" border="0" cellpadding="3">
<tr>
<td>'.$categories[$i]['name'].'</td>
</tr>
</table>
 ';
 
 echo '<table class="index-threads" border="0" cellpadding="3">
	<tbody>

 ';
 for ($f=0; $f<=count($forums[$i])-1; $f++){
	 echo '<tr>';
	 echo '<td class="icon"><i class="icon-'.$forums[$i][$f]['icon'].'"></i></td>';
	 echo '<td>
	 <a href="index.php?showForum='.$forums[$i][$f]['id'].'" data-toggle="tooltip" data-placement="left" title="תגובות : '.$forums[$i][$f]['posts_count'].' | אשכולות : '.$forums[$i][$f]['threads_count'].'">'.$forums[$i][$f]['name'].'</a>

 <span>'.$forums[$i][$f]['desc'].'</span>
</td>';

echo '</tr>';
}

echo ' </tbody>
</table>';
 
}
}
}

?>



