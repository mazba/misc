<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function ($field) use ($schema)
    {
        return $schema->columnType($field) !== 'binary';
    });
$pk = "\$$singularVar->{$primaryKey[0]}";
%>
<?php
use Cake\Core\Configure;
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= $this->Url->build(('/Dashboard'), true); ?>"><?= __('Dashboard') ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <?= $this->Html->link(__('<%= $pluralHumanName %>'), ['action' => 'index']) ?>
            <i class="fa fa-angle-right"></i>
        </li>
        <% if (strpos($action, 'add') === false): %>
            <li><?= __('Edit <%= $singularHumanName %>') ?></li>
        <% else: %>
            <li><?= __('New <%= $singularHumanName %>') ?></li>
        <% endif; %>

    </ul>
</div>


<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                <% if (strpos($action, 'add') === false): %>
                    <i class="fa fa-pencil-square-o fa-lg"></i><?= __('Edit <%= $singularHumanName %>') ?>
                <% else: %>
                    <i class="fa fa-plus-square-o fa-lg"></i><?= __('Add New <%= $singularHumanName %>') ?>
                <% endif; %>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'],['class'=>'btn btn-sm btn-success']); ?>
                </div>
                
            </div>
            <div class="portlet-body">
                <?= $this->Form->create($<%= $singularVar %>,['class' => 'form-horizontal','role'=>'form']) ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php
                            <%
                            foreach ($fields as $field)
                            {
                                if (in_array($field, $primaryKey))
                                {
                                    continue;
                                }
                                if (in_array($field, ['create_by', 'create_date','create_time', 'update_by', 'update_date', 'update_time']))
                                {
                                    continue;
                                }
                                if (in_array($field, ['status']))
                                {
                            %>
                                    echo $this->Form->input('<%= $field %>', ['options' => Configure::read('status_options')]);
                            <%
                                    continue;
                                }
                                
                                if (isset($keyFields[$field]))
                                {
                                    $fieldData = $schema->column($field);
                                    if (!empty($fieldData['null']))
                                    {
                            %>
                                        echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'empty' => __('Select')]);
                            <%
                                    }
                                    else
                                    {
                            %>
                                        echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'empty' => __('Select')]);
                            <%
                                    }
                                    continue;
                                }
                                if (!in_array($field, ['created', 'modified', 'updated']))
                                {
                                    $fieldData = $schema->column($field);
                                    if (($fieldData['type'] === 'date') && (!empty($fieldData['null'])))
                                    {
                            %>
                                        echo $this->Form->input('<%= $field %>', array('empty' => true, 'default' => ''));
                            <%
                                    }
                                    else
                                    {
                            %>
                                        echo $this->Form->input('<%= $field %>');
                            <%
                                    }
                                }
                            }
                            %>
                        ?>
                        <?= $this->Form->button(__('Submit'),['class'=>'btn blue pull-right','style'=>'margin-top:20px']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

