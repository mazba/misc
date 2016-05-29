<?php
use Cake\Core\Configure;

$genders = \Cake\Core\Configure::read('genders');
$religions = \Cake\Core\Configure::read('religions');
$party_typ = Configure::read('party_type');
?>

<style>

</style>
<div class="row">
    <div class="col-md-9" style="border-right: 1px dotted #EDB0AF">
        <?= $this->Form->create($application, ['class' => 'form-horizontal', 'role' => 'form']) ?>
        <div class="row">
            <div class="col-md-6">
                <?php
                echo $this->Form->input('division_id', ['options' => $divisions, 'empty' => __('Select'), 'templates' => ['inputContainer' => '<div id="division" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);

                echo $this->Form->input('district_id', ['empty' => __('Select'), 'templates' => ['inputContainer' => '<div style="display: none" id="district" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);

                echo $this->Form->input('upazila_id', ['empty' => __('Select'), 'templates' => ['inputContainer' => '<div style="display: none" id="upazila" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);

                ?>

                <input type="hidden" name="office_id" class="form-control" id="office-id" readonly="readonly">
            </div>
            <div class="col-md-6">
                <?php
                echo $this->Form->input('office', ['id' => 'office_name', 'type' => 'text', 'readonly', 'templates' => ['inputContainer' => '<div style="display: none" id="office" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('mouja_id', ['empty' => __('Select'), 'templates' => ['inputContainer' => '<div style="display: none" id="mouja" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('khatian_number', ['templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('have_parent', ['type' => 'checkbox', 'class' => 'form-control', 'label' => __('Have Parent')]);

                echo $this->Form->input('parent_id', ['type' => 'text', 'readonly' => 'readonly', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                ?>
            </div>
            <h3>Appellant Information</h3>
            <hr/>
            <div class="col-md-6">
                <?php
                echo $this->Form->input('appellant.0.name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('appellant.0.father_name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('appellant.0.mother_name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('appellant.0.village', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                ?>
            </div>
            <div class="col-md-6">
                <?php
                echo $this->Form->input('appellant.0.mobile', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('appellant.0.phone', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('appellant.0.email', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('appellant.0.type', ['type' => 'hidden', 'value' => $party_typ['appellant']]);
                ?>
                <input type="button" class="btn  green add_more_appellant" value="Add" />
            </div>

            <h3>Defendant Information</h3>
            <hr/>
            <div class="col-md-6">
                <?php
                echo $this->Form->input('defendant.0.name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('defendant.0.father_name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('defendant.0.mother_name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('defendant.0.village', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                ?>
            </div>
            <div class="col-md-6">
                <?php
                echo $this->Form->input('defendant.0.mobile', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('defendant.0.phone', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('defendant.0.email', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                echo $this->Form->input('defendant.0.type', ['type' => 'hidden', 'value' => $party_typ['appellant']]);
                ?>
                <input type="button" class="btn  green add_more_appellant" value="Add" />
            </div>


            <?= $this->Form->button(__('Submit'), ['class' => 'btn blue pull-right', 'style' => 'margin-top:20px']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>

    <div class="col-md-3">
        <div class="form-info">
            <h2><em>Important</em> Information</h2>

            <p>Lorem ipsum dolor ut sit ame dolore adipiscing elit, sed sit nonumy nibh sed euismod ut laoreet dolore
                magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip
                commodo quat.</p>

            <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>

            <button class="btn btn-default" type="button">More details</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

//        $('#district').hide();
//        $('#upazila').hide();
//        $('#office').hide();
//        $('#mouja').hide();


        $(document).on('change', '#division-id', function () {

            $('#district').show();
            $('#upazila').hide();
            $('#office').hide();
            $('#mouja').hide();
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

        });
        $(document).on('change', '#district-id', function () {

            $('#upazila').show();
            $('#office').hide();
            $('#mouja').hide();
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

        });

        $(document).on('change', '#upazila-id', function () {
            var division_id = $('#division-id').val();
            var district_id = $('#district-id').val();
            var upazila_id = $(this).val();

            $('#office').show();
            $('#mouja').show();

            $('#office-id').html('');
            $('#office_name').val('');
            $('#mouja-id').html('');

            if (upazila_id) {
                $.ajax({
                    url: '<?=$this->Url->build(('/Common/ajax/get_mouja_office'), true)?>',
                    type: 'POST',
                    data: {division_id: division_id, district_id: district_id, upazila_id: upazila_id},
                    success: function (data, status) {
                        var data = JSON.parse(data);

                        $.each(data['office'], function (key, value) {
                            $('#office-id').attr("value", key);
                            $('#office_name').val(value);
                        });
                        if (jQuery.isEmptyObject(data['office']) == false) {
                            $('#mouja-id').append("<option value=''><?= __('Select') ?></option>");
                            $.each(data['moujas'], function (key, value) {
                                $('#mouja-id')
                                    .append($("<option></option>")
                                        .attr("value", key)
                                        .text(value));
                            });
                        } else {
                            alert('Sorry!');
                        }

                    },
                    error: function (xhr, desc, err) {
                        console.log("error");

                    }
                });
            }
        });

        $(document).on('change', '#have-parent', function () {

            if ($(this).prop('checked')) {

                $('#parent-id').removeAttr('readonly');
            }
            else {
                $('#parent-id').attr('readonly', 'readonly');
            }
        });
    });
</script>