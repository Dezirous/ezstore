<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open('items/save/' . $item_info->item_id, array('id' => 'item_form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')); ?>
<fieldset id="item_basic_info">
    <div class="form-group form-group-sm">
        <?php echo form_label($this->lang->line('items_item_number'), 'item_number', array('class' => 'control-label col-xs-3')); ?>
        <div class='col-xs-8'>
            <div class="input-group">
                <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-barcode"></span></span>
                <?php echo form_input(
                    array(
                        'name' => 'item_number',
                        'id' => 'item_number',
                        'class' => 'form-control input-sm',
                        'value' => $item_info->item_number
                    )
                ); ?>
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label($this->lang->line('items_name'), 'name', array('class' => 'required control-label col-xs-3')); ?>
        <div class='col-xs-8'>
            <?php echo form_input(
                array(
                    'name' => 'name',
                    'id' => 'name',
                    'class' => 'form-control input-sm',
                    'value' => $item_info->name
                )
            ); ?>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label($this->lang->line('items_category'), 'category', array('class' => 'required control-label col-xs-3')); ?>
        <div class='col-xs-8'>
            <div class="input-group">
                <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-tag"></span></span>
                <?php
                if ($this->Appconfig->get('category_dropdown')) {
                    echo form_dropdown('category', $categories, $selected_category, array('class' => 'form-control'));
                } else {
                    echo form_input(
                        array(
                            'name' => 'category',
                            'id' => 'category',
                            'class' => 'form-control input-sm',
                            'value' => $item_info->category
                        )
                    );
                }
                ?>
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label('Pack Price', 'pack_price', array('class' => 'required control-label col-xs-3')); ?>
        <div class='col-xs-8'>
            <div class="input-group input-group-sm">
                <?php if (!currency_side()): ?>
                    <span
                        class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
                <?php endif; ?>
                <?php echo form_input(
                    array(
                        'name' => 'pack_price',
                        'id' => 'pack_price',
                        'class' => 'required form-control input-sm',
                        'onClick' => 'this.select();',
                        'value' => to_currency_no_money($item_info->pack_price)
                    )
                ); ?>
                <?php if (currency_side()): ?>
                    <span
                        class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label("Pack Size", 'receiving_quantity', array('class' => 'required control-label col-xs-3')); ?>
        <div class='col-xs-8'>
            <?php echo form_input(
                array(
                    'name' => 'receiving_quantity',
                    'id' => 'receiving_quantity',
                    'class' => 'required form-control input-sm',
                    'onClick' => 'this.select();',
                    'value' => isset($item_info->item_id) ? to_quantity_decimals($item_info->receiving_quantity) : to_quantity_decimals(0)
                )
            ); ?>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label('Discount (Retail)', 'discount_retail', array('class' => 'required control-label col-xs-3')); ?>
        <div class="col-xs-8">
            <div class="input-group input-group-sm">
                <?php echo form_input(
                    array(
                        'name' => 'discount_retail',
                        'id' => 'discount_retail',
                        'class' => 'required form-control input-sm',
                        'onClick' => 'this.select();',
                        'value' => $item_info->discount_retail
                    )
                ); ?>
                <span class="input-group-addon input-sm"><b>%</b></span>
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label('Discount (Purchase)', 'discount_purchase', array('class' => 'required control-label col-xs-3')); ?>
        <div class="col-xs-8">
            <div class="input-group input-group-sm">
                <?php echo form_input(
                    array(
                        'name' => 'discount_purchase',
                        'id' => 'discount_purchase',
                        'class' => 'required form-control input-sm',
                        'onClick' => 'this.select();',
                        'value' => $item_info->discount_purchase
                    )
                ); ?>
                <span class="input-group-addon input-sm"><b>%</b></span>
            </div>
        </div>
    </div>

    <?php
    foreach ($stock_locations as $key => $location_detail) {
        ?>
        <div class="form-group form-group-sm">
            <?php echo form_label('Stock In: ' . $location_detail['location_name'], 'quantity_' . $key, array('class' => 'required control-label col-xs-3')); ?>
            <div class='col-xs-8'>
                <?php echo form_input(
                    array(
                        'name' => 'quantity_' . $key,
                        'id' => 'quantity_' . $key,
                        'class' => 'required quantity form-control readonly',
                        'onClick' => 'this.select();',
                        'value' => isset($item_info->item_id) ? to_quantity_decimals($location_detail['quantity']) : to_quantity_decimals(0)
                    )
                ); ?>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="form-group form-group-sm">
        <?php echo form_label("Min. Stock<br>(In units)", 'reorder_level', array('class' => 'required control-label col-xs-3')); ?>
        <div class='col-xs-8'>
            <?php echo form_input(
                array(
                    'name' => 'reorder_level',
                    'id' => 'reorder_level',
                    'class' => 'form-control input-sm',
                    'onClick' => 'this.select();',
                    'value' => isset($item_info->item_id) ? to_quantity_decimals($item_info->reorder_level) : to_quantity_decimals(0)
                )
            ); ?>
        </div>
    </div>

    <div id="attributes">
        <script type="text/javascript">
            $('#attributes').load('<?php echo site_url("items/attributes/$item_info->item_id"); ?>');
        </script>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label($this->lang->line('items_stock_type'), 'stock_type', !empty($basic_version) ? array('class' => 'required control-label col-xs-3') : array('class' => 'control-label col-xs-3')); ?>
        <div class="col-xs-8">
            <label class="radio-inline">
                <?php echo form_radio(
                    array(
                        'name' => 'stock_type',
                        'type' => 'radio',
                        'id' => 'stock_type',
                        'value' => 0,
                        'checked' => $item_info->stock_type == HAS_STOCK
                    )
                ); ?> <?php echo $this->lang->line('items_stock'); ?>
            </label>
            <label class="radio-inline">
                <?php echo form_radio(
                    array(
                        'name' => 'stock_type',
                        'type' => 'radio',
                        'id' => 'stock_type',
                        'value' => 1,
                        'checked' => $item_info->stock_type == HAS_NO_STOCK
                    )
                ); ?><?php echo $this->lang->line('items_nonstock'); ?>
            </label>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label($this->lang->line('items_type'), 'item_type', !empty($basic_version) ? array('class' => 'required control-label col-xs-3') : array('class' => 'control-label col-xs-3')); ?>
        <div class="col-xs-8">
            <label class="radio-inline">
                <?php
                $radio_button = array(
                    'name' => 'item_type',
                    'type' => 'radio',
                    'id' => 'item_type',
                    'value' => 0,
                    'checked' => $item_info->item_type == ITEM
                );
                if ($standard_item_locked) {
                    $radio_button['disabled'] = TRUE;
                }
                echo form_radio($radio_button); ?> <?php echo $this->lang->line('items_standard'); ?>
            </label>
            <label class="radio-inline">
                <?php
                $radio_button = array(
                    'name' => 'item_type',
                    'type' => 'radio',
                    'id' => 'item_type',
                    'value' => 1,
                    'checked' => $item_info->item_type == ITEM_KIT
                );
                if ($item_kit_disabled) {
                    $radio_button['disabled'] = TRUE;
                }
                echo form_radio($radio_button); ?> <?php echo $this->lang->line('items_kit');
                   ?>
            </label>
            <?php
            if ($this->config->item('derive_sale_quantity') == '1') {
                ?>
                <label class="radio-inline">
                    <?php echo form_radio(
                        array(
                            'name' => 'item_type',
                            'type' => 'radio',
                            'id' => 'item_type',
                            'value' => 2,
                            'checked' => $item_info->item_type == ITEM_AMOUNT_ENTRY
                        )
                    ); ?>     <?php echo $this->lang->line('items_amount_entry'); ?>
                </label>
                <?php
            }
            ?>
            <?php
            if ($allow_temp_item == 1) {
                ?>
                <label class="radio-inline">
                    <?php echo form_radio(
                        array(
                            'name' => 'item_type',
                            'type' => 'radio',
                            'id' => 'item_type',
                            'value' => 3,
                            'checked' => $item_info->item_type == ITEM_TEMP
                        )
                    ); ?>     <?php echo $this->lang->line('items_temp'); ?>
                </label>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label($this->lang->line('items_supplier'), 'supplier', array('class' => 'control-label col-xs-3')); ?>
        <div class='col-xs-8'>
            <?php echo form_dropdown('supplier_id', $suppliers, $selected_supplier, array('class' => 'form-control')); ?>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label('Image', 'items_image', array('class' => 'control-label col-xs-3')); ?>
        <div class='col-xs-8'>
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="google(); return false;"><i
                    class="fa fa-search"></i> Search on Google</a>
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="bing(); return false;"><i
                    class="fa fa-search"></i> Search on Bing</a>
            <br>

            <div id='editor' contenteditable=true class="form-control"></div>
            <textarea id="imagedata" name="imagedata" cols="5" row="5" style="display:none;width:100%"
                placeholder="Paste screenshot here..."></textarea>
            <img src="<?php echo "https://cdn.deziretech.pk/" . $item_info->item_id . ".jpg"; ?>" id="preview" alt=""
                width="100%" height="200">
            <br>

            <div class="fileinput <?php echo $logo_exists ? 'fileinput-exists' : 'fileinput-new'; ?> "
                data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;"></div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 100px;">
                    <img data-src="holder.js/100%x100%" alt="<?php echo $this->lang->line('items_image'); ?>"
                        src="<?php echo $image_path; ?>" style="max-height: 100%; max-width: 100%;">
                </div>
                <div>
                    <span class="btn btn-default btn-sm btn-file">
                        <span class="fileinput-new"><?php echo $this->lang->line("items_select_image"); ?></span>
                        <span class="fileinput-exists"><?php echo $this->lang->line("items_change_image"); ?></span>
                        <input type="file" name="item_image" accept="image/*">
                    </span>
                    <a href="#" class="btn btn-default btn-sm fileinput-exists"
                        data-dismiss="fileinput"><?php echo $this->lang->line("items_remove_image"); ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label($this->lang->line('items_description'), 'description', array('class' => 'control-label col-xs-3')); ?>
        <div class='col-xs-8'>
            <?php echo form_textarea(array(
                'name' => 'description',
                'id' => 'description',
                'class' => 'form-control input-sm',
                'value' => $item_info->description,
                'rows' => '2',
                'cols' => '50'
            ));
            ?>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label($this->lang->line('items_allow_alt_description'), 'allow_alt_description', array('class' => 'control-label col-xs-3')); ?>
        <div class='col-xs-1'>
            <?php echo form_checkbox(
                array(
                    'name' => 'allow_alt_description',
                    'id' => 'allow_alt_description',
                    'value' => 1,
                    'checked' => ($item_info->allow_alt_description) ? 1 : 0
                )
            ); ?>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <?php echo form_label($this->lang->line('items_is_serialized'), 'is_serialized', array('class' => 'control-label col-xs-3')); ?>
        <div class='col-xs-1'>
            <?php echo form_checkbox(
                array(
                    'name' => 'is_serialized',
                    'id' => 'is_serialized',
                    'value' => 1,
                    'checked' => ($item_info->is_serialized) ? 1 : 0
                )
            ); ?>
        </div>
    </div>

    <?php
    if (!$use_destination_based_tax) {
        ?>
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('items_tax_1'), 'tax_percent_1', array('class' => 'control-label col-xs-3')); ?>
            <div class='col-xs-4'>
                <?php echo form_input(
                    array(
                        'name' => 'tax_names[]',
                        'id' => 'tax_name_1',
                        'class' => 'form-control input-sm',
                        'value' => isset($item_tax_info[0]['name']) ? $item_tax_info[0]['name'] : $this->config->item('default_tax_1_name')
                    )
                ); ?>
            </div>
            <div class="col-xs-4">
                <div class="input-group input-group-sm">
                    <?php echo form_input(
                        array(
                            'name' => 'tax_percents[]',
                            'id' => 'tax_percent_name_1',
                            'class' => 'form-control input-sm',
                            'value' => isset($item_tax_info[0]['percent']) ? to_tax_decimals($item_tax_info[0]['percent']) : to_tax_decimals($default_tax_1_rate)
                        )
                    ); ?>
                    <span class="input-group-addon input-sm"><b>%</b></span>
                </div>
            </div>
        </div>

        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('items_tax_2'), 'tax_percent_2', array('class' => 'control-label col-xs-3')); ?>
            <div class='col-xs-4'>
                <?php echo form_input(
                    array(
                        'name' => 'tax_names[]',
                        'id' => 'tax_name_2',
                        'class' => 'form-control input-sm',
                        'value' => isset($item_tax_info[1]['name']) ? $item_tax_info[1]['name'] : $this->config->item('default_tax_2_name')
                    )
                ); ?>
            </div>
            <div class="col-xs-4">
                <div class="input-group input-group-sm">
                    <?php echo form_input(
                        array(
                            'name' => 'tax_percents[]',
                            'class' => 'form-control input-sm',
                            'id' => 'tax_percent_name_2',
                            'value' => isset($item_tax_info[1]['percent']) ? to_tax_decimals($item_tax_info[1]['percent']) : to_tax_decimals($default_tax_2_rate)
                        )
                    ); ?>
                    <span class="input-group-addon input-sm"><b>%</b></span>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <?php if ($use_destination_based_tax == 9) {
        ?>
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('taxes_tax_category'), 'tax_category', array('class' => 'control-label col-xs-3')); ?>
            <div class='col-xs-8'>
                <div class="input-group input-group-sm">
                    <?php echo form_input(
                        array(
                            'name' => 'tax_category',
                            'id' => 'tax_category',
                            'class' => 'form-control input-sm',
                            'size' => '50',
                            'value' => $tax_category
                        )
                    ); ?>
                    <?php echo form_hidden('tax_category_id', $tax_category_id); ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ($include_hsn) { ?>
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('items_hsn_code'), 'category', array('class' => 'control-label col-xs-3')); ?>
            <div class='col-xs-8'>
                <div class="input-group">
                    <?php echo form_input(
                        array(
                            'name' => 'hsn_code',
                            'id' => 'hsn_code',
                            'class' => 'form-control input-sm',
                            'value' => $hsn_code
                        )
                    ); ?>
                </div>
            </div>
        </div>
    <?php } ?>


    <?php
    if ($this->config->item('multi_pack_enabled') == '1') {
        ?>
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('items_qty_per_pack'), 'qty_per_pack', array('class' => 'control-label col-xs-3')); ?>
            <div class='col-xs-8'>
                <?php echo form_input(
                    array(
                        'name' => 'qty_per_pack',
                        'id' => 'qty_per_pack',
                        'class' => 'form-control input-sm',
                        'value' => isset($item_info->item_id) ? to_quantity_decimals($item_info->qty_per_pack) : to_quantity_decimals(0)
                    )
                ); ?>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('items_pack_name'), 'name', array('class' => 'control-label col-xs-3')); ?>
            <div class='col-xs-8'>
                <?php echo form_input(
                    array(
                        'name' => 'pack_name',
                        'id' => 'pack_name',
                        'class' => 'form-control input-sm',
                        'value' => $item_info->pack_name
                    )
                ); ?>
            </div>
        </div>
        <div class="form-group  form-group-sm">
            <?php echo form_label($this->lang->line('items_low_sell_item'), 'low_sell_item_name', array('class' => 'control-label col-xs-3')); ?>
            <div class='col-xs-8'>
                <div class="input-group input-group-sm">
                    <?php echo form_input(
                        array(
                            'name' => 'low_sell_item_name',
                            'id' => 'low_sell_item_name',
                            'class' => 'form-control input-sm',
                            'value' => $selected_low_sell_item
                        )
                    ); ?>
                    <?php echo form_hidden('low_sell_item_id', $selected_low_sell_item_id); ?>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="form-group form-group-sm">
        <?php echo form_label($this->lang->line('items_is_deleted'), 'is_deleted', array('class' => 'control-label col-xs-3')); ?>
        <div class='col-xs-1'>
            <?php echo form_checkbox(
                array(
                    'name' => 'is_deleted',
                    'id' => 'is_deleted',
                    'value' => 1,
                    'checked' => ($item_info->deleted) ? 1 : 0
                )
            ); ?>
        </div>
    </div>

