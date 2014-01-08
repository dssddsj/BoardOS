<?PHP

class view extends showProfile {
function __construct() {
global $profile;
echo '</div>';
echo '<div class="profile">
<div class="user-cover">
<div class="container">
<img style="float:right;" src="themes/default/img/profile.jpg" height="120" width="120">
<ul class="user-info">

<li class="username">'.$profile['name'].'</li>
<li class="rank">'.$profile['rank'].'</li>
</ul>
<div class="user-buttons"> <a class="btn btn-default">פרטים אישיים</a> <a class="btn btn-default"><i class="icon-plus"></i> הוסף לחברים</a></div>
</div>
</div>';
echo '<div class="user-stats">
<div class="container">
<ul class="stats">
<li class="first"><a data-toggle="tooltip" data-placement="top" title="מצא הודעות שפורסמו על ידי המשתמש (בקרוב)"><span>'.$profile['posts'].'</span>הודעות</a></li>
<li><a data-toggle="tooltip" data-placement="top" title="מצא אשכולות שנפתחו על ידי המשתמש" href="?search=threads&user='.$profile['id'].'"><span>'.$profile['threads'].'</span>אשכולות</a></li>
<li><span>0</span>חברים</li>
<li><span>הצטרף לפני</span>'.$profile['join_date'].'</li>
<li><span>'.$profile['firstname'].'</span> שם פרטי</li>
</ul>
</div>
</div>
</div>';

}
}

?>



