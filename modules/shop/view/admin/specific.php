<div class="a028_header_block">
    <div class="a028_header_title">Список брендов</div>
    <a href="" class="a028_add_button">
        <svg class="a028_add_icon" viewBox="0 0 24 24">
        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/>
        </svg>
        Добавить бренд
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
        <table class="a028_table">
            <tr class="a028_tr_body">
                <td class="a028_td a028_td_id">1</td>
                <td class="a028_td a028_td_name">Количество</td>
                <td class="a028_td a028_td_unit">шт</td>    
                <td class="a028_td">
                <div class="a028_actions">
                    <a href="" class="a028_action_button" title="Редактировать">
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
        </table>
    </div>
</div>

<style>
    

.a028_header_block {
    margin-top: 80px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #ffffff;
    border-radius: 10px;
    padding: 15px 20px;
    margin-bottom: 20px;
  }

  .a028_header_title {
    font-size: 20px;
    font-weight: bold;
    color: #333333;
  }

  .a028_add_button {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 7px 26px;
    background: #2F6BF2;
    border-radius: 5px;
    color: #fff;
    font-size: 14px;
    border: none;
    cursor: pointer;
  }

  .a028_add_icon {
    width: 16px;
    height: 16px;
    fill: #ffffff;
  }


  
.a028_table_wrapper {
    width: 100%;
    font-size: 14px;
  }

  .a028_table {
    width: 100%;
    border-spacing: 0;
    border-collapse: separate;
  }

  .a028_thead {
  }

  .a028_tr_header {
    display: table;
    width: 100%;
    table-layout: fixed;
  }

  .a028_th {
    padding: 10px 15px;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .a028_tbody {
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-top: 10px;
  }

  .a028_tr_body {
    display: table;
    width: 100%;
    table-layout: fixed;
    background-color: #ffffff;
    border-radius: 10px;
  }

  .a028_td {
    padding: 10px 15px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    vertical-align: middle;
  }

  .a028_actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }

  .a028_action_button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
  }

  .a028_action_button svg {
    width: 18px;
    height: 18px;
  }


  .a028_td_id{
    width: 60px;
  }

  .a028_td_status_active{
    color: #0A7E23;
  }

  .a028_td_status_deseible{
    color: #636363;
  }

</style>