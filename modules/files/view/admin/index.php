<div class="a011_header_block">
    <div class="a011_header_title">Список файлов</div>
    <a href="/admin/site/files/new/" class="a011_add_button">
        <svg class="a011_add_icon" viewBox="0 0 24 24">
        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/>
        </svg>
        Добавить файл
    </a>
</div>



<div class="a011_table_wrapper">
    <table class="a011_table">
        <thead class="a011_thead">
        <tr class="a011_tr_header">
            <th class="a011_th a011_td_id">ID</th>
            <th class="a011_th a011_td_prev">Превью</th>
            <th class="a011_th a011_td_path">Путь</th>
            <th class="a011_th a011_td_type">Тип</th>
            <th class="a011_th a011_td_size">Размер</th>
            <th class="a011_th" style="text-align: right;">Действия</th>
        </tr>
        </thead>
    </table>

    <div class="a011_tbody">
        <?php
foreach($this->view_data as $file){
    echo '
    <table class="a011_table">
            <tr class="a011_tr_body">
                <td class="a011_td a011_td_id">'.$file->get_id().'</td>
            <th class="a011_th a011_td_prev"><img class="a011_td_prev_img" src="'.$file->get_path().'" alt=""></th>
                <td class="a011_td a011_td_path">'.$file->get_path().'</td>
                <td class="a011_td a011_td_type">'.$file->get_type().'</td>
                <td class="a011_td a011_td_size">'.$file->get_size().'B</td>
                <td class="a011_td">
                <div class="a011_actions">
                    <a href="/admin/system/group/edit/?id=" class="a011_action_button" title="Редактировать">
                        <svg viewBox="0 0 24 24" fill="#2F6BF2">
                            <path d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7zm0 12a5 5 0 110-10 5 5 0 010 10z"></path>
                        </svg>
                    </a>
                    <a href="" class="a011_action_button" title="Управление">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            stroke="#2F6BF2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <!-- Корзина -->
                            <path d="M3 6h18" />
                            <path d="M19 6l-1 14H6L5 6" />
                            <path d="M10 11v6" />
                            <path d="M14 11v6" />
                            <!-- Крышка -->
                            <path d="M9 6V4h6v2" />
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