</fieldset>
<?php echo form_close(); ?>

<script type="text/javascript">
    //validation and submit handling
    $(document).ready(function () {
        $('#editor').on('paste', function (e) {
            $('#editor').empty();
            $('#imagedata').empty();
            var waitToPastInterval = setInterval(function () {
                if ($('#editor').children().length > 0) {
                    clearInterval(waitToPastInterval);
                    $('#imagedata').html($('#editor').find('img')[0].src);
                    $('#editor').empty();
                }
            }, 1);
        });

        $('#new').click(function () {
            stay_open = true;
            $('#item_form').submit();
        });

        $('#submit').click(function () {
            stay_open = false;
        });

        $("input[name='tax_category']").change(function () {
            !$(this).val() && $(this).val('');
        });

        var fill_value = function (event, ui) {
            event.preventDefault();
            $("input[name='tax_category_id']").val(ui.item.value);
            $("input[name='tax_category']").val(ui.item.label);
        };

        $('#tax_category').autocomplete({
            source: "<?php echo site_url('taxes/suggest_tax_categories'); ?>",
            minChars: 0,
            delay: 15,
            cacheLength: 1,
            appendTo: '.modal-content',
            select: fill_value,
            focus: fill_value
        });


        var fill_value = function (event, ui) {
            event.preventDefault();
            $("input[name='low_sell_item_id']").val(ui.item.value);
            $("input[name='low_sell_item_name']").val(ui.item.label);
        };

        $('#low_sell_item_name').autocomplete({
            source: "<?php echo site_url('items/suggest_low_sell'); ?>",
            minChars: 0,
            delay: 15,
            cacheLength: 1,
            appendTo: '.modal-content',
            select: fill_value,
            focus: fill_value
        });

        $('#category').autocomplete({
            source: "<?php echo site_url('items/suggest_category'); ?>",
            delay: 10,
            appendTo: '.modal-content'
        });

        $('a.fileinput-exists').click(function () {
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url("$controller_name/remove_logo/$item_info->item_id"); ?>',
                dataType: 'json'
            })
        });

        $.validator.addMethod('valid_chars', function (value, element) {
            return value.match(/(\||_)/g) == null;
        }, "<?php echo $this->lang->line('attributes_attribute_value_invalid_chars'); ?>");

        var init_validation = function () {
            $('#item_form').validate($.extend({
                submitHandler: function (form, event) {
                    $(form).ajaxSubmit({
                        success: function (response) {
                            var stay_open = dialog_support.clicked_id() != 'submit';
                            if (stay_open) {
                                // set action of item_form to url without item id, so a new one can be created
                                $('#item_form').attr('action', "<?php echo site_url('items/save/') ?>");
                                // use a whitelist of fields to minimize unintended side effects
                                $(':text, :password, :file, #description, #item_form').not('.quantity, #reorder_level, #tax_name_1, #receiving_quantity, ' +
                                    '#tax_percent_name_1, #category, #reference_number, #name, #cost_price, #unit_price, #taxed_cost_price, #taxed_unit_price, #definition_name, [name^="attribute_links"]').val('');
                                // de-select any checkboxes, radios and drop-down menus
                                $(':input', '#item_form').removeAttr('checked').removeAttr('selected');
                            }
                            else {
                                dialog_support.hide();
                            }
                            table_support.handle_submit('<?php echo site_url('items'); ?>', response, stay_open);
                            init_validation();
                        },
                        dataType: 'json'
                    });
                },

                errorLabelContainer: '#error_message_box',

                rules:
                {
                    name: 'required',
                    category: 'required',
                    item_number:
                    {
                        required: false,
                        remote:
                        {
                            url: "<?php echo site_url($controller_name . '/check_item_number') ?>",
                            type: 'POST',
                            data: {
                                'item_id': "<?php echo $item_info->item_id; ?>",
                                'item_number': function () {
                                    return $('#item_number').val();
                                },
                            }
                        }
                    },
                    cost_price:
                    {
                        required: true,
                        remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
                    },
                    unit_price:
                    {
                        required: true,
                        remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
                    },
                    <?php
                    foreach ($stock_locations as $key => $location_detail) {
                        ?>
                        <?php echo 'quantity_' . $key ?>:
                        {
                            required: true,
                            remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
                        },
                        <?php
                    }
                    ?>
                receiving_quantity:
                    {
                        required: true,
                        remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
                    },
                    reorder_level:
                    {
                        required: true,
                        remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
                    },
                    tax_percent:
                    {
                        required: true,
                        remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
                    }
                },

                messages:
                {
                    name: "<?php echo $this->lang->line('items_name_required'); ?>",
                    item_number: "<?php echo $this->lang->line('items_item_number_duplicate'); ?>",
                    category: "<?php echo $this->lang->line('items_category_required'); ?>",
                    cost_price:
                    {
                        required: "<?php echo $this->lang->line('items_cost_price_required'); ?>",
                        number: "<?php echo $this->lang->line('items_cost_price_number'); ?>"
                    },
                    unit_price:
                    {
                        required: "<?php echo $this->lang->line('items_unit_price_required'); ?>",
                        number: "<?php echo $this->lang->line('items_unit_price_number'); ?>"
                    },
                    <?php
                    foreach ($stock_locations as $key => $location_detail) {
                        ?>
                        <?php echo 'quantity_' . $key ?>:
                        {
                            required: "<?php echo $this->lang->line('items_quantity_required'); ?>",
                            number: "<?php echo $this->lang->line('items_quantity_number'); ?>"
                        },
                        <?php
                    }
                    ?>
                receiving_quantity:
                    {
                        required: "<?php echo $this->lang->line('items_quantity_required'); ?>",
                        number: "<?php echo $this->lang->line('items_quantity_number'); ?>"
                    },
                    reorder_level:
                    {
                        required: "<?php echo $this->lang->line('items_reorder_level_required'); ?>",
                        number: "<?php echo $this->lang->line('items_reorder_level_number'); ?>"
                    },
                    tax_percent:
                    {
                        required: "<?php echo $this->lang->line('items_tax_percent_required'); ?>",
                        number: "<?php echo $this->lang->line('items_tax_percent_number'); ?>"
                    }
                }
            }, form_support.error));
        };

        init_validation();
    });
</script>