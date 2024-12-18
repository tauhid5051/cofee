<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i>
            <?= $page_title ?>
        </h2>

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

                <p class="introtext">
                    <?= lang(' '); ?>
                </p>

                <!-- pppp -->
                <div id="form" class="no-print" style=" max-width: 800px; ">

                    <?php echo admin_form_open('reports/itemstock', 'autocomplete="off"'); ?>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <?= lang('product', 'product') ?>
                                <?php
                                $cus[''] = lang('select') . ' ' . lang('product');
                                foreach ($allproducts as $product) {
                                    $cus[$product->id] = $product->name;
                                }
                                echo form_dropdown('product', $cus, ($_POST['product'] ?? ''), 'class="form-control select" id="select_product" placeholder="' . lang('select') . ' ' . lang('product') . '" style="width:100%"')
                                ?>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="form-group">
                                <?= lang('category', 'category') ?>
                                <?php
                                $cat[''] = lang('select') . ' ' . lang('category');
                                foreach ($categories as $category) {
                                    $cat[$category->id] = $category->name;
                                }
                                echo form_dropdown('category', $cat, ($_POST['category'] ?? ''), 'class="form-control select" id="category" placeholder="' . lang('select') . ' ' . lang('category') . '" style="width:100%"')
                                ?>
                            </div>
                        </div>



                        <div class="col-sm-3">
                            <div class="form-group">
                                <?= lang('Date Upto', 'end_date'); ?>
                                <?php echo form_input('end_date', (isset($_POST['end_date']) ? $_POST['end_date'] : ''), 'class="form-control date"  id="end_date"'); ?>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="form-group">
                        <div class="controls">
                            <?php echo form_submit('submit_report', $this->lang->line('submit'), 'class="btn btn-primary"'); ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>
                <div class="clearfix"></div>
                <br>


                <!-- /ppppppp -->
                <div class="row">
                    <h2 style="text-align: center;font-weight: bold;font-family: system-ui;">
                        <p style="font-size: 20px;">
                            <?= $Settings->site_name ?>
                        </p>
                        <!-- <br> -->
                        <p> <?= $page_title ?> </p>
                        <!-- <br> -->
                        <p>
                            Date Upto: <?= $date_range ?? ''; ?>
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
                    <table id="CusData5" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed table-hover table-striped reports-table">
                        <thead>
                            <tr class="primary">
                                <th style=" text-align: left; ">
                                    <?= lang('ID'); ?>
                                </th>
                                <th style=" text-align: left; ">
                                    <?= lang('Code'); ?>
                                </th>
                                <th style=" text-align: left; "><?= lang('Category'); ?></th>
                                <th style=" text-align: left; "><?= lang('Name'); ?></th>
                                <th style=" text-align: end; ">
                                    <?= lang('Purchase quantity'); ?>
                                </th>
                                <th style=" text-align: end; "><?= lang('Sale quantity'); ?></th>
                                <th style=" text-align: end; "><?= lang('Adjustment quantity'); ?></th>
                                <th style=" text-align: end; ">
                                    <?= lang('Stock quantity'); ?>
                                </th>
                                <th style=" text-align: end; ">
                                    <?= lang('Cost Price'); ?>
                                </th>
                                <th style=" text-align: end; ">
                                    <?= lang('Stock Price'); ?>
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (isset($records)) {
                                $stockPrice = 0;
                            ?>

                                <?php foreach ($records as $item) :
                                    $stock1 = intval($item['purchase'] + $item['adjust'] - $item['sale']);

                                    $stockPrice += intval($item['cost'] *  $stock1);

                                ?>
                                    <tr>
                                        <th style=" text-align: left; "><?php echo $item['product_id']; ?></th>
                                        <th style=" text-align: left; "><?php echo $item['code']; ?></th>
                                        <td style=" text-align: left; ">
                                            <?php echo $item['category_name']; ?>
                                        </td>
                                        <td style=" text-align: left; ">
                                            <?php echo $item['name']; ?>
                                        </td>
                                        <td style=" text-align: end; "><?php echo intval($item['purchase']); ?></td>
                                        <td style=" text-align: end; ">
                                            <?php echo intval($item['sale']); ?>
                                        </td>
                                        <td style=" text-align: end; ">
                                            <?php echo intval($item['adjust']); ?>
                                        </td>
                                        <td style=" text-align: end; "><?php echo $stock1; ?></td>

                                        <td style=" text-align: end; ">
                                            <?php echo intval($item['cost']); ?>
                                        </td>
                                        <td style=" text-align: end; ">
                                            <?php echo  intval($item['cost'] *  $stock1); ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>

                                <tr>
                                    <th colspan="4">Total</th>

                                    <th style=" text-align: end; ">
                                        <?php echo $purchasetotal ?>
                                    </th>
                                    <th style=" text-align: end; "><?php echo $saletotal ?></th>
                                    <th style=" text-align: end; "><?php echo $adjusttotal ?></th>
                                    <th style=" text-align: end; ">
                                        <?php echo $purchasetotal - $saletotal ?>
                                    </th>
                                    <th></th>
                                    <th style=" text-align: end; "><?php echo $stockPrice ?></th>

                                </tr>

                            <?php } ?>

                        </tbody>
                        <tfoot class="no-print">
                            <tr class="active">

                                <th style=" text-align: left; ">
                                    <?= lang('ID'); ?>
                                </th>
                                <th style=" text-align: left; ">
                                    <?= lang('Code'); ?>
                                </th>
                                <th style=" text-align: left; "><?= lang('Category'); ?></th>
                                <th style=" text-align: left; "><?= lang('Name'); ?></th>
                                <th style=" text-align: end; ">
                                    <?= lang('purchase'); ?>
                                </th>
                                <th style=" text-align: end; "><?= lang('sale quantity'); ?></th>
                                <th style=" text-align: end; "><?= lang('Adjust quantity'); ?></th>
                                <th style=" text-align: end; ">
                                    <?= lang('Stock quantity'); ?>
                                </th>
                                <th style=" text-align: end; ">
                                    <?= lang('Cost Price'); ?>
                                </th>
                                <th style=" text-align: end; ">
                                    <?= lang('Stock Price'); ?>
                                </th>

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