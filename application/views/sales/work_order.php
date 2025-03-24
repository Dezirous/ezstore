<?php $this->load->view("partial/header"); ?>

<style>
    body {
        font-size: 1.2em;
    }

    table,
    td,
    th {
        border: 1px solid;
        padding: 1px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>

<?php
if (isset($error_message)) {
    echo "<div class='alert alert-dismissible alert-danger'>" . $error_message . "</div>";
    exit;
}
?>

<?php if (!empty($customer_email)): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            var send_email = function () {
                $.get('<?php echo site_url() . "/sales/send_pdf/" . $sale_id_num . "/work_order"; ?>',
                    function (response) {
                        $.notify({ message: response.message }, { type: response.success ? 'success' : 'danger' })
                    }, 'json'
                );
            };

            $("#show_email_button").click(send_email);

            <?php if (!empty($email_receipt)): ?>
                send_email();
            <?php endif; ?>
        });
    </script>
<?php endif; ?>

<?php $this->load->view('partial/print_receipt', array('print_after_sale' => $print_after_sale, 'selected_printer' => 'invoice_printer')); ?>

<div class="print_hide" id="control_buttons" style="text-align:right">
    <a href="javascript:printdoc();">
        <div class="btn btn-info btn-sm" , id="show_print_button">
            <?php echo '<span class="glyphicon glyphicon-print">&nbsp</span>' . $this->lang->line('common_print'); ?>
        </div>
    </a>
    <?php /* this line will allow to print and go back to sales automatically.... echo anchor("sales", '<span class="glyphicon glyphicon-print">&nbsp</span>' . $this->lang->line('common_print'), array('class'=>'btn btn-info btn-sm', 'id'=>'show_print_button', 'onclick'=>'window.print();')); */ ?>
    <?php if (isset($customer_email) && !empty($customer_email)): ?>
        <a href="javascript:void(0);">
            <div class="btn btn-info btn-sm" , id="show_email_button">
                <?php echo '<span class="glyphicon glyphicon-envelope">&nbsp</span>' . $this->lang->line('sales_send_work_order'); ?>
            </div>
        </a>
    <?php endif; ?>
    <?php echo anchor("sales", '<span class="glyphicon glyphicon-shopping-cart">&nbsp</span>' . $this->lang->line('sales_register'), array('class' => 'btn btn-info btn-sm', 'id' => 'show_sales_button')); ?>
    <?php echo anchor("sales/discard_suspended_sale", '<span class="glyphicon glyphicon-remove">&nbsp</span>' . $this->lang->line('sales_discard'), array('class' => 'btn btn-danger btn-sm', 'id' => 'discard_work_order_button')); ?>
</div>

<div id="page-wrap" style="width: 100%;">
    <div style="font-size: 1.5em;text-align:center;"><?php echo "UNPAID ORDER SLIP"; ?></div>
    <?php
    if (isset($customer)) {
        $customer_track = array();
        $customer_track = explode("\n", $customer_info);
    }
    ?>
    <table>
        <tr>
            <td style="width:45%;">Order Date Time</td>
            <td style="width:55%;"><?php echo $transaction_time; ?></td>
        </tr>
        <tr>
            <td>Customer Name </td>
            <td><?php echo $customer_track[0]; ?></td>
        </tr>
        <tr>
            <td>Customer Contact </td>
            <td><?php echo $customer_track[1]; ?></td>
        </tr>
        <tr>
            <td>Total Bill Amount</td>
            <td><?php echo to_currency($total); ?></td>
        </tr>
    </table>

    <table>
        <tr>
            <th style="width:75%;text-align:center;">Item</th>
            <th style="width:25%;text-align:center;">Total</th>
        </tr>
        <?php foreach ($cart as $line => $item) { ?>
            <tr class="item-row">
                <td>
                    <?php echo to_quantity_decimals($item['quantity']) . 'x ' . $item['name']; ?>
                </td>
                <td style='text-align:center;'>
                    <?php echo number_format($item['discounted_total'], 2); ?>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2" style="text-align:center; padding: 10px 0px 30px 0px;">
                <img src='data:image/png;base64,<?php echo $barcode; ?>' /><br>
                <?php echo 'WO ' . $sale_id_num; ?>
            </td>
        </tr>

    </table>


</div>

<script type="text/javascript">
    setTimeout(function () {
        window.print();
        self.close();
    }, 1000);

</script>


<?php $this->load->view("partial/footer"); ?>