
<div class="a005_header_block">
    <div class="a005_header_title">Список пользователей</div>
    <a href="" class="a005_add_button">
        <svg class="a005_add_icon" viewBox="0 0 24 24">
        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/>
        </svg>
        Добавить пользователя
    </a>
</div>

<div class="a005_table_wrapper">
  <table class="a005_table">
    <thead class="a005_thead">
      <tr class="a005_tr_header">
        <th class="a005_th a005_status">ID</th>
        <th class="a005_th">Логин</th>
        <th class="a005_th a005_email">Почта</th>
        <th class="a005_th a005_status">Статус</th>
        <th class="a005_th a005_status">Бан</th>
        <th class="a005_th" style="text-align: right;">Действия</th>
      </tr>
    </thead>
  </table>

  <div class="a005_tbody">
  <?php
foreach( $this->data_view as $user){
  if($user->get_active() == 1){
    $status_class = " a005_status_active ";
    $status = '
          <svg class="a005_status_icon" viewBox="0 0 24 24">
            <path d="M20.285 6.709l-11.39 11.39-5.176-5.175 1.414-1.414 3.762 3.761 9.976-9.976z"/>
          </svg>';
  }else{
    $status_class = " ";
    $status = '
          <svg class="a005_status_icon" viewBox="0 0 24 24">
            <path d="M18.364 5.636l-1.414-1.414L12 9.172 7.05 4.222 5.636 5.636 10.586 10.586 5.636 15.536l1.414 1.414L12 12.828l4.95 4.95 1.414-1.414-4.95-4.95z"/>
          </svg>';
  }
  if($user->get_ban()){
    $ban_class = " a005_ban_icon ";
    $ban = '
          <svg class="a005_status_icon" viewBox="0 0 24 24">
            <path d="M12 2C6.486 2 2 6.486 2 12c0 5.513 4.486 10 10 10s10-4.487 10-10c0-5.514-4.486-10-10-10zm6.707 13.293l-10-10L6.293 6.707l10 10 2.414-2.414z"/>
          </svg>';
  }else{
    $ban_class = " ";
    $ban = '';
  }
  echo '
  <table class="a005_table">
      <tr class="a005_tr_body">
        <td class="a005_td a005_status">'.$user->get_id().'</td>
        <td class="a005_td">'.$user->get_username().'</td>
        <td class="a005_td a005_email">'.$user->get_email().'</td>
        <td class="a005_td '.$status_class.' a005_status">'.$status.'</td>
        <td class="a005_td '.$ban_class.' a005_status">'.$ban.'</td>
        <td class="a005_td">
          <div class="a005_actions">
           <a href="/admin/system/user/edit/?id='.$user->get_id().'" class="a005_action_button" title="Редактировать">
              <svg viewBox="0 0 24 24">
                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM21.41 6.34a1.25 1.25 0 000-1.77l-2-2a1.25 1.25 0 00-1.77 0l-1.83 1.83 3.75 3.75 1.85-1.81z"/>
              </svg>
            </a>
            <a href="" class="a005_action_button" title="Просмотреть">
              <svg viewBox="0 0 24 24">
                <path d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7zm0 12a5 5 0 110-10 5 5 0 010 10z"/>
              </svg>
            </a>
          </div>
        </td>
      </tr>
    </table>
  ';
}
  ?>
    

  </div>
</div>


