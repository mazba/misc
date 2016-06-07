<script src="<?= $this->request->webroot; ?>assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<?php
use Cake\Core\Configure;

$genders = \Cake\Core\Configure::read('genders');
$religions = \Cake\Core\Configure::read('religions');
$party_typ = Configure::read('party_type');
$lawyers_type = Configure::read('lawyers_type');
?>

<style>

</style>
<div class="row">
    <div class="col-md-9" style="border-right: 1px dotted #EDB0AF">
        <?= $this->Form->create($application, ['type' => 'file','class' => 'form-horizontal', 'role' => 'form']) ?>
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

            <div class="col-md-12">
                <div class="form-group input file required" aria-required="true">
                    <label for="document-file"
                           class="mandetory col-sm-2 control-label text-right"><?= __('application_text') ?></label>

                    <div class="col-sm-10 container_file_label[]">
                        <textarea class="form-control editor1" name="application_text" rows="6" id=""
                                  required></textarea>
                    </div>
                </div>
            </div>

        </div><!--End row-->
        <br/>
        <div id="file_wrapper" class="file_wrapper" class="" data-index_no="0">
            <div class="file_container">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('application_files.0.title', ['id' => '', 'type' => 'text']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('application_files.0.file_location', ['id' => '', 'type' =>'file','class'=>'form-control']);
                        ?>
                    </div>
                    <div class="col-md-4 col-md-offset-10">
                        <input type="button" class="btn add_file green " value="Add"/>
                        <input type="button" class="btn remove_file btn-danger" value="Remove"/>
                    </div>
                </div>
            </div>
        </div>


        <div id="appellant_wrapper" class="" data-index_no="0">
            <div class="appellant">
                <div class="row">
                    <h3>Appellant Information</h3>
                    <hr/>
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('appellants.0.name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('appellants.0.father_name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('appellants.0.mother_name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('appellants.0.village', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('appellants.0.mobile', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('appellants.0.phone', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('appellants.0.email', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('appellants.0.type', ['type' => 'hidden', 'value' => $party_typ['appellant']]);
                        ?>

                    </div>
                    <div class="col-md-4 col-md-offset-10">
                        <input type="button" class="btn add_appellant green " value="Add"/>
                        <input type="button" class="btn remove_appellant btn-danger" value="Remove"/>
                    </div>
                </div><!--End Row-->
            </div><!--End appellant-->
        </div><!--End appellant_wrapper-->

        <div id="defendant_wrapper" data-index_no="0">
            <div class="defendant">
                <div class="row">
                    <h3>Defendant Information</h3>
                    <hr/>

                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('defendants.0.name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('defendants.0.father_name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('defendants.0.mother_name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('defendants.0.village', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('defendants.0.mobile', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('defendants.0.phone', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('defendants.0.email', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('defendants.0.type', ['type' => 'hidden', 'value' => $party_typ['appellant']]);
                        ?>

                    </div>

                    <div class="col-md-4 col-md-offset-10">
                        <input type="button" class="btn add_defendant green " value="Add"/>
                        <input type="button" class="btn remove_defendant btn-danger" value="Remove"/>
                    </div>
                </div><!--End row-->
            </div><!--defendant-->
        </div><!--defendant_wrapper-->


        <div id="lawyers_wrapper" data-index_no="0"><!---Start of lawyers part--->
            <div class="lawyer">
                <div class="row">
                    <h3>Lawyer Information</h3>
                    <hr/>

                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('lawyers.0.name', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('lawyers.0.address', ['type' => 'textarea', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('lawyers.0.okalotnama_file', ['type' => 'file', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);

                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('lawyers.0.mobile', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('lawyers.0.phone', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('lawyers.0.email', ['type' => 'text', 'templates' => ['inputContainer' => '<div id="" class="common form-group input {{type}}{{required}}">{{content}}</div>']]);
                        echo $this->Form->input('lawyers.0.party_type', ['type' => 'hidden', 'value' => $lawyers_type['appellant']]);
                        ?>

                    </div>

                    <div class="col-md-4 col-md-offset-10">
                        <input type="button" class="btn add_lawyer green " value="Add"/>
                        <input type="button" class="btn remove_lawyer btn-danger" value="Remove"/>
                    </div>
                </div><!--End row-->
            </div><!--lawyer-->
        </div><!--lawyers_wrapper-->

        <?= $this->Form->button(__('Submit'), ['class' => 'btn blue pull-right', 'style' => 'margin-top:20px']) ?>

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

    CKEDITOR.replace('application_text');

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

        //For add new appellant option
        $(document).on('click', '.add_appellant', function () {
            var qq = $('#appellant_wrapper').attr('data-index_no');
            var index = parseInt(qq);

            $('#appellant_wrapper').attr('data-index_no', index + 1);

            var html = $('.appellant:last').clone().find('.form-control').each(function () {
                this.name = this.name.replace(/\d+/, index + 1);
                this.id = this.id.replace(/\d+/, index + 1);
                this.value = '';
            }).end();
            $('#appellant_wrapper').append(html);
        });
        // Remove Appellant
        $(document).on('click', '.remove_appellant', function () {
            var obj = $(this);
            var count = $('.appellant').length;
            if (count > 1) {
                obj.closest('.appellant').remove();
            }
        });

        //For add new Defendant option
        $(document).on('click', '.add_defendant', function () {

            var qq = $('#defendant_wrapper').attr('data-index_no');
            var index = parseInt(qq);

            $('#defendant_wrapper').attr('data-index_no', index + 1);

            var html = $('.defendant:last').clone().find('.form-control').each(function () {
                this.name = this.name.replace(/\d+/, index + 1);
                this.id = this.id.replace(/\d+/, index + 1);
                this.value = '';
            }).end();
            $('#defendant_wrapper').append(html);
        });
        // Remove Defendant
        $(document).on('click', '.remove_defendant', function () {
            var obj = $(this);
            var count = $('.defendant').length;
            if (count > 1) {
                obj.closest('.defendant').remove();
            }
        });


        //For add new lawyer option
        $(document).on('click', '.add_lawyer', function () {

            var qq = $('#lawyers_wrapper').attr('data-index_no');
            var index = parseInt(qq);

            $('#lawyers_wrapper').attr('data-index_no', index + 1);

            var html = $('.lawyer:last').clone().find('.form-control').each(function () {
                this.name = this.name.replace(/\d+/, index + 1);
                this.id = this.id.replace(/\d+/, index + 1);
                this.value = '';
            }).end();
            $('#lawyers_wrapper').append(html);
        });
        // Remove lawyer
        $(document).on('click', '.remove_lawyer', function () {
            var obj = $(this);
            var count = $('.lawyer').length;
            if (count > 1) {
                obj.closest('.lawyer').remove();
            }
        });

        //For add new file option
        $(document).on('click', '.add_file', function () {

            var qq = $('#file_wrapper').attr('data-index_no');
            var index = parseInt(qq);

            $('#file_wrapper').attr('data-index_no', index + 1);

            var html = $('.file_container:last').clone().find('.form-control').each(function () {
                this.name = this.name.replace(/\d+/, index + 1);
                this.id = this.id.replace(/\d+/, index + 1);
                this.value = '';
            }).end();
            $('#file_wrapper').append(html);
        });
        // Remove lawyer
        $(document).on('click', '.remove_file', function () {
            var obj = $(this);
            var count = $('.file_container').length;
            if (count > 1) {
                obj.closest('.file_container').remove();
            }
        });


//        $(document).on('click', '.remove_file', function () {
//            var obj = $(this);
//            var count = $('.file_div').length;
//            if (count > 1) {
//                obj.closest('.file_div').remove();
//            }
//        });

    });
</script>