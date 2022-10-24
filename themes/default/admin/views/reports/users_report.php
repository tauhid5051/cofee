<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>

            <h1 class="modal-title" id="myModalLabel"><?= lang('My Report'); ?></h1>
        </div>

        <?php $expense = 0;
        $total = 0;
        $refund = 0;
        $cash = 0; ?>
        <div class="modal-body">


            <div id="form">

                <?php

                $attributes = array('method' => 'get', 'autocomplete="off"', 'target' => '_blank');
                // echo form_open($this->config->item('mis_api') . 'generateReport.do', $attributes);
                echo admin_form_open('reports/UserWiseCollection',  $attributes);
                echo form_hidden('reportType', 'payment');
                echo form_hidden('branchCode', $warehouse->code);
                echo form_hidden('branchName', $warehouse->name);
                echo form_hidden('branchAddress', $warehouse->address);
                echo form_hidden('paymentreporttype', 'summary');
                echo form_hidden('refund', 'All');
                echo form_hidden('service', 'All');
                echo form_hidden('format', 'pdf');

                ?>
                <div class="row">






                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="user"><?= lang("created_by"); ?></label>
                            <?php
                            $us[""] = lang('select') . ' ' . lang('user');

                            if ($this->Owner ||   $this->Admin)
                                $us["All"] = "All";



                            foreach ($users as $user) {

                                if ($this->Owner ||   $this->Admin) {
                                    $us[$user->id] = $user->first_name . " " . $user->last_name;
                                } elseif ($user->id == $user_id)
                                    $us[$user->id] = $user->first_name . " " . $user->last_name;
                            }


                            echo form_dropdown('createdBy', $us, ($this->Owner ||   $this->Admin ? 'All' :  $user_id), 'class="form-control skip" id="user" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("user") . '"');
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?= lang("start_date", "start_date"); ?>
                            <?php echo form_input('startDate', (isset($_POST['start_date']) ? $_POST['start_date'] : ""), 'class="form-control report_date" required="required" id="start_date" autocomplete="off"'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?= lang("end_date", "end_date"); ?>
                            <?php echo form_input('endDate', (isset($_POST['end_date']) ? $_POST['end_date'] : ""), 'class="form-control report_date" required="required" id="end_date"  autocomplete="off"'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls"> <?php echo form_submit('submit_report', $this->lang->line("submit"), 'class="btn btn-primary"'); ?> </div>
                </div>
                <?php echo form_close(); ?>

            </div>



        </div>
    </div>

</div>

<?= $modal_js ?>