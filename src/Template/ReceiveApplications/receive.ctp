<?php
use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-coffee"></i><?= __('Reject or Approve Application') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-sm btn-success']) ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="color:#525E51;font-weight:bold;padding-bottom:10px;border-bottom: 1px solid #eee"><?= __('Application Text') ?></h4>
                        <blockquote>
                            <p>
                                <?php echo h($application['application_text']); ?>
                            </p>
                        </blockquote>
                        <?php
                        if (!empty($application['application_files'])):
                            foreach ($application['application_files'] as $file):
                                ?>
                                <?php
                                echo $this->Html->link($file['title'], '/files/ApplicationFiles/' . $file['file_location'], ['class' => 'pull-right todo-username-btn btn btn-circle btn-default btn-xs']);
                                ?>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <div class="col-md-12">
                        <div class="portlet">
                            <div class="portlet-title" style="border-color:#BBD3A5">
                                <div class="caption">
                                    <i style="color:green" class="fa fa-users"></i><?= __('Appellants') ?>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('Appellant Name') ?></th>
                                        <th><?= __('Father Name') ?></th>
                                        <th><?= __('Mother Name') ?></th>
                                        <th><?= __('Village') ?></th>
                                        <th><?= __('Mobile') ?></th>
                                        <th><?= __('Phone') ?></th>
                                        <th><?= __('Email') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    foreach ($application['appellants'] as $appellant):
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?> </td>
                                            <td><?php echo $appellant['name']; ?></td>
                                            <td><?php echo $appellant['father_name']; ?></td>
                                            <td><?php echo $appellant['mother_name']; ?></td>
                                            <td><?php echo $appellant['village']; ?></td>
                                            <td><?php echo $appellant['mobile']; ?></td>
                                            <td><?php echo $appellant['phone']; ?></td>
                                            <td><?php echo $appellant['email']; ?></td>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="portlet">
                            <div class="portlet-title" style="border-color:#F9B3B3">
                                <div class="caption">
                                    <i style="color:red" class="fa fa-users"></i><?= __('Defendants') ?>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('Defendant Name') ?></th>
                                        <th><?= __('Father Name') ?></th>
                                        <th><?= __('Mother Name') ?></th>
                                        <th><?= __('Village') ?></th>
                                        <th><?= __('Mobile') ?></th>
                                        <th><?= __('Phone') ?></th>
                                        <th><?= __('Email') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    foreach ($application['defendants'] as $appellant):
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?> </td>
                                            <td><?php echo $appellant['name']; ?></td>
                                            <td><?php echo $appellant['father_name']; ?></td>
                                            <td><?php echo $appellant['mother_name']; ?></td>
                                            <td><?php echo $appellant['village']; ?></td>
                                            <td><?php echo $appellant['mobile']; ?></td>
                                            <td><?php echo $appellant['phone']; ?></td>
                                            <td><?php echo $appellant['email']; ?></td>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="portlet">
                            <div class="portlet-title" style="border-color:#E7F7AD">
                                <div class="caption">
                                    <i style="color:yellowgreen" class="fa fa-gavel"></i><?= __('Appellant Lawyers') ?>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('Lawyer Name') ?></th>
                                        <th><?= __('Mobile') ?></th>
                                        <th><?= __('Phone') ?></th>
                                        <th><?= __('Email') ?></th>
                                        <th><?= __('Address') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    foreach ($application['lawyers'] as $lawyer):
                                        if($lawyer['party_type'] == Configure::read('lawyers_type')['appellant']):
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?> </td>
                                                <td><?php echo $lawyer['name']; ?></td>
                                                <td><?php echo $lawyer['mobile']; ?></td>
                                                <td><?php echo $lawyer['phone']; ?></td>
                                                <td><?php echo $lawyer['email']; ?></td>
                                                <td><?php echo $lawyer['address']; ?></td>
                                            </tr>
                                            <?php
                                        endif;
                                    endforeach;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="tabbable tabbable-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab" aria-expanded="true">
                                        <?= __('Approve') ?></a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_2" data-toggle="tab" aria-expanded="false">
                                        <?= __('Reject') ?> </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <?= $this->Form->create($application, ['id'=>'form','class' => 'form-horizontal']) ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3"><?= __('Hearing Date') ?></label>
                                            <div class="col-md-4">
                                                <div class="input-group date form_datetime">
                                                    <input type="text" size="16" readonly required name="hearing[hearing_time]" class="form-control">
                                                    <span class="input-group-btn">
                                                    <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </div>
                                        <?php echo $this->Form->input('hearing[location]',['rows'=>1,'type'=>'textarea','required','label'=>__('Hearing Location')]); ?>
                                        <?php echo $this->Form->input('remarks',['required','type'=>'textarea','label'=>__('Remarks'),'rows'=>2,'templates'=>['input' => '<div class="col-sm-4 container_{{name}}"> <input {{attrs}} class="form-control" type="{{type}}" name="{{name}}"></div>']]); ?>
                                        <?php echo $this->Form->input('inspection[check]',['type'=>'checkbox','label'=>__('Send for Inspection'),'templates'=>['input' => '<div class="col-sm-3 container_{{name}}"> <input {{attrs}} class="form-control" type="{{type}}" name="{{name}}"></div>']]); ?>
                                        <div id="inspection_wrp" style="display: none">
                                            <?php echo $this->Form->input('inspection[inspection_date]',['class'=>'form-control datepicker','label'=>__('Inspection Date')]); ?>
                                        </div>
                                        <?= $this->Form->button(__('Approve'), ['class' => 'btn green-seagreen pull-right', 'style' => 'margin:20px 0 10px 0']) ?>
                                    <?= $this->Form->end() ?>
                                </div>
                                <div class="tab-pane" id="tab_1_2">
                                    <?= $this->Form->create($application, ['url'=>['controller'=>'ReceiveApplications','action'=>'reject',$this->request->params['pass'][0]],'id'=>'form','class' => 'form-horizontal']) ?>
                                        <?php echo $this->Form->input('remarks',['required','type'=>'textarea','label'=>__('Remarks'),'rows'=>2,'templates'=>['input' => '<div class="col-sm-4 container_{{name}}"> <input {{attrs}} class="form-control" type="{{type}}" name="{{name}}"></div>']]); ?>
                                        <?= $this->Form->button(__('Reject'), ['id'=>'reject','class' => 'btn red pull-right', 'style' => 'margin:20px 0 10px 0']) ?>
                                    <?= $this->Form->end() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<script>
    $(document).ready(function () {
        $(".form_datetime").datetimepicker({
            autoclose: true,
            isRTL: Metronic.isRTL(),
            format: "dd-MM-yyyy hh:ii",
            pickerPosition: (Metronic.isRTL() ? "bottom-right" : "bottom-left")
        });

        $(document).on('click', '#inspection-check', function () {
            if($(this).is(":checked"))
                $('#inspection_wrp').show();
            else{
                $('#inspection-inspection-date').val('');
                $('#inspection_wrp').hide();
            }
        });
        $(document).on("focus", ".datepicker", function () {
            $(this).removeClass('hasDatepicker').datepicker({
                dateFormat: 'dd-mm-yy'
            });
        });
    });
</script>
