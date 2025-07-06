
<form method="post" action="/admin/shop/product/specific/?id=<?php echo $_GET["id"];?>"> 
    <div class="a031_header_block">
        <div class="a031_header_title">Список параметров товара</div>
        <button name="save_boot_new_product" value="save" class="a023_add_button">
            Сохранить
        </button>
    </div>
    
    <div id="box_msg">   
<?php
if($this->data_view["result_add"]["job"]){
    if($this->data_view["result_add"]["result"]){
echo '  <div class="a023_toast a023_toast_success">
            <span class="a023_toast_icon">✔</span>
            <span class="a023_toast_text">Данные успешно сохранены </span>
        </div>';
    }else{
        
echo '  <div class="a023_toast a023_toast_error">
            <span class="a023_toast_icon">✖</span>
            <span class="a023_toast_text"'.$this->data_view["result_add"]["msg"].'</span>
        </div>';
    }
}
?> 
    </div>

    <div class="a031_table_wrapper">
       
        
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
    echo  $passa."['".$item_spec->get_id()."','".$item_spec->get_name_ru()."','".$item_spec->get_unit()."','".$item_spec->get_active()."','".$item_spec->get_value_data()."' ]";
}
echo '];';
?>

let blockCounter = 0;

// Инициализация - создаем блоки для активных элементов
function initializeActiveBlocks() {
    spec.forEach(item => {
        if (item[3] === 'active') {
            createNewBlock(item[0], item[4], true); // Передаем значение
        }
    });
    
    if ($('.a031_tbody').length === 0) {
        createNewBlock();
    }
}

// Создание нового блока
function createNewBlock(preselectedValue = null, presetValue = '', isInitialBlock = false) {
    const wrapper = $('.a031_table_wrapper');
    const existingBlocks = wrapper.find('.a031_tbody').length;
    
    if (!isInitialBlock && existingBlocks >= spec.length) {
        alert('Достигнуто максимальное количество параметров');
        return;
    }

    if (!isInitialBlock) blockCounter++;
    const blockId = isInitialBlock ? 'init_block_' + existingBlocks : 'block_' + blockCounter;

    // Генерация options
    let optionsHtml = '<option value="">Выберите параметр</option>';
    spec.forEach(item => {
        const isSelected = item[0] === preselectedValue;
        const isAvailable = item[3] === 'noactive' || isSelected;
        
        if (isAvailable) {
            optionsHtml += `<option value="${item[0]}" ${isSelected ? 'selected' : ''}>
                ${item[1]} (${item[2]})
            </option>`;
        }
    });

    // Создание блока с учетом presetValue
    const newBlock = $(`
        <div class="a031_tbody" data-block-id="${blockId}">
            <table class="a031_table">
                <tr class="a031_tr_body">
                    <td class="a031_td a031_td_id">
                        <div class="a031_input_wrapper">
                            <select class="a031_input_field_select" name="spec_name_${blockId}">
                                ${optionsHtml}
                            </select>
                            <label class="a031_input_label" for="spec_name_${blockId}">Параметр</label>
                        </div>
                    </td>
                    <td class="a031_td a031_td_name">
                        <div class="a031_input_wrapper">
                            <input class="a031_input_field" type="text" name="value_data_${blockId}" 
                                   placeholder="Простой текст" value="${presetValue || ''}">
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

    if (preselectedValue) {
        newBlock.find('.a031_input_field_select').data('prev-value', preselectedValue);
    }

    // Обработчики событий
    newBlock.find('.a031_action_button').click(function(e) {
        e.preventDefault();
        const select = newBlock.find('.a031_input_field_select');
        const selectedValue = select.val();
        
        if (selectedValue) {
            const specIndex = spec.findIndex(item => item[0] === selectedValue);
            if (specIndex !== -1) {
                spec[specIndex][3] = 'noactive';
                spec[specIndex][4] = ''; // Очищаем значение при удалении
            }
        }
        
        newBlock.remove();
        updateAllSelects();
    });

    newBlock.find('.a031_input_field_select').change(function() {
        const select = $(this);
        const selectedValue = select.val();
        const prevValue = select.data('prev-value');
        
        if (prevValue) {
            const prevIndex = spec.findIndex(item => item[0] === prevValue);
            if (prevIndex !== -1) {
                spec[prevIndex][3] = 'noactive';
                spec[prevIndex][4] = ''; // Очищаем предыдущее значение
            }
        }
        
        if (selectedValue) {
            const newIndex = spec.findIndex(item => item[0] === selectedValue);
            if (newIndex !== -1) {
                spec[newIndex][3] = 'active';
                // Сохраняем значение из input'а
                spec[newIndex][4] = newBlock.find('.a031_input_field').val();
            }
        }
        
        select.data('prev-value', selectedValue);
        updateAllSelects();
    });

    // Обновляем значение в массиве при изменении input'а
    newBlock.find('.a031_input_field').on('input', function() {
        const select = newBlock.find('.a031_input_field_select');
        const selectedValue = select.val();
        
        if (selectedValue) {
            const specIndex = spec.findIndex(item => item[0] === selectedValue);
            if (specIndex !== -1) {
                spec[specIndex][4] = $(this).val();
            }
        }
    });

    wrapper.append(newBlock);
}

// Обновление всех select элементов
function updateAllSelects() {
    const selectedValues = [];
    $('.a031_input_field_select').each(function() {
        const val = $(this).val();
        if (val) selectedValues.push(val);
    });

    $('.a031_input_field_select').each(function() {
        const select = $(this);
        const currentValue = select.val();
        
        let optionsHtml = '<option value="">Выберите параметр</option>';
        
        spec.forEach(item => {
            const isSelected = item[0] === currentValue;
            const isAvailable = item[3] === 'noactive' || 
                              selectedValues.includes(item[0]) && isSelected;
            
            if (isAvailable) {
                optionsHtml += `<option value="${item[0]}" ${isSelected ? 'selected' : ''}>
                    ${item[1]} (${item[2]})
                </option>`;
            }
        });
        
        const prevValue = select.data('prev-value');
        select.html(optionsHtml);
        if (currentValue) select.val(currentValue);
        else if (prevValue) select.val(prevValue);
    });
}

// Кнопка добавления
$('.a031_add_button').click(function(e) {
    e.preventDefault();
    createNewBlock();
});

// Запуск
initializeActiveBlocks();
});

$(document).ready(function() {
    $('.a023_toast').delay(3000).fadeOut(500, function() {
        $(this).remove();
    });
});
</script>
