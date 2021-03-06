<?php
$status = \Cake\Core\Configure::read('status_options');
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
        <li><?= __('View User') ?></li>
    </ul>
</div>


<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-picture-o fa-lg"></i><?= __('User Details') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-sm btn-success']); ?>
                </div>
            </div>

            <div class="portlet-body">


                    <div class="table-scrollable">
                        <div class="col-md-6 col-md-offset-3">
                        <table class="table table-bordered table-hover">

                            <tr>
                                <th><?= __('User Group') ?></th>
                                <td><?= $user->user_group->title_bn ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Full Name Bn') ?></th>
                                <td><?= h($user->full_name_bn) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Full Name En') ?></th>
                                <td><?= h($user->full_name_en) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Username') ?></th>
                                <td><?= h($user->username) ?></td>
                            </tr>




                            <tr>
                                <th><?= __('Status') ?></th>
                                <td><?= __($status[$user->status]) ?></td>
                            </tr>
                        </table>
                        </div>
                    </div>

            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

