<div class="row">
    <div class="col-md-9" style="border-right: 1px dotted #EDB0AF">
        <?= $this->Form->create($application, ['class' => 'form-horizontal', 'role' => 'form']) ?>
        <div class="row">
            <div class="col-md-12">
                <?php
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
                echo $this->Form->input('name');
                ?>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn blue pull-right', 'style' => 'margin-top:20px']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="col-md-3">
        <div class="form-info">
            <h2><em>Important</em> Information</h2>
            <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip  commodo quat.</p>

            <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>

            <button class="btn btn-default" type="button">More details</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#district').hide();
        $('#upazila').hide();
        $('#office').hide();


        $(document).on('change', '#division-id', function () {

                $('#district').show();
                $('#upazila').hide();
                 $('#office').hide();
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



        });
    });
</script>