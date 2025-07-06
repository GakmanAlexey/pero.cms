
<form method="post"> 
    <div class="a031_header_block">
        <div class="a031_header_title">Список параметров товара</div>
        <a href="" class="a031_add_button">
            Сохранить
        </a>
    </div>



    <div class="a031_table_wrapper">
        <?php /*
        <div class="a031_tbody">
            <table class="a031_table">
                <tr class="a031_tr_body">
                    <td class="a031_td a031_td_id">
                        <div class="a031_input_wrapper">
                            <select class="a031_input_field_select" name="spec_name">
                                <option value="option1">Опция 1</option>
                                <option value="option2">Опция 2</option>
                            </select>
                            <label class="a031_input_label" for="spec_name">Параметр</label>
                        </div>
                    </td>
                    <td class="a031_td a031_td_name">
                        <div class="a031_input_wrapper">
                            <input class="a031_input_field" type="text" name="value_data" placeholder="Простой текст" value="">
                            <label class="a031_input_label" for="value_data">Значение параметра</label>
                        </div>
                    </td>
                    <td class="a031_td a031_actions_wrap">
                    <div class="a031_actions">
                        <a href="" class="a031_action_button" title="Удаление">
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
        </div> */ ?>
        
    </div>

    <div class="a031_btn_box_in"> 
        <a href="" class="a031_add_button">
            <svg class="a031_add_icon" viewBox="0 0 24 24">
            <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/>
            </svg>
            Добавить
        </a>
    </div>   
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    <?php
echo 'let spec = [';
$x= 0;
foreach( $this->data_view["list_all"] as $item_spec){
    if($x == 0){
        $passa = "";
    }else{
        $passa = ",";
    }
    $x++;
    echo  $passa."['".$item_spec->get_id()."','".$item_spec->get_name_ru()."','".$item_spec->get_unit()."','noactive' ]";
}
echo '];';
?>

    let blockCounter = 0; // Счетчик для уникальных идентификаторов блоков

    // Функция для создания нового блока
    function createNewBlock() {
        const wrapper = $('.a031_table_wrapper');
        const existingBlocks = wrapper.find('.a031_tbody').length;
        
        if (existingBlocks >= spec.length) {
            alert('Достигнуто максимальное количество параметров');
            return;
        }

        blockCounter++; 
        const blockId = 'block_' + blockCounter; 

        const newBlock = $(`
            <div class="a031_tbody" data-block-id="${blockId}">
                <table class="a031_table">
                    <tr class="a031_tr_body">
                        <td class="a031_td a031_td_id">
                            <div class="a031_input_wrapper">
                                <select class="a031_input_field_select" name="spec_name_${blockId}">
                                    <option value="">Выберите параметр</option>
                                    ${generateOptions()}
                                </select>
                                <label class="a031_input_label" for="spec_name_${blockId}">Параметр</label>
                            </div>
                        </td>
                        <td class="a031_td a031_td_name">
                            <div class="a031_input_wrapper">
                                <input class="a031_input_field" type="text" name="value_data_${blockId}" placeholder="Простой текст" value="">
                                <label class="a031_input_label" for="value_data_${blockId}">Значение параметра</label>
                            </div>
                        </td>
                        <td class="a031_td a031_actions_wrap">
                            <div class="a031_actions">
                                <a href="#" class="a031_action_button" title="Удаление">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="#2F6BF2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M3 6h18" />
                                        <path d="M19 6l-1 14H6L5 6" />
                                        <path d="M10 11v6" />
                                        <path d="M14 11v6" />
                                        <path d="M9 6V4h6v2" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        `);

        newBlock.find('.a031_action_button').click(function(e) {
            e.preventDefault();
            const select = newBlock.find('.a031_input_field_select');
            const selectedValue = select.val();
            
            if (selectedValue) {
                const specIndex = spec.findIndex(item => item[0] === selectedValue);
                if (specIndex !== -1) {
                    spec[specIndex][3] = 'noactive';
                }
            }
            
            newBlock.remove();
            updateAllSelects(); 
        });

        newBlock.find('.a031_input_field_select').change(function() {
            const selectedValue = $(this).val();
            const prevValue = $(this).data('prev-value');
            
            if (prevValue) {
                const prevIndex = spec.findIndex(item => item[0] === prevValue);
                if (prevIndex !== -1) spec[prevIndex][3] = 'noactive';
            }
            
            if (selectedValue) {
                const newIndex = spec.findIndex(item => item[0] === selectedValue);
                if (newIndex !== -1) spec[newIndex][3] = 'active';
            }
            
            $(this).data('prev-value', selectedValue);
            updateAllSelects(); 
        });

        wrapper.append(newBlock);
    }

    function generateOptions() {
        let options = '';
        
        spec.forEach(item => {
            if (item[3] === 'noactive') {
                options += `<option value="${item[0]}">${item[1]} (${item[2]})</option>`;
            }
        });
        
        return options;
    }

    function updateAllSelects() {
        $('.a031_input_field_select').each(function() {
            const currentValue = $(this).val();
            const select = $(this);
            
            select.empty().append('<option value="">Выберите параметр</option>');
            
            spec.forEach(item => {
                if (item[0] === currentValue || item[3] === 'noactive') {
                    select.append(`<option value="${item[0]}" ${item[0] === currentValue ? 'selected' : ''}>${item[1]} (${item[2]})</option>`);
                }
            });
        });
    }

    $('.a031_add_button').click(function(e) {
        e.preventDefault();
        createNewBlock();
    });

    createNewBlock();
});
</script>
