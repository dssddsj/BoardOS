<?PHP

class view extends showIndex {
function __construct() {
global $categories, $forums;


for ($i=0; $i<=count($categories)-1; $i++){
echo '<div class="row"> 
  <div class="col-lg-12">
  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">'.$categories[$i]['name'].'</h3>
  </div>
  <div class="panel-body forums">
    <ul class="forums">';
 for ($f=0; $f<=count($forums[$i])-1; $f++){
echo '<li>
<a href="index.php?showForum='.$forums[$i][$f]['id'].'" data-toggle="tooltip" data-placement="left" title="תגובות : '.$forums[$i][$f]['posts_count'].' | אשכולות : '.$forums[$i][$f]['threads_count'].'">
<div class="forum-icon">
<i class="icon-'.$forums[$i][$f]['icon'].'"></i>
</div>
<div class="forum-info">'.$forums[$i][$f]['name'].' <span class="desc">'.$forums[$i][$f]['desc'].'</span></div>
</a>
</li>';
}

echo ' </ul></div>
   <div class="panel-footer forums"></div>
</div>
</div>
</div>

 ';
 
}
}
}

?>



