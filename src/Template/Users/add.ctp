<?php
use Cake\Core\Configure;

$genders = \Cake\Core\Configure::read('genders');
$religions = \Cake\Core\Configure::read('religions');
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
                    <?= $this->Html->link(__('Back'), ['action' => 'index'],['class'=>'btn btn-sm btn-success']); ?>
                </div>
                
            </div>
            <div class="portlet-body">
                <?= $this->Form->create($user,['type' => 'file', 'class'=>'form-horizontal myForm','novalidate']) ?>
                <div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab"><?= __('Basic')?></a></li>
                        <li><a href="#tab_5_4" data-toggle="tab"><?= __('Designation');?></a></li>
                        <li><a href="#tab_5_9" data-toggle="tab"><?= __('Login Info');?></a></li>
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
                                    echo $this->Form->input('user_basic.date_of_birth',['class'=>'form-control datepicker','type'=>'text']);
                                    echo $this->Form->input('user_basic.place_of_birth',['class'=>'form-control','label'=>__('Place Of Birth')]);
                                    echo $this->Form->input('user_basic.nationality',['class'=>'form-control','label'=>__('Nationality')]);

                                    echo $this->Form->input('user_basic.is_married',['type'=>'checkbox','class'=>'form-control married','label'=>__('Is Married')]);
                                    echo $this->Form->input('user_basic.spouse_name_bn',['class'=>'for_married form-control','readonly'=>'readonly','label'=>__('Spouse Name Bn')]);
                                    echo $this->Form->input('user_basic.spouse_name_en',['class'=>'for_married form-control','readonly'=>'readonly','label'=>__('Spouse Name En')]);
                                    echo $this->Form->input('user_basic.gender',['options'=>$genders,'class'=>'form-control','label'=>__('Gender')]);
                                    echo $this->Form->input('user_basic.religion',['options'=>$religions,'class'=>'form-control','label'=>__('Religion')]);
                                    echo $this->Form->input('user_basic.home_phone',['class'=>'form-control','label'=>__('Home Phone')]);
                                    echo $this->Form->input('user_basic.cell_phone',['class'=>'form-control','label'=>__('Cell Phone')]);
                                    echo $this->Form->input('user_basic.email',['class'=>'form-control','label'=>__('Email')]);
                                    echo $this->Form->input('user_basic.passport_number',['class'=>'form-control','label'=>__('Passport Number')]);
                                    echo $this->Form->input('user_basic.driving_license_number',['class'=>'form-control','label'=>__('Driving License Number')]);
                                    echo $this->Form->input('user_basic.tin_number',['class'=>'form-control','label'=>__('TIN Number')]);
                                    echo $this->Form->input('user_basic.present_address',['type'=>'textarea','rows'=>'2','class'=>'form-control','label'=>__('Present Address')]);
                                    echo $this->Form->input('user_basic.permanent_address',['type'=>'textarea','rows'=>'2','class'=>'form-control','label'=>__('Permanent Address')]);
                                    echo $this->Form->input('picture_name_file',['class'=>'','type'=>'file','label'=>__('Photo')]);
                                    ?>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane" id="tab_5_4">
                            <div class="row " >
                                <div class="designationWrapper">
                                    <div class="col-md-12 designation">
                                        <h3>Office Designation</h3>
                                        <hr/>
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->input('user_designations.0.designation_id',['options'=>$Designations,'empty'=>'Select','class'=>'form-control designation_id','label'=>__('Designation')]);

                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->input('user_designations.0.designation_order',['type'=>'text','options'=>[],'empty'=>'Select','class'=>'form-control','label'=>__('Designation Order')]);
                                            echo $this->Form->input('user_designations.0.starting_date',['type'=>'text','class'=>'form-control datepicker','label'=>__('Starting Date')]);
                                            echo $this->Form->input('user_designations.0.ending_date',['type'=>'text','class'=>'form-control datepicker','label'=>__('Ending Date')]);
                                            echo $this->Form->hidden('user_designations.0.is_basic',['value'=>1]);
                                            ?>
                                        </div>
                                    </div>


                                    <div class="col-md-12 single_list_designation list_designation" data-index_no="1">
                                        <h3>Unit Designation</h3>
                                        <hr/>
                                        <div class="form-group "><span class="btn btn-sm btn-circle btn-danger remove pull-right"><i class="fa fa-close"></i></span></div>
                                        <div class="col-md-6">
                                            <?php

                                            echo $this->Form->input('user_designations.1.office_unit_id',['options'=>$OfficeUnits,'empty'=>'Select','class'=>'form-control office_unit_id','label'=>__('Office Unit')]);
                                            echo $this->Form->input('user_designations.1.designation_id',['options'=>[],'empty'=>'Select','class'=>'form-control office_unit_designation_id','label'=>__('Office Unit Designation')]);

                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->input('user_designations.1.designation_order',['type'=>'text','options'=>[],'empty'=>'Select','class'=>'form-control','label'=>__('Designation Order')]);

                                            echo $this->Form->input('user_designations.1.starting_date',['type'=>'text','class'=>'form-control datepicker','label'=>__('Starting Date')]);
                                            echo $this->Form->input('user_designations.1.ending_date',['type'=>'text','class'=>'form-control datepicker','label'=>__('Ending Date')]);
                                            ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="row col-md-offset-11">
                                <input type="button" class="btn btn-circle green add_more_designation" value="Add" />
                            </div>
                        </div>

                        <div class="tab-pane" id="tab_5_9">
                            <div class="row whiteWrapper loginWrapper">
                                <div class="col-md-6 col-md-offset-2">
                                    <?php
                                    echo $this->Form->input('username',['class'=>'form-control','label'=>__('Username')]);
                                    echo $this->Form->input('password',['class'=>'form-control','label'=>__('Password')]);
                                    echo $this->Form->input('user_group_id', ['options' => $userGroups,'class'=>'form-control','label'=>__('User Group')]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                        <div class="text-center"><?= $this->Form->button(__('Submit'),['class'=>'btn green-seagreen','style'=>'margin:20px 0 10px 0']) ?></div>


                    </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

<script>
    $(document).ready(function(){
        $(document).on('change','.married',function(){
            if($(this).prop('checked'))
            {
                $('.for_married').removeAttr('readonly');
            }
            else
            {
                $('.for_married').attr('readonly','readonly');
            }
        });



        $(document).on("focus",".datepicker", function()
        {
            $(this).removeClass('hasDatepicker').datepicker({
                dateFormat: 'dd-mm-yy'
            });
        });


        // Designation Section Add More & Remove
        $(document).on('click', '.add_more_designation', function () {
            var index = $('.list_designation').data('index_no');
            $('.list_designation').data('index_no', index + 1);
            var html = $('.designationWrapper .col-md-12:last').clone().find('.form-control').each(function () {
                this.name = this.name.replace(/\d+/, index+1);
                this.id = this.id.replace(/\d+/, index+1);
                this.value = '';


                $(this).closest('.single_list_designation').find('.designation_id').closest('.form-group').hide();
                $(this).closest('.single_list_designation').find('.des_div').removeClass('hidden');


                $(this).closest('.single_list_designation').find('.office_unit_id').closest('.form-group').show();
                $(this).closest('.single_list_designation').find('.office_unit_designation_id').closest('.form-group').show();
                $(this).closest('.single_list_designation').find('.des_div').addClass('hidden');
            }).end();

            $('.designationWrapper').append(html);
            $.uniform.update();
        });

        $(document).on('click', '.remove', function () {
            var obj=$(this);
            var count= $('.single_list_designation').length;
            if(count > 1){
                obj.closest('.single_list_designation').remove();
            }
        });



        // Get office unit designations by office unit AJAX (Designation)
        $(document).on('change','.office_unit_id',function()
        {


            var obj = $(this);
            obj.closest('.single_list_designation').find('.office_unit_designation_id').html('<option><?php echo __('Select');?></option>');
            obj.closest('.single_list_designation').find('.designation_id').html('<option><?php echo __('Select');?></option>');

           // var office_id = obj.closest('.single_list_designation').find('.office').val();
            var office_unit_id = obj.val();

            if(office_unit_id>0)
            {
                $.ajax({
                    url: '<?= $this->Url->build('/Users/ajax/get_unit_designation')?>',
                    type: 'POST',
                    data:{office_unit_id:office_unit_id},

                    success: function (data, status)
                    {
                        $.each(JSON.parse(data), function(key, value) {
                            obj.closest('.single_list_designation').find('.office_unit_designation_id').append($("<option></option>").attr("value",key).text(value));
                        });
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
        });


    });
</script>