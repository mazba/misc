<?php
$status = \Cake\Core\Configure::read('status_options');
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