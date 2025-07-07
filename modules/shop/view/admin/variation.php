<div class="a025_header_block">
    <div class="a025_header_title">Список товаров и вариаций</div>
</div>

<div class="a025_table_wrapper">
    <table class="a025_table">
        <thead class="a025_thead">
        <tr class="a025_tr_header">
            <th class="a025_th a025_td_id">ID</th>
            <th class="a025_th a025_td_name">Название</th>
            <th class="a025_th a025_td_price">Цена</th>
            <th class="a025_th a025_td_art">Артикул</th>
            <th class="a025_th" style="text-align: right;">Действия</th>
        </tr>
        </thead>
    </table>
<?php
foreach($this->data_view["show_all"] as $product){
    echo '<div class="a025_tbody">
        <table class="a025_table">
            <tr class="a025_tr_body">
                <td class="a025_td a025_td_id">'.$product->get_id().'</td>
                <td class="a025_td a025_td_name">'.$product->get_name_ru().'</td>
                <td class="a025_td a025_td_price">'.$product->get_price().'</td>                
                <td class="a025_td a025_td_art">'.$product->get_article().'</td>
                <td class="a025_td">
                <div class="a025_actions">
                    <a href="/admin/shop/variation/new/?id_product='.$product->get_id().'" class="a025_action_button_long" title="Добавить">
                        <svg class="a025_add_icon_blue" viewBox="0 0 24 24">
                            <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/>
                        </svg>
                        Добавить вариацию
                    </a>                    
                </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="a025_nested_table_wrapper">
        <div class="a025_tbody">
            <table class="a025_table">';
foreach($product->get_variations() as $variant){
    echo '
                <tr class="a025_tr_body_variable">
                    <td class="a025_td a025_td_id a025_wrap_variation">'.$product->get_id().':'.$variant->get_id().'</td>
                    <td class="a025_td a025_td_name">'.$variant->get_name().'</td>
                    <td class="a025_td a025_td_price">'.$variant->get_price().'</td>                
                    <td class="a025_td a025_td_art">'.$variant->get_sku().'</td>
                    <td class="a025_td">
                    <div class="a025_actions">
                    <a href="/admin/shop/variation/specific/?id='.$variant->get_id().'&id_prod='.$product->get_id().'" class="a022_action_button" title="бургер">
                    
                        <svg viewBox="0 0 24 24" fill="#2F6BF2" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6h18a1 1 0 0 0 0-2H3a1 1 0 0 0 0 2zm0 7h18a1 1 0 0 0 0-2H3a1 1 0 0 0 0 2zm0 7h18a1 1 0 0 0 0-2H3a1 1 0 0 0 0 2z"></path>
                        </svg>
                    </a>
                    <a href="" class="a025_action_button" title="Редактировать">
                        <svg viewBox="0 0 24 24" fill="#2F6BF2">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM21.41 6.34a1.25 1.25 0 000-1.77l-2-2a1.25 1.25 0 00-1.77 0l-1.83 1.83 3.75 3.75 1.85-1.81z"/>
                        </svg>
                    </a>
                    <a href="" class="a025_action_button" title="Просмотреть">
                        <svg viewBox="0 0 24 24" fill="#2F6BF2">
                            <path d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7zm0 12a5 5 0 110-10 5 5 0 010 10z"/>
                        </svg>
                    </a>
                    <a href="" class="a025_action_button" title="Управление">
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
                ';
}
                
                
echo '      </table>
        </div>        
    </div>';
}
    ?>
    


</div>