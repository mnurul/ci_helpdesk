<?php
$db = \Config\Database::connect();
$builder = $db->table('projects');

echo "test5";

// $builder->select('*');
// $builder->where('idproject', $_POST[idproject]);
// $query = $builder->get();
$query = $this->db->query('SELECT uatend FROM projects WHERE idproject = $_POST[idproject]  AND idcustomer = $csnama');

foreach ($query->getResult() as $row) {
    $output .= ' <input value="' . $row->uatend . '" />';
}
return $output;

// $query = $this->db->query('SELECT uatend FROM projects WHERE idproject = ' . $idproject . 'AND idcustomer = ' . $csnama);

//             foreach ($query->getResult() as $row) {
//                 $getUatEnd = $row->uatend;
//             }
