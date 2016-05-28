<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= $this->Url->build(('/Dashboard'), true); ?>"><?= __('Dashboard') ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <?= $this->Html->link(__('Designations'), ['action' => 'index']) ?>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><?= __('View Designation') ?></li>
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
                    <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-sm btn-success']); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th><?= __('Parent Designation') ?></th>
                            <td><?= $designation->has('parent_designation') ? $this->Html->link($designation->parent_designation->id, ['controller' => 'Designations', 'action' => 'view', $designation->parent_designation->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Office') ?></th>
                            <td><?= $designation->has('office') ? $this->Html->link($designation->office->name_en, ['controller' => 'Offices', 'action' => 'view', $designation->office->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Office Unit Designation') ?></th>
                            <td>
                                <?php
                                //TODO:: need to add office unit
                                //echo $designation->has('office_unit_designation') ? $this->Html->link($designation->office_unit_designation->id, ['controller' => 'OfficeUnitDesignations', 'action' => 'view', $designation->office_unit_designation->id]) : ''
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Name En') ?></th>
                            <td><?= h($designation->name_en) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Name Bn') ?></th>
                            <td><?= h($designation->name_bn) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($designation->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Level Number') ?></th>
                            <td><?= $this->Number->format($designation->level_number) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Sequence Number') ?></th>
                            <td><?= $this->Number->format($designation->sequence_number) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Post Number') ?></th>
                            <td><?= $this->Number->format($designation->post_number) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Status') ?></th>
                            <td><?= $this->Number->format($designation->status) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created By') ?></th>
                            <td><?= $this->Number->format($designation->created_by) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created Date') ?></th>
                            <td><?= $this->Number->format($designation->created_date) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Updated By') ?></th>
                            <td><?= $this->Number->format($designation->updated_by) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Updated Date') ?></th>
                            <td><?= $this->Number->format($designation->updated_date) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

