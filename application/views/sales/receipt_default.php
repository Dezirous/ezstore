<style>
    table,
    td,
    th {
        padding: 1px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>

<div id="receipt_wrapper" style="margin:0; font-size:<?php echo $this->config->item('receipt_font_size'); ?>px">
    <div id="receipt_header">
        <?php
        if ($this->config->item('company_logo') != '') {
            ?>
            <div id="company_name">
                <img id="image" src="<?php echo base_url('uploads/' . $this->config->item('company_logo')); ?>"
                    alt="company_logo" />
            </div>
            <?php
        }
        ?>

        <?php
        if ($this->config->item('receipt_show_company_name')) {
            ?>
            <div id="company_name"><?php echo $this->config->item('company'); ?></div>
            <?php
        }
        ?>

        <div id="company_address"><?php echo $store_address; ?></div>
        <div id="company_phone"><?php echo $store_contact; ?></div>
        <div id="sale_receipt"><?php echo $this->lang->line('sales_receipt'); ?></div>
        <div id="sale_time"><?php echo $transaction_time ?></div>
    </div>

    <div id="receipt_general_info">
        <?php
        if (isset($customer)) {
            ?>
            <div id="customer">
                <?php echo $this->lang->line('customers_customer') . ": " . $customer; ?>
            </div>
            <?php
        }
        ?>

        <div id="sale_id"><?php echo $this->lang->line('sales_id') . ": " . $sale_id; ?></div>

        <?php
        if (!empty($invoice_number)) {
            ?>
            <div id="invoice_number"><?php echo $this->lang->line('sales_invoice_number') . ": " . $invoice_number; ?></div>
            <?php
        }
        ?>

        <div id="employee"><?php echo $this->lang->line('employees_employee') . ": " . $employee; ?></div>
    </div>

    <table id="receipt_items">
        <tr>
            <th colspan=5>Product Description</th>
        </tr>
        <tr style="border-bottom: 1px solid black;">
            <th style="width:20%;">Quantity</th>
            <th style="width:20%;text-align:right;">Unit Price</th>
            <th style="width:20%;text-align:right;">Sub Total</th>
            <th style="width:10%;text-align:right;">Disc.</th>
            <th style="width:30%;text-align:right;" class="total-value">Total</th>
            <?php
            //if($this->config->item('receipt_show_tax_ind'))
            //{
            // write tax amount here
            //}
            ?>
        </tr>
        <?php
        $grand_subtotal = $subtotal = $grand_subtotal = 0;
        foreach ($cart as $line => $item) {
            if ($item['item_id'] > 1) {
                $subtotal = $item['price'] * $item['quantity'];
                $grand_subtotal = $grand_subtotal + $subtotal;
                if ($item['print_option'] == PRINT_YES) {
                    ?>
                    <tr>
                        <td colspan=5>
                            <strong><?php echo $item['name']; ?></strong>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px; border-style: dotted;">
                        <td>
                            <?php echo number_format($item['quantity'], 0); ?>
                        </td>
                        <td style="text-align:right;">
                            <?php echo number_format($item['price'], 2); ?>
                        </td>
                        <td style="text-align:right;">
                            <?php echo number_format($subtotal, 2); ?>
                        </td>
                        <td style="text-align:right;">
                            <?php echo number_format($item['discount']) . "%"; ?>
                        </td>
                        <td class="total-value">
                            <?php echo number_format($item[($this->config->item('receipt_show_total_discount') ? 'total' : 'discounted_total')], 2); ?>
                        </td>
                        <?php
                        //if ($this->config->item('receipt_show_tax_ind')) {
                        // echo $item['taxed_flag'] 
            
                        //}
                        ?>
                    </tr>
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php $border = (!$this->config->item('receipt_show_taxes') && !($this->config->item('receipt_show_total_discount') && $discount > 0)); ?>
        <tr style="border-top: 1px solid black;">
            <td colspan="2">Total:</td>
            <td style="text-align:right;"><?php echo to_currency($grand_subtotal); ?></td>
            <td colspan="2" style="text-align:right;"><?php echo to_currency($total); ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">Card service charges (1.5%):</td>
            <td style="text-align:right;"><?php echo to_currency($additional_charges); ?></td>
        </tr>

        <tr>
            <td colspan="5" style="border-top: 1px solid black;"></td>
        </tr>

        <?php
        $only_sale_check = FALSE;
        $show_giftcard_remainder = FALSE;
        foreach ($payments as $payment_id => $payment) {
            $only_sale_check |= $payment['payment_type'] == $this->lang->line('sales_check');
            $splitpayment = explode(':', $payment['payment_type']);
            $show_giftcard_remainder |= $splitpayment[0] == $this->lang->line('sales_giftcard');

            if ($payment['payment_amount'] > 0) {
                ?>
                <tr>
                    <td colspan="4"><?php echo $splitpayment[0]; ?> </td>
                    <td class="total-value"><?php echo to_currency($payment['payment_amount'] * -1); ?></td>
                </tr>

            <?php } ?>
        <?php } ?>

        <?php
        if (isset($cur_giftcard_value) && $show_giftcard_remainder) {
            ?>
            <tr>
                <td colspan="4" style="text-align:right;"><?php echo $this->lang->line('sales_giftcard_balance'); ?></td>
                <td class="total-value"><?php echo to_currency($cur_giftcard_value); ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="4">
                <?php echo $this->lang->line($amount_change >= 0 ? ($only_sale_check ? 'sales_check_balance' : 'sales_change_due') : 'sales_amount_due'); ?>
            </td>
            <td class="total-value"><?php echo to_currency($amount_change); ?></td>
        </tr>
    </table>

    <div id="sale_return_policy">
        <?php echo nl2br($this->config->item('return_policy')); ?>
    </div>

    <div id="barcode">
        <img src='data:image/png;base64,<?php echo $barcode; ?>' /><br>
        <?php echo $sale_id; ?>
    </div>
</div>