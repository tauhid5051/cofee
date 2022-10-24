<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style>
    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff
    }

    .btn-outline-primary:hover {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff
    }

    .btn-outline-primary.focus,
    .btn-outline-primary:focus {
        box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .5)
    }

    .btn-outline-primary.disabled,
    .btn-outline-primary:disabled {
        color: #007bff;
        background-color: transparent
    }

    .btn-outline-primary:not(:disabled):not(.disabled).active,
    .btn-outline-primary:not(:disabled):not(.disabled):active,
    .show>.btn-outline-primary.dropdown-toggle {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff
    }

    .btn-outline-primary:not(:disabled):not(.disabled).active:focus,
    .btn-outline-primary:not(:disabled):not(.disabled):active:focus,
    .show>.btn-outline-primary.dropdown-toggle:focus {
        box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .5)
    }




    .btn-outline-success {
        color: #28a745;
        border-color: #28a745;
    }

    .btn-outline-success:hover {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-outline-success.focus,
    .btn-outline-success:focus {
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5);
    }

    .btn-outline-success.disabled,
    .btn-outline-success:disabled {
        color: #28a745;
        background-color: transparent;
    }

    .btn-outline-success:not(:disabled):not(.disabled).active,
    .btn-outline-success:not(:disabled):not(.disabled):active,
    .show>.btn-outline-success.dropdown-toggle {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-outline-success:not(:disabled):not(.disabled).active:focus,
    .btn-outline-success:not(:disabled):not(.disabled):active:focus,
    .show>.btn-outline-success.dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5);
    }
</style>



<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa fa-th"></i><span class="break"></span><?= lang('Report Dashboard') ?></h2>
    </div>
    <br>

    <h2 class="text-bold">COLLECTION/PAYMENT REPORT:</h2>
    <div class="box-content" style="padding: 0px 0px 0px 20px; ">
        <div class="row">
            <a class="btn  btn-outline-success" data-placement="bottom" data-html="true" href="<?= admin_url('mis_reports/openModal/paymentSummeryReport/paymentsummerysubreport') ?>" data-toggle="modal" data-target="#myModal">
                User Collection
            </a>
            <a class="btn  btn-outline-success" data-placement="bottom" data-html="true" href="<?= admin_url('mis_reports/openModal/paymentSummaryDayReport') ?>" data-toggle="modal" data-target="#myModal">
                Day Wise Collection
            </a>
        </div>

        <div class="clearfix"></div>
    </div>

    <h2 class="text-bold">Sales Report:</h2>
    <div class="box-content" style="padding: 0px 0px 0px 20px; ">
        <div class="row">
            <a href="#" class="btn btn-outline-primary">Report</a>
            <a href="#" class="btn btn-outline-primary">Report</a>
            <a href="#" class="btn btn-outline-primary">Report</a>
            <a href="#" class="btn btn-outline-primary">Report</a>
            <a href="#" class="btn btn-outline-primary">Report</a>

        </div>

        <div class="clearfix"></div>
    </div>


</div>