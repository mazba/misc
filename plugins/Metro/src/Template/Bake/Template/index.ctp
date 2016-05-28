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
        return !in_array($schema->columnType($field), ['binary', 'text']);
    })
    ->take(7);
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
        <li><?= $this->Html->link(__('<%= $pluralHumanName %>'), ['action' => 'index']) ?></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-alt fa-lg"></i><?= __('<%= $singularHumanName %> List') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('New <%= $singularHumanName %>'), ['action' => 'add'],['class'=>'btn btn-sm btn-primary']); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <% foreach ($fields as $field): %>
                                    <% if (in_array($field, ['create_by', 'create_date','create_time', 'update_by', 'update_date', 'update_time']))
                                    {
                                        continue;
                                    }
                                    elseif (in_array($field, ['id']))
                                    {
                                        %>
                                        <th><?= __('Sl. No.') ?></th>
                                        <%
                                        continue;
                                    }elseif (in_array($field, ['name_en']))
                                    {
                                        %>
                                        <th><?= __('Name Bn') ?></th>
                                        <%
                                        continue;
                                    }
                                    elseif (in_array($field, ['name_bn']))
                                    {
                                        %>
                                        <th><?= __('Name En') ?></th>
                                        <%
                                        continue;
                                    }
                                    else
                                    {

                                        %>
                                        <th><?= __('<%= $field %>') ?></th>
                                    <% } %>
                                <% endforeach; %>
                                <th><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($<%= $pluralVar %> as $key => $<%= $singularVar %>) {  ?>
                                <tr>
                                    <% foreach ($fields as $field) {

                                        if (in_array($field, ['create_by', 'create_date', 'create_time', 'update_by', 'update_date', 'update_time']))
                                        {
                                            continue;
                                        }
                                        if (in_array($field, ['id']))
                                        {
                                           %>
                                                <td><?= $this->Number->format($key+1) ?></td>
                                            <%
                                            continue;
                                        }if (in_array($field, ['status']))
                                        {
                                           %>
                                                <td><?= __($status[$<%= $singularVar %>-><%= $field %>]) ?></td>
                                            <%
                                            continue;
                                        }
                                        $isKey = false;
                                        if (!empty($associations['BelongsTo']))
                                        {
                                            foreach ($associations['BelongsTo'] as $alias => $details)
                                            {
                                                if ($field === $details['foreignKey'])
                                                {
                                                    $isKey = true;
                                                    %>
                                                    <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ?
                                                    $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>
                                                    -><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>',
                                                    'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>
                                                    -><%= $details['primaryKey'][0] %>]) : '' ?></td>
                                                    <%
                                                    break;
                                                }
                                            }
                                        }
                                        if ($isKey !== true)
                                        {
                                            if (substr($field, -5, 5) == '_date')
                                            {
                                                %>
                                                <td><?= $this->System->display_date($<%= $singularVar %>-><%= $field %>) ?></td>
                                            <%
                                            }
                                            elseif (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float']))
                                            {
                                                %>
                                                <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
                                            <%
                                            }
                                            else
                                            {
                                                %>
                                                <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
                                            <%
                                            }
                                        }
                                    }

                                    $pk = '$' . $singularVar . '->' . $primaryKey[0];
                                    %>
                                    <td class="actions">
                                        <?php
                                            echo $this->Html->link(__('View'), ['action' => 'view', <%= $pk %>],['class'=>'btn btn-sm btn-info']);

                                            echo $this->Html->link(__('Edit'), ['action' => 'edit', <%= $pk %>],['class'=>'btn btn-sm btn-warning']);

                                            echo $this->Form->postLink(__('Delete'), ['action' => 'delete', <%= $pk %>],['class'=>'btn btn-sm btn-danger','confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)]);
                                            
                                        ?>

                                    </td>
                                </tr>

                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination">
                       <?php
                       echo $this->Paginator->prev('<<');
                       echo $this->Paginator->numbers();
                       echo $this->Paginator->next('>>');
                       ?>
                   </ul>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

