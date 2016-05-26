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
                    <table class="table table-borderd">
                        <tr>
                            <th><?= __('Parent Office') ?></th>
                            <td><?= $office->has('parent_office') ? $this->Html->link($office->parent_office->name_bn, ['controller' => 'Offices', 'action' => 'view', $office->parent_office->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Code') ?></th>
                            <td><?= h($office->code) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Office Level') ?></th>
                            <td><?= $office->has('office_level') ? $this->Html->link($office->office_level->name_bn, ['controller' => 'OfficeLevels', 'action' => 'view', $office->office_level->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Name Bn') ?></th>
                            <td><?= h($office->name_bn) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Name En') ?></th>
                            <td><?= h($office->name_en) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Short Name Bn') ?></th>
                            <td><?= h($office->short_name_bn) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Short Name En') ?></th>
                            <td><?= h($office->short_name_en) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Digital Nothi Code') ?></th>
                            <td><?= h($office->digital_nothi_code) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Reference Code') ?></th>
                            <td><?= h($office->reference_code) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Area Division') ?></th>
                            <td><?= $office->has('area_division') ? $this->Html->link($office->area_division->name_bn, ['controller' => 'AreaDivisions', 'action' => 'view', $office->area_division->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Area Zone') ?></th>
                            <td><?= $office->has('area_zone') ? $this->Html->link($office->area_zone->name_bn, ['controller' => 'AreaZones', 'action' => 'view', $office->area_zone->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Area District') ?></th>
                            <td><?= $office->has('area_district') ? $this->Html->link($office->area_district->name_bn, ['controller' => 'AreaDistricts', 'action' => 'view', $office->area_district->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Area Upazila') ?></th>
                            <td><?= $office->has('area_upazila') ? $this->Html->link($office->area_upazila->name_bn, ['controller' => 'AreaUpazilas', 'action' => 'view', $office->area_upazila->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Phone') ?></th>
                            <td><?= h($office->phone) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Mobile') ?></th>
                            <td><?= h($office->mobile) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Fax') ?></th>
                            <td><?= h($office->fax) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <td><?= h($office->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Web Url') ?></th>
                            <td><?= h($office->web_url) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($office->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Status') ?></th>
                            <td><?= $this->Number->format($office->status) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Create Time') ?></th>
                            <td><?= $this->Number->format($office->create_time) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Update Time') ?></th>
                            <td><?= $this->Number->format($office->update_time) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Create By') ?></th>
                            <td><?= $this->Number->format($office->create_by) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Update By') ?></th>
                            <td><?= $this->Number->format($office->update_by) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Address') ?></th>
                            <td><?= $this->Text->autoParagraph(h($office->address)); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Description') ?></th>
                            <td> <?= $this->Text->autoParagraph(h($office->description)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>
