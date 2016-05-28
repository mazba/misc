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

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'] + $associations['HasOne'];
$associationFields = collection($fields)
    ->map(function ($field) use ($immediateAssociations)
    {
        foreach ($immediateAssociations as $alias => $details)
        {
            if ($field === $details['foreignKey'])
            {
                return [$field => $details];
            }
        }
    })
    ->filter()
    ->reduce(function ($fields, $value)
    {
        return $fields + $value;
    }, []);

$groupedFields = collection($fields)
    ->filter(function ($field) use ($schema)
    {
        return $schema->columnType($field) !== 'binary';
    })
    ->groupBy(function ($field) use ($schema, $associationFields)
    {
        $type = $schema->columnType($field);
        if (isset($associationFields[$field]))
        {
            return 'string';
        }
        if (in_array($type, ['integer', 'float', 'decimal', 'biginteger']))
        {
            return 'number';
        }
        if (in_array($type, ['date', 'time', 'datetime', 'timestamp']))
        {
            return 'date';
        }
        return in_array($type, ['text', 'boolean']) ? $type : 'string';
    })
    ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
%>
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
            <?= $this->Html->link(__('<%= $pluralHumanName %>'), ['action' => 'index']) ?>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><?= __('View <%= $singularHumanName %>') ?></li>
    </ul>
</div>


<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-picture-o fa-lg"></i><?= __('<%= $singularHumanName %> Details') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'],['class'=>'btn btn-sm btn-success']); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                        <% if ($groupedFields['string']) : %>
                        <% foreach ($groupedFields['string'] as $field) : %>
                        <% if (isset($associationFields[$field])) :
                                    $details = $associationFields[$field];
                        %>
                                <tr>
                                    <th><?= __('<%= Inflector::humanize($details['property']) %>') ?></th>
                                    <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
                                </tr>
                        <% else : %>
                                <tr>
                                    <th><?= __('<%= Inflector::humanize($field) %>') ?></th>
                                    <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
                                </tr>
                        <% endif; %>
                        <% endforeach; %>
                        <% endif; %>
                        <% if ($groupedFields['number']) : %>
                        <% foreach ($groupedFields['number'] as $field) : %>
                            <% if ($field=='create_by' || $field=='update_by' || $field=='create_date' || $field=='create_time' || $field=='update_date' || $field=='update_time' || $field=='id') : %>
                                <% continue; %>
                            <% endif; %>

                            <% if ($field=='status'): %>

                                <tr>
                                    <th><?= __('<%= Inflector::humanize($field) %>') ?></th>
                                    <td><?= __($status[$<%= $singularVar %>-><%= $field %>]) ?></td>
                                </tr>
                                <% continue; %>
                            <% endif; %>
                                <tr>
                                    <th><?= __('<%= Inflector::humanize($field) %>') ?></th>
                                    <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
                                </tr>
                        <% endforeach; %>
                        <% endif; %>
                        <% if ($groupedFields['date']) : %>
                        <% foreach ($groupedFields['date'] as $field) : %>
                                <tr>
                                    <th><%= "<%= __('" . Inflector::humanize($field) . "') %>" %></th>
                                    <td><?= h($<%= $singularVar %>-><%= $field %>) ?></tr>
                                </tr>
                        <% endforeach; %>
                        <% endif; %>
                        <% if ($groupedFields['boolean']) : %>
                        <% foreach ($groupedFields['boolean'] as $field) : %>
                                <tr>
                                    <th><?= __('<%= Inflector::humanize($field) %>') ?></th>
                                    <td><?= $<%= $singularVar %>-><%= $field %> ? __('Yes') : __('No'); ?></td>
                                 </tr>
                        <% endforeach; %>
                        <% endif; %>
                    </table>
                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

