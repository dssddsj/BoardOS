<?PHP

// * With this class, you can create new PDO statements ALOT easier with MUCH less code
// * This file is a part of the A_M CORE
// * Author - Amir Mendelson
// * File Version : 1.2

class db
{
	var $Count;
	var $Row;
	var $ID;
	
	function __construct($db_info) {
    $info = "mysql:dbname=".$db_info[3].";host=".$db_info[0].";charset=utf8"; // DB Name | DB HOST
    $user = $db_info[1]; // DB User
    $pw = $db_info[2]; // DB Password
    $this->db = new PDO($info, $user, $pw);
	$stmt = $this->db->prepare("SET character_set_results=utf8");
	$stmt = $this->db->prepare("SET character_set_database=utf8");
	$stmt = $this->db->prepare("SET character_set_server=utf8");
	$stmt = $this->db->prepare("SET character_set_connection=utf8");
	$stmt = $this->db->prepare("SET NAMES 'utf8'");
    $stmt -> execute(); // Execute quer
   }
		 
    public function Add($tbl_name, $columns, $values) { 
	$columns_count = count($columns); // Count columns
	$columns_sort = implode(", ", $columns); // Sort columns
	$columns_pre = $columns;
	foreach ($columns_pre as &$value) { // Adds the : Prefix
	$value = ':'.$value;}
	$columns_pre_2 = implode(", ", $columns_pre);  
	
	$stmt = $this->db->prepare("INSERT INTO $tbl_name ($columns_sort) VALUES ($columns_pre_2)"); // Insert(Add) Query
    for ($pos=0; $pos<=$columns_count-1; $pos++) {
	${$columns[$pos]} = $values[$pos]; // Var_X(Current Column Name) = Current Value
	$stmt -> bindParam($columns_pre[$pos], ${$columns[$pos]}, PDO::PARAM_STR); }
	if (!$stmt -> execute()) { print_r($stmt->errorInfo()); } // Execute query
	$this->ID = $this->db->lastInsertId();
	 }
	 
	public function ShowTable($tbl_name, $column, $value, $rows,$row_name) { 
	$stmt = $this->db->prepare("select * from $tbl_name where $column=:".$column."");
	$stmt -> bindParam(':'.$column.'', $value);
	if (!$stmt -> execute()) { echo "Query Failed."; } // Execute query
	
	//$colcount = $stmt->columnCount(); // Count Columns
    //$count = $stmt->rowCount(); // Count Rows
	
	$table = new table();
	$table->Rows($rows);
	
	if (is_array($row_name)) {
    foreach ($stmt as $row) {
    //print $text." ".$row[$row_name]. "<br />";
	//$item = array('checkBox' ,$row['id'], $row['name'], '14', '24/02/2013');
	$item = array('<input type="checkbox" name="row_sel" class="row_sel" />');
	$item2 = array('checkbox');
	
	$name = array_merge((array)$item2, (array)$row_name);
	
	$count = count($row_name) -1;
	for ($i=0; $i<=$count; $i++){
		
	array_push($item, $row[$row_name[$i]]);
		}
	
	$buttons = "<div class='btn-group'>
    <a href='edit.php?id=".$row['id']."' class='btn btn-mini' title='Edit'><i class='icon-pencil'></i></a>
    <a href='#' class='btn btn-mini' title='View'><i class='icon-eye-open'></i></a>
    <a href='#' class='btn btn-mini' id='delete_rows_dt' title='Delete'><i class='icon-trash'></i></a>
    </div>";
	array_push($item, $buttons);
	array_push($name, 'buttons');
	$table->Item($item, '', $name);
	//$item = array($row['id'] ,$row['name'] , $row['tiers'], $row['creation_date']);
         }
		 
	}
		//$table->End(); 
	 }
	 
	 public function Get($type ,$tbl_name, $column, $value, $row_name) { 
	 
	 if (($type == 2) || ($type == "all")) {
	$stmt = $this->db->prepare("select * from $tbl_name");
	 }
	 else if (($type == 3) || ($type == "order")) {
	$stmt = $this->db->prepare("select * from $tbl_name where $column=:".$column." ORDER BY $value DESC");
	 }

	 else {
    $stmt = $this->db->prepare("select * from $tbl_name where $column=:".$column."");
	 }
	$stmt -> bindParam(':'.$column.'', $value);
	if (!$stmt -> execute()) { return FALSE; } // Execute query
	
	//$colcount = $stmt->columnCount(); // Count Columns
    $this->Count = $stmt->rowCount(); // Count Rows
	if (($type == 0) || ($type == "one")) {
    foreach ($stmt as $row) {
    return $row[$row_name];
         }
	 }
	 
      else if (($type == 1) || ($type == "few")) {
		  $rows = array();
	foreach ($stmt as $row) {
   // echo $row[$row_name];
	array_push($rows, $row[$row_name]);
         }
		 return $rows;
	 }
	 
	 else if (($type == 2) || ($type == "all")) {
     $rows = array();
	foreach ($stmt as $row) {
   // echo $row[$row_name];
	array_push($rows, $row[$row_name]);
         }
		 return $rows;
	 }
	 
	 else if (($type == 3) || ($type == "order")) {
		  $rows = array();
	foreach ($stmt as $row) {
   // echo $row[$row_name];
	array_push($rows, $row[$row_name]);
         }
		 return $rows;
	 }
	 
	 
	 
	 }

		public function Edit($tbl_name, $column, $value, $id) { 
	$sql = "UPDATE $tbl_name SET $column=? WHERE id=?";
    $stmt = $this->db->prepare($sql);
	if (!$stmt -> execute(array($value,$id))) { echo "DB FAILED : "; print_r($stmt->errorInfo()); } // Execute query
	 }
	 
	 public function Delete($tbl_name ,$value) { 
	$stmt = $this->db->prepare("DELETE FROM $tbl_name where id=:id");
	$stmt -> bindParam(':id', $value);
	$stmt -> execute(); // Execute query
	 }

		 
	public function Count() { 
	return $this->Count;
	}
	
	public function getID() { 
	return $this->ID;
	}
}

?>
