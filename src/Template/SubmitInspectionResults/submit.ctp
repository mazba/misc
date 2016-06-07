<?php
use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-coffee"></i><?= __('Submit inspection Results') ?>
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
                                <?php echo h($inspections->application->application_text); ?>
                            </p>
                        </blockquote>
                        <?php
                        if (!empty($inspections->application->application_files)):
                            foreach ($inspections->application->application_files as $file):
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
                                    foreach ($inspections->application->appellants as $appellant):
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
                                    foreach ($inspections->application->defendants as $appellant):
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
<!--                    <div class="col-md-12">-->
<!--                        <div class="portlet">-->
<!--                            <div class="portlet-title" style="border-color:#E7F7AD">-->
<!--                                <div class="caption">-->
<!--                                    <i style="color:yellowgreen" class="fa fa-gavel"></i>--><?//= __('Appellant Lawyers') ?>
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="portlet-body">-->
<!--                                <table class="table table-bordered table-striped">-->
<!--                                    <thead>-->
<!--                                    <tr>-->
<!--                                        <th>#</th>-->
<!--                                        <th>--><?//= __('Lawyer Name') ?><!--</th>-->
<!--                                        <th>--><?//= __('Mobile') ?><!--</th>-->
<!--                                        <th>--><?//= __('Phone') ?><!--</th>-->
<!--                                        <th>--><?//= __('Email') ?><!--</th>-->
<!--                                        <th>--><?//= __('Address') ?><!--</th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                    --><?php
//                                    $i=1;
//                                    foreach ($inspections->application->lawyers as $lawyer):
//                                        if($lawyer['party_type'] == Configure::read('lawyers_type')['appellant']):
//                                            ?>
<!--                                            <tr>-->
<!--                                                <td>--><?php //echo $i++; ?><!-- </td>-->
<!--                                                <td>--><?php //echo $lawyer['name']; ?><!--</td>-->
<!--                                                <td>--><?php //echo $lawyer['mobile']; ?><!--</td>-->
<!--                                                <td>--><?php //echo $lawyer['phone']; ?><!--</td>-->
<!--                                                <td>--><?php //echo $lawyer['email']; ?><!--</td>-->
<!--                                                <td>--><?php //echo $lawyer['address']; ?><!--</td>-->
<!--                                            </tr>-->
<!--                                            --><?php
//                                        endif;
//                                    endforeach;
//                                    ?>
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="col-md-12">
                        <div class="portlet">
                            <div class="portlet-title" style="border-color:#F9B3B3">
                                <div class="caption">
                                    <i style="color:red" class="fa fa-users"></i><?= __('Remarks of Application') ?>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="accordion1" class="panel-group accordion">
                                    <?php
                                        foreach($inspections->application->application_remarks as $key=>$remark):
                                            ?>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#collapse_<?= $key ?>" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed" aria-expanded="false"><i class="fa fa-comment-o"></i> <?= $remark->user->full_name_bn ?></a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="collapse_<?= $key ?>" aria-expanded="false" style="height: 0px;">
                                                    <div class="panel-body">
                                                        <p>
                                                            <?php echo $remark->remarks; ?>
                                                        </p>
                                                        <span class="pull-right">
                                                            <strong><?= __('Date') ?></strong>: <?php echo date('d-m-Y h:i:s A',$remark->create_time); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->create(null, ['type' => 'file','url'=>['controller'=>'SubmitInspectionResults','action'=>'submit',$this->request->params['pass'][0]],'id'=>'form','class' => 'form-horizontal']) ?>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?= __('Actual Inspection Date') ?></label>
                            <div class="col-md-4">
                                <div class="input-group date form_datetime">
                                    <input type="text" size="16" readonly required name="actual_inspection_date" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->input('inspection_summary',['rows'=>1,'type'=>'textarea','required']); ?>
                        <?php echo $this->Form->input('have_file',['type'=>'checkbox','templates'=>['input' => '<div class="col-sm-3 container_{{name}}"> <input {{attrs}} class="form-control" type="{{type}}" name="{{name}}"></div>']]); ?>
                        <div id="file_wrp" style="display: none">
                            <div class="file_div" data-index_no="0">
                                <div class="form-group input" aria-required="true">
                                    <label for="document-file"
                                           class="mandetory col-sm-3 control-label text-right">ডকুমেন্ট ফাইল</label>
                                    <div class="col-sm-4">
                                        <input id="" class="form-control file_label" type="text" name="file_label[]"  aria-required="true">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="file" name="document_file[]" class="document_file" multiple="multiple" aria-required="true">
                                    </div>
                                    <div class="col-sm-1">
                                        <span class='btn btn-success add_file'><i class="glyphicon glyphicon-plus-sign "></i></span>
                                    </div>
                                    <div class="col-sm-1">
                                        <span class='btn btn-danger remove_file'><i class="glyphicon glyphicon-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->button(__('Approve'), ['class' => 'btn green-seagreen pull-right', 'style' => 'margin:20px 0 10px 0']) ?>
                        <?= $this->Form->end() ?>
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

        $(document).on('click', '#have-file', function () {
            if($(this).is(":checked"))
                $('#file_wrp').show();
            else{
                $('#file_wrp').hide();
            }
        });
        $(document).on('click', '.add_file', function () {
           $('#file_wrp').append($('#file_wrp .file_div:last').clone());
           $('#file_wrp .file_div:last .file_label').val('');
           $('#file_wrp .file_div:last .document_file').val('');
        });
        $(document).on('click', '.remove_file', function () {
            if($('.file_div').length>1)
                $(this).closest('.file_div').remove();
            else
                alert('you can\'t remove all');
    });
        $(document).on("focus", ".datepicker", function () {
            $(this).removeClass('hasDatepicker').datepicker({
                dateFormat: 'dd-mm-yy'
            });
        });
    });
</script>
