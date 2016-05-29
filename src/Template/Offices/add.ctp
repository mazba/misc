<?php
use Cake\Core\Configure;

$status = Configure::read('status_options');
$office_types = Configure::read('office_level');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-suitcase"></i><?php echo __('Add Office'); ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-sm btn-success']) ?>
                </div>
            </div>
            <div class="portlet-body">
                <?= $this->Form->create($office, ['class' => 'form-horizontal']) ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('name_bn');
                        echo $this->Form->input('name_en');
                        echo $this->Form->input('code');
                        echo $this->Form->input('phone');
                        echo $this->Form->input('mobile');
                        echo $this->Form->input('fax');
                        echo $this->Form->input('email');
                        echo $this->Form->input('web_url');
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('parent_id', ['options' => $parentOffices, 'empty' => __('Select')]);
                        echo $this->Form->input('office_types', ['options' => $office_types, 'empty' => __('Select')]);

                        echo "<div id='division'>";
                        echo $this->Form->input('division_id', ['options' => $divisions, 'empty' => __('Select')]);
                        echo "</div>";

                        echo "<div id='district'>";
                        echo $this->Form->input('district_id', ['empty' => __('Select')]);
                        echo "</div>";

                        echo "<div id='upazila'>";
                        echo $this->Form->input('upazila_id', ['empty' => __('Select')]);
                        echo "</div>";

                        echo $this->Form->input('address');
                        echo $this->Form->input('description');
                        echo $this->Form->input('status', ['options' => $status]);
                        ?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn blue pull-right', 'style' => 'margin-top:20px']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
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

        $(document).on('change', '#office-types', function () {
            var office_type = $(this).val();

            if (office_type) {
                $('#division').show();
                $('#district').hide();
                $('#upazila').hide();
            }
        });

        $(document).on('change', '#division-id', function () {
            var office_type = $('#office-types').val();

            if (office_type > 2) {
                $('#district').show();
                $('#upazila').hide();
                var division_id = $(this).val();
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
            var office_type = $('#office-types').val();
            if (office_type > 3) {
                $('#upazila').show();
                var district_id = $(this).val();
                $('#upazila-id').html('');
                if (district_id) {
                    $.ajax({
                        url: '<?=$this->Url->build(('/Common/ajax/get_upazila'), true)?>',
                        type: 'POST',
                        data: {district_id: district_id},
                        success: function (data, status) {
                            var data = JSON.parse(data);
                            console.log(data)
                            $('#upazila-id').append("<option value=''><?= __('Select') ?></option>");
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
    });
</script>