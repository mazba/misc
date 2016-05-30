<?php
$status = \Cake\Core\Configure::read('status_options');
echo '<pre>';
print_r($this->My->encodeString(1));
echo '</pre>';
die;
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box my_box">
            <div class="portlet-title">
                <div class="caption">
                    <i style="color: #21ED94" class="fa fa-file-pdf-o"></i><?= __('Receive Applications') ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= __('Applicants Name') ?></th>
                                <th><?= __('Upazila') ?></th>
                                <th><?= __('Mouja') ?></th>
                                <th><?= __('Khatian Number') ?></th>
                                <th><?= __('Application Time') ?></th>
                                <th><?= __('Action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $k=0;
                            foreach ($applications as $application):
                            ?>
                            <tr>
                                <td><?php echo ++$k; ?></td>
                                <td>
                                    <?php
                                    foreach($application->appellants as $appellants)
                                        echo ' <i class="fa fa-caret-right"></i> '.$appellants->name;
                                    ?>
                                </td>
                                <td><?php echo $application->upazila->name_bd; ?></td>
                                <td><?php echo $application->mouja->name_bd; ?></td>
                                <td><?php echo $application->khatian_number; ?></td>
                                <td><?php echo $application->formatted_case_create_time; ?></td>
                                <td>
                                    <?php
                                    echo $this->Html->link(__('Approve/Reject'), ['action' => 'receive', urlencode($this->My->encodeString($appellants->id))], ['class' => 'btn btn-sm btn-warning']);
                                    ?>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination">
                    <?php
                    echo $this->Paginator->prev(' << ');
                    echo $this->Paginator->numbers();
                    echo $this->Paginator->next(' >>');
                    ?>
                </ul>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>