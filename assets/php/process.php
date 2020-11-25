<?php 
require_once 'session.php';
// Handle Add New Note Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'add_note') {
    $title = $cuser->test_input($_POST['title']);
    $note = $cuser->test_input($_POST['note']);
    $cuser->add_new_note($cid,$title,$note);
}
// 列出所有使用者的Note
if (isset($_POST['action']) && $_POST['action'] == 'display_notes') {
    $output = '';
    $notes = $cuser->get_notes($cid);
    // 若有資料的話
    if ($notes) {
        // table-sm datatable間距變小
        $output .='<table class="table table-striped table-sm text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Note</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
        // 列出資料
        foreach ($notes as $row) {
            $output .= '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['title'].'</td>
            <td>'.substr($row['note'],0,75).'...</td>
            <td>
            
              <a href="#" title="View Details" class="text-success infoBtn">
                <i class="fas fa-info-circle fa-lg"></i>
              </a>&nbsp;
              <a href="#" title="Edit Note" class="text-primary editBtn">
                <i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editNoteModal"></i>
              </a>&nbsp;
              <a href="#" title="Delete Note" class="text-danger deleteBtn">
                <i class="fas fa-trash-alt fa-lg"></i>
              </a>&nbsp;
            </td>
          </tr>';
        }
        $output .= '</tbody></table>';

        echo $output;
    }
    else{
        // 若沒有資料的話，顯示沒有資料
        echo '<h3 class="text-center text-secondary">:( 沒有資料</h3>';
    }

}

?>