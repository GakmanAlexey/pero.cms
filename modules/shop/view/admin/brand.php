<div class="a015_header_block">
    <div class="a015_header_title">Список брендов</div>
    <a href="/admin/shop/brand/new/" class="a015_add_button">
        <svg class="a015_add_icon" viewBox="0 0 24 24">
        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/>
        </svg>
        Добавить бренд
    </a>
</div>



<div class="a015_table_wrapper">
    <table class="a015_table">
        <thead class="a015_thead">
        <tr class="a015_tr_header">
            <th class="a015_th a015_td_id">ID</th>
            <th class="a015_th a015_td_brand">Бренд</th>
            <th class="a015_th a015_td_status">Статус</th>
            <th class="a015_th a015_td_view">Просмотры</th>
            <th class="a015_th" style="text-align: right;">Действия</th>
        </tr>
        </thead>
    </table>

    <div class="a015_tbody">
<?php
foreach($this->data_view as $brand){
    echo '
    <table class="a015_table">
            <tr class="a015_tr_body">
                <td class="a015_td a015_td_id">'.$brand->get_id().'</td>
                <td class="a015_td a015_td_brand">'.$brand->get_name_ru().'</td>
                <td class="a015_td a015_td_status_active">'.$brand->ru_status().'</td>                
                <td class="a015_td a015_td_view">'.$brand->get_view_count().'</td>
                <td class="a015_td">
                <div class="a015_actions">
                    <a href="" class="a015_action_button" title="Редактировать">
                        <svg viewBox="0 0 24 24" fill="#2F6BF2">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM21.41 6.34a1.25 1.25 0 000-1.77l-2-2a1.25 1.25 0 00-1.77 0l-1.83 1.83 3.75 3.75 1.85-1.81z"/>
                        </svg>
                    </a>
                    <a href="" class="a005_action_button" title="Просмотреть">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7zm0 12a5 5 0 110-10 5 5 0 010 10z"/>
                        </svg>
                    </a>
                    <a href="" class="a015_action_button" title="Управление">
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