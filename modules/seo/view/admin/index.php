<div class="a013_header_block">
    <div class="a013_header_title">Список страниц</div>
    <a href="" class="a013_add_button">
        <svg class="a013_add_icon" viewBox="0 0 24 24">
        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/>
        </svg>
        Добавить страницу
    </a>
</div>



<div class="a013_table_wrapper">
    <table class="a013_table">
        <thead class="a013_thead">
        <tr class="a013_tr_header">
            <th class="a013_th a013_td_id">ID</th>
            <th class="a013_th a013_td_code">Имя</th>
            <th class="a013_th a013_td_description">Адрес</th>
            <th class="a013_th" style="text-align: right;">Действия</th>
        </tr>
        </thead>
    </table>

    <div class="a013_tbody">
        <?php
foreach($this->view_data as $page){
    echo '
        <table class="a013_table">
            <tr class="a013_tr_body">
                <td class="a013_td a013_td_id">'.$page->get_id().'</td>
                <td class="a013_td a013_td_code">'.$page->get_name().'</td>
                <td class="a013_td a013_td_description">'.$page->get_url().'</td>
                <td class="a013_td">
                <div class="a013_actions">
                    <a href="/admin/site/seo/edit/?id='.$page->get_id().'" class="a013_action_button" title="Редактировать">
                        <svg viewBox="0 0 24 24" fill="#2F6BF2">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM21.41 6.34a1.25 1.25 0 000-1.77l-2-2a1.25 1.25 0 00-1.77 0l-1.83 1.83 3.75 3.75 1.85-1.81z"/>
                        </svg>
                    </a>
                    <a href="" class="a013_action_button" title="Управление">
                         <svg class="a006_group_icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2F6BF2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c0 .7.4 1.33 1.01 1.64.63.32 1.37.31 2-.01a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
                        </svg>
                    </a>
                    <a href="" class="a013_action_button" title="Управление">
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