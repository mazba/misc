<?php
use Cake\Core\Configure;

$genders = \Cake\Core\Configure::read('genders');
$religions = \Cake\Core\Configure::read('religions');
$office_level = \Cake\Core\Configure::read('office_level');
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= $this->Url->build(('/Dashboard'), true); ?>"><?= __('Dashboard') ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <?= $this->Html->link(__('Users'), ['action' => 'index']) ?>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><?= __('New User') ?></li>

    </ul>
</div>


<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-square-o fa-lg"></i><?= __('Add New User') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-sm btn-success']); ?>
                </div>

            </div>
            <div class="portlet-body">
                <?= $this->Form->create($user, ['type' => 'file', 'class' => 'form-horizontal myForm', 'novalidate']) ?>
                <div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab"><?= __('Basic') ?></a></li>
                        <li><a href="#tab_5_9" data-toggle="tab"><?= __('Login Info'); ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                            <div class="row whiteWrapper basicWrapper">
                                <div class="col-md-8 col-md-offset-2">
                                    <?php
                                    echo $this->Form->input('full_name_bn');
                                    echo $this->Form->input('full_name_en');
                                    echo $this->Form->input('user_basic.father_name_bn');
                                    echo $this->Form->input('user_basic.father_name_en');
                                    echo $this->Form->input('user_basic.mother_name_bn');
                                    echo $this->Form->input('user_basic.mother_name_en');
                                    echo $this->Form->input('user_basic.nid');
                                    echo $this->Form->input('user_basic.bin_brn');
                                    echo $this->Form->input('user_basic.date_of_birth', ['class' => 'form-control datepicker', 'type' => 'text']);
                                    echo $this->Form->input('user_basic.place_of_birth', ['class' => 'form-control', 'label' => __('Place Of Birth')]);
                                    echo $this->Form->input('user_basic.nationality', ['class' => 'form-control', 'label' => __('Nationality')]);
                                    echo $this->Form->input('user_basic.is_ethnic', ['type' => 'checkbox', 'class' => 'form-control', 'label' => __('Is Ethnic')]);
                                    echo $this->Form->input('user_basic.is_disable', ['type' => 'checkbox', 'class' => 'form-control', 'label' => __('Is Disable')]);
                                    echo $this->Form->input('user_basic.is_married', ['type' => 'checkbox', 'class' => 'form-control married', 'label' => __('Is Married')]);
                                    echo $this->Form->input('user_basic.spouse_name_bn', ['class' => 'for_married form-control', 'readonly' => 'readonly', 'label' => __('Spouse Name Bn')]);
                                    echo $this->Form->input('user_basic.spouse_name_en', ['class' => 'for_married form-control', 'readonly' => 'readonly', 'label' => __('Spouse Name En')]);
                                    echo $this->Form->input('user_basic.gender', ['options' => $genders, 'class' => 'form-control', 'label' => __('Gender')]);
                                    echo $this->Form->input('user_basic.religion', ['options' => $religions, 'class' => 'form-control', 'label' => __('Religion')]);
                                    echo $this->Form->input('user_basic.home_phone', ['class' => 'form-control', 'label' => __('Home Phone')]);
                                    echo $this->Form->input('user_basic.cell_phone', ['class' => 'form-control', 'label' => __('Cell Phone')]);
                                    echo $this->Form->input('user_basic.email', ['class' => 'form-control', 'label' => __('Email')]);
                                    echo $this->Form->input('user_basic.passport_number', ['class' => 'form-control', 'label' => __('Passport Number')]);
                                    echo $this->Form->input('user_basic.driving_license_number', ['class' => 'form-control', 'label' => __('Driving License Number')]);
                                    echo $this->Form->input('user_basic.tin_number', ['class' => 'form-control', 'label' => __('TIN Number')]);
                                    echo $this->Form->input('user_basic.present_address', ['type' => 'textarea', 'rows' => '2', 'class' => 'form-control', 'label' => __('Present Address')]);
                                    echo $this->Form->input('user_basic.permanent_address', ['type' => 'textarea', 'rows' => '2', 'class' => 'form-control', 'label' => __('Permanent Address')]);
                                    echo $this->Form->input('picture', ['class' => '', 'type' => 'file', 'label' => __('Photo')]);
                                    ?>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane" id="tab_5_9">
                            <div class="row whiteWrapper loginWrapper">
                                <div class="col-md-6 col-md-offset-2">
                                    <?php
                                    $user_group = \Cake\Core\Configure::read('user_group');
                                    $session = $this->request->session();
                                    $user_group_id = $session->read('Auth.User.user_group_id');
                                    if($user_group_id==$user_group['super_admin']) {

                                        echo $this->Form->input('office_level', ['options' => $office_level, 'class' => 'form-control', 'label' => __('office_level'), 'empty' => __('Select')]);
                                        echo "<div id='division'>";
                                        echo $this->Form->input('division_id', ['options' => $divisions, 'empty' => __('Select')]);
                                        echo "</div>";
                                        echo "<div id='district'>";
                                        echo $this->Form->input('district_id', ['empty' => __('Select')]);
                                        echo "</div>";
                                        echo "<div id='upazila'>";
                                        echo $this->Form->input('upazila_id', ['empty' => __('Select')]);
                                        echo "</div>";
                                        echo "<div id='office'>";
                                        echo $this->Form->input('office_id', ['empty' => __('Select')]);
                                        echo "</div>";
                                        echo $this->Form->input('user_group_id', ['options' => $userGroups, 'empty' => __('Select'), 'class' => 'form-control', 'label' => __('User Group')]);

                                    }
                                    else{
                                        echo $this->Form->input('office_id', ['type'=>'hidden','value'=>$session->read('Auth.User.office_id')]);
                                        echo $this->Form->input('user_group_id', ['type'=>'hidden','value'=>$session->read('Auth.User.user_group_id')]);

                                        echo "<br/>";

                                    }
                                    echo $this->Form->input('designation_id', ['options' => $designations, 'empty' => __('Select'),'class' => 'form-control', 'label' => __('User Designation')]);
                                    echo $this->Form->input('username', ['class' => 'form-control', 'label' => __('Username')]);
                                    echo $this->Form->input('password', ['class' => 'form-control', 'label' => __('Password')]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                        <div
                            class="text-center"><?= $this->Form->button(__('Submit'), ['class' => 'btn green-seagreen', 'style' => 'margin:20px 0 10px 0']) ?></div>


                    </div>
                </div>
                <!-- END BORDERED TABLE PORTLET-->
            </div>
        </div>

        <script>
            $(document).ready(function () {

                $('#division').hide();
                $('#district').hide();
                $('#upazila').hide();
                $('#office').hide();

                $(document).on('change', '#office-level', function () {
                    var office_level = $(this).val();
                    if (office_level) {
                        $('#division').show();
                        $('#district').hide();
                        $('#upazila').hide();
                        $('#office').hide();
                    }
                });

                $(document).on('change', '#division-id', function () {
                    var office_level = $('#office-level').val();
                    var division_id = $(this).val();

                    $('#district').hide();
                    $('#upazila').hide();
                    $('#office').hide();
                    if (office_level==1 || office_level==2 ) {
                        $('#office').show();



                        $('#office-id').html('');
                        if (division_id) {
                            $.ajax({
                                url: '<?=$this->Url->build(('/Common/ajax/get_office'), true)?>',
                                type: 'POST',
                                data: {division_id: division_id},
                                success: function (data, status) {
                                    var data = JSON.parse(data);
                                    $('#office-id')
                                        .append("<option value=''><?= __('Select') ?></option>");
                                    $.each(data, function (key, value) {
                                        $('#office-id')
                                            .append($("<option></option>")
                                                .attr("value", key)
                                                .text(value));
                                    });

                                },
                                error: function (xhr, desc, err) {
                                    console.log("error");

                                }
                            });
                        }


                    }else {
                        $('#district').show();
                        $('#district-id').html('');
                        if (division_id) {
                            $.ajax({
                                url: '<?=$this->Url->build(('/Common/ajax/get_zone_district'), true)?>',
                                type: 'POST',
                                data: {division_id: division_id},
                                success: function (data, status) {
                                    var data = JSON.parse(data);
                                    $('#district-id')
                                        .append("<option value=''><?= __('Select') ?></option>");

                                    $.each(data['district'], function (key, value) {
                                        $('#district-id')
                                            .append($("<option></option>")
                                                .attr("value", key)
                                                .text(value));
                                    });

                                },
                                error: function (xhr, desc, err) {
                                    console.log("error");

                                }
                            });
                        }
                    }
                });

                $(document).on('change', '#district-id', function () {
                    var office_level = $('#office-level').val();
                    var division_id = $('#division-id').val();
                    var district_id = $(this).val();
                    $('#upazila').hide();
                    $('#office').hide();

                    if (office_level==3) {
                        $('#office').show();
                        $('#upazila').hide();


                        $('#office-id').html('');
                        if (district_id) {
                            $.ajax({
                                url: '<?=$this->Url->build(('/Common/ajax/get_office'), true)?>',
                                type: 'POST',
                                data: {division_id: division_id,district_id:district_id},
                                success: function (data, status) {
                                    var data = JSON.parse(data);
                                    $('#office-id')
                                        .append("<option value=''><?= __('Select') ?></option>");
                                    console.log(data);
                                    $.each(data, function (key, value) {
                                        $('#office-id')
                                            .append($("<option></option>")
                                                .attr("value", key)
                                                .text(value));
                                    });

                                },
                                error: function (xhr, desc, err) {
                                    console.log("error");

                                }
                            });
                        }


                    }else {
                        $('#district').show();
                        $('#upazila').show();
                        $('#upazila-id').html('');
                        if (district_id) {
                            $.ajax({
                                url: '<?=$this->Url->build(('/Common/ajax/get_upazila'), true)?>',
                                type: 'POST',
                                data: {district_id: district_id},
                                success: function (data, status) {
                                    var data = JSON.parse(data);
                                    $('#upazila-id')
                                        .append("<option value=''><?= __('Select') ?></option>");

                                    $.each(data, function (key, value) {
                                        $('#upazila-id')
                                            .append($("<option></option>")
                                                .attr("value", key)
                                                .text(value));
                                    });

                                },
                                error: function (xhr, desc, err) {
                                    console.log("error");

                                }
                            });
                        }
                    }
                });


                $(document).on('change', '#upazila-id', function () {
                    var office_level = $('#office-level').val();
                    var division_id = $('#division-id').val();
                    var district_id = $('#district-id').val();
                    var upazila_id = $(this).val();

                    if (office_level==4) {
                        $('#office').show();

                        $('#office-id').html('');
                        if (upazila_id) {
                            $.ajax({
                                url: '<?=$this->Url->build(('/Common/ajax/get_office'), true)?>',
                                type: 'POST',
                                data: {division_id: division_id,district_id:district_id,upazila_id:upazila_id},
                                success: function (data, status) {
                                    var data = JSON.parse(data);
                                    $('#office-id')
                                        .append("<option value=''><?= __('Select') ?></option>");
                                    console.log(data);
                                    $.each(data, function (key, value) {
                                        $('#office-id')
                                            .append($("<option></option>")
                                                .attr("value", key)
                                                .text(value));
                                    });

                                },
                                error: function (xhr, desc, err) {
                                    console.log("error");

                                }
                            });
                        }


                    }
                });

                $(document).on('change', '.married', function () {
                    if ($(this).prop('checked')) {
                        $('.for_married').removeAttr('readonly');
                    }
                    else {
                        $('.for_married').attr('readonly', 'readonly');
                    }
                });


                $(document).on("focus", ".datepicker", function () {
                    $(this).removeClass('hasDatepicker').datepicker({
                        dateFormat: 'dd-mm-yy'
                    });
                });


            });
        </script>