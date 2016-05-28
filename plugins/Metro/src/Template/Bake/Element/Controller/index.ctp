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
%>

/**
* Index method
*
* @return void
*/
public function index()
{
	<% $belongsTo = $this->Bake->aliasExtractor($modelObj, 'BelongsTo'); %>
	<% if ($belongsTo): %>
	$<%= $pluralName %> = $this-><%= $currentModelName %>->find('all', [
	'conditions' =>['<%= $currentModelName %>.status !=' => 99],
	'contain' => [<%= $this->Bake->stringifyList($belongsTo, ['indent' => false]) %>]
	]);
	<% else: %>
	$<%= $pluralName %> = $this-><%= $currentModelName %>->find('all', [
	'conditions' =>['<%= $currentModelName %>.status !=' => 99]
	]);
	<% endif; %>
	$this->set('<%= $pluralName %>', $this->paginate($<%= $pluralName %>) );
	$this->set('_serialize', ['<%= $pluralName %>']);
	}
