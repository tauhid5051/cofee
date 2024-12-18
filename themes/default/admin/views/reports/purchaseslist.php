<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i><?= $page_title ?></h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <ul class="btn-tasks">
                    <li class="dropdown"><a id="print333" class="tip" onclick="window.print();" title="<?= lang('print') ?>"><i class="icon fa fa-print"></i></a></li>
                    <li class="dropdown"><a href="#" id="image" class="tip" title="<?= lang('save_image') ?>"><i class="icon fa fa-file-picture-o"></i></a></li>
                </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?= lang(' '); ?></p>

                <!-- pppp -->
                <div id="form" class="no-print" style=" max-width: 800px; ">

                    <?php echo admin_form_open('reports/purchaseslist', 'autocomplete="off"'); ?>

                    <div class="row">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <?= lang('item_id', 'item_id'); ?>
                                <?php echo form_input('item_id', (isset($_POST['item_id']) ? $_POST['item_id'] : ''), 'class="form-control number"   id="item_id"'); ?>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <?= lang('item_name', 'item_name'); ?>
                                <?php echo form_input('item_name', (isset($_POST['item_name']) ? $_POST['item_name'] : ''), 'class="form-control number"   id="item_name"'); ?>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="form-group">
                                <?= lang('start_date', 'start_date'); ?>
                                <?php echo form_input('start_date', (isset($_POST['start_date']) ? $_POST['start_date'] : ''), 'class="form-control date"   id="start_date"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <?= lang('end_date', 'end_date'); ?>
                                <?php echo form_input('end_date', (isset($_POST['end_date']) ? $_POST['end_date'] : ''), 'class="form-control date"  id="end_date"'); ?>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="form-group">
                        <div class="controls"> <?php echo form_submit('submit_report', $this->lang->line('submit'), 'class="btn btn-primary"'); ?> </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>
                <div class="clearfix"></div>
                <br>


                <!-- /ppppppp -->
                <div class="row">
                    <h2 style="text-align: center;font-weight: bold;font-family: system-ui;">
                        <p style="font-size: 20px;"> <?= $Settings->site_name ?> </p>
                        <!-- <br> -->
                        <p> <?= $page_title ?> </p>
                        <!-- <br> -->
                        <p>
                            Date Range: <?= $date_range; ?>
                        </p>

                    </h2>
                </div>

                <div class="row col-xs-12">

                    <div class="col-xs-6" style=" text-align: left; ">
                        Print Date: <?= date('d/m/y h:i:sa'); ?>
                    </div>
                    <div class="col-xs-6" style=" text-align: end; ">
                        Printed By: <?= $this->session->userdata('username'); ?>
                    </div>
                </div>
                <!-- /ppppppp -->

                <div>
                    <table id="CusData" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed table-hover table-striped reports-table">
                        <thead>
                            <tr class="primary">
                                <th style=" text-align: left; "><?= lang('Date'); ?></th>
                                <th style=" text-align: left; "><?= lang('reference_no'); ?></th>
                                <th style=" text-align: left; "><?= lang('supplier'); ?></th>
                                <th style=" text-align: left; "><?= lang('product_name'); ?></th>
                                <th style=" text-align: end; "><?= lang('unit_cost'); ?></th>
                                <th style=" text-align: end; "><?= lang('quantity'); ?></th>
                                <th style=" text-align: end; "><?= lang('subtotal'); ?></th>
                                <th style=" text-align: left; "><?= lang('created_by'); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as  $item) : ?>
                                <tr>
                                    <th style=" text-align: left; "><?php echo $item['date']; ?></th>
                                    <td> <a href="<?= admin_url('purchases/modal_view/' . $item['purchase_id'])  ?>" data-toggle="modal" data-target="#myModal"><?php echo $item['reference_no']; ?></a> </td>
                                    <td style=" text-align: left; "><?php echo $item['supplier']; ?></td>
                                    <td style=" text-align: left; "><?php echo $item['product_name']; ?></td>
                                    <td style=" text-align: end; "><?php echo intval($item['unit_cost']); ?></td>
                                    <td style=" text-align: end; "><?php echo intval($item['quantity']); ?></td>
                                    <td style=" text-align: end; "><?php echo intval($item['subtotal']); ?></td>
                                    <td style=" text-align: left; "><?php echo $item['username']; ?></td>


                                </tr>
                            <?php endforeach; ?>

                            <tr>
                                <th colspan="5">Total</th>

                                <td style=" text-align: end; "><?php echo $quantity ?></td>
                                <td style=" text-align: end; "><?php echo $subtotal ?></td>
                                <td></td>

                            </tr>

                        </tbody>
                        <tfoot class="no-print">
                            <tr class="active">
                                <th style=" text-align: left; "><?= lang('Date'); ?></th>
                                <th style=" text-align: left; "><?= lang('reference_no'); ?></th>
                                <th style=" text-align: left; "><?= lang('supplier'); ?></th>
                                <th style=" text-align: left; "><?= lang('product_name'); ?></th>
                                <th style=" text-align: end; "><?= lang('unit_cost'); ?></th>
                                <th style=" text-align: end; "><?= lang('quantity'); ?></th>
                                <th style=" text-align: end; "><?= lang('subtotal'); ?></th>
                                <th style=" text-align: left; "><?= lang('created_by'); ?></th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $assets ?>js/html2canvas.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var selectedCustomer = $('#user').find(":selected").text();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        $('#branch_name').empty();
        if (selectedCustomer != "All") {
            $('#branch_name').empty().append(selectedCustomer);
        }

        if (start_date && end_date) {
            $("#sep").empty().append(" - ");
        }

        $('#pdf').click(function(event) {
            event.preventDefault();
            window.location.href = "<?= admin_url('reports/getCustomers/pdf') ?>";
            return false;
        });
        $('#xls').click(function(event) {
            event.preventDefault();
            window.location.href = "<?= admin_url('reports/getCustomers/0/xls') ?>";
            return false;
        });
        $('#image').click(function(event) {
            event.preventDefault();
            html2canvas($('.box'), {
                onrendered: function(canvas) {
                    openImg(canvas.toDataURL());
                }
            });
            return false;
        });
    });
</script>