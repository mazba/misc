<?php
$status = \Cake\Core\Configure::read('status');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-suitcase"></i>
                    <?php echo __('Offices'); ?> <?= $this->Html->link(__('New Office'), ['action' => 'add'],['class'=>'btn btn-sm btn-warning']) ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo __('Name English'); ?></th>
                            <th><?php echo __('Name Bangla'); ?></th>
                            <th><?php echo __('Parent Office'); ?></th>
                            <th><?php echo __('Office Level'); ?></th>
                            <th><?php echo __('Division'); ?></th>
                            <th><?php echo __('District'); ?></th>
                            <th><?php echo __('Upazila'); ?></th>
                            <th><?php echo __('Zone'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach ($offices as $office){
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= h($office->name_en) ?></td>
                                <td><?= h($office->name_bn) ?></td>
                                <td><?= $office->has('parent_office') ? h($office->parent_office->name_en):'' ?></td>
                                <td><?= $office->has('area_division') ? h($office->area_division->name_bn) : '' ?></td>
                                <td><?= $office->has('area_district') ? h($office->area_district->name_bn) : '' ?></td>
                                <td><?= $office->has('area_upazila') ? h($office->area_upazila->name_bn) : '' ?></td>
                                <td><?= $office->has('area_zone') ? h($office->area_zone->name_bn) : '' ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $office->id],['class'=>'btn btn-sm btn-info']) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $office->id],['class'=>'btn btn-sm btn-warning']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $office->id],['class'=>'btn btn-sm btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $office->id)]) ?>
                                </td>
                            </tr>
                            <?php
                        }
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