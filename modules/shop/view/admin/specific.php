<div class="a028_header_block">
    <div class="a028_header_title">Список параметров</div>
    <a href="/admin/shop/specific/new/" class="a028_add_button">
        <svg class="a028_add_icon" viewBox="0 0 24 24">
        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/>
        </svg>
        Добавить параметр
    </a>
</div>



<div class="a028_table_wrapper">
    <table class="a028_table">
        <thead class="a028_thead">
        <tr class="a028_tr_header">
            <th class="a028_th a028_td_id">ID</th>
            <th class="a028_th a028_td_name">Название</th>
            <th class="a028_th a028_td_unit">Еденица измерения</th>
            <th class="a028_th" style="text-align: right;">Действия</th>
        </tr>
        </thead>
    </table>

    <div class="a028_tbody">
        <?php
foreach ($this->data_view["list"] as $item_spec){
    echo '
        <table class="a028_table">
            <tr class="a028_tr_body">
                <td class="a028_td a028_td_id">'.$item_spec->get_id().'</td>
                <td class="a028_td a028_td_name">'.$item_spec->get_name_ru().'</td>
                <td class="a028_td a028_td_unit">'.$item_spec->get_unit().'</td>    
                <td class="a028_td">
                <div class="a028_actions">
                    <a href="/admin/shop/specific/edit/?id='.$item_spec->get_id().'" class="a028_action_button" title="Редактировать">
                        <svg viewBox="0 0 24 24" fill="#2F6BF2">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM21.41 6.34a1.25 1.25 0 000-1.77l-2-2a1.25 1.25 0 00-1.77 0l-1.83 1.83 3.75 3.75 1.85-1.81z"/>
                        </svg>
                    </a>
                    <a href="" class="a028_action_button" title="Удаление">
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
        </table>';
}
        ?>
    </div>
</div>
