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
        <li><?= $this->Html->link(__('Designations'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-coffee"></i><?= __('Designation List') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('New Designation'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary']); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th><?= __('id') ?></th>
                            <th><?= __('Parent') ?></th>
                            <th><?= __('Office') ?></th>
                            <th><?= __('Name Bn') ?></th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($designations as $key => $designation) { ?>
                            <tr>
                                <td><?= $this->Number->format($key + 1) ?></td>
                                <td><?= $designation->has('parent_designation') ?
                                        $this->Html->link($designation->parent_designation
                                            ->name_bn, ['controller' => 'Designations',
                                            'action' => 'view', $designation->parent_designation
                                                ->id]) : '' ?></td>
                                <td><?= $designation->has('office') ?
                                        $this->Html->link($designation->office
                                            ->name_en, ['controller' => 'Offices',
                                            'action' => 'view', $designation->office
                                                ->id]) : '' ?></td>
                                <td><?= h($designation->name_bn) ?></td>
                                <td class="actions">
                                    <?php
                                    echo $this->Html->link(__('View'), ['action' => 'view', $designation->id], ['class' => 'btn btn-sm btn-info']);
                                    echo $this->Html->link(__('Edit'), ['action' => 'edit', $designation->id], ['class' => 'btn btn-sm btn-warning']);
                                    echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $designation->id], ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $designation->id)]);
                                    ?>

                                </td>
                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

