<div class="row">
    <div class="col-md-6" style="border-right: 1px dashed #aaa">
        <h1 class="text-center"><?= __('Apply For case') ?></h1>
        <?php
        echo $this->Html->link(
            __('Apply now'),
            ['controller' => 'Citizen', 'action' => 'new_case'],
            ['class' => 'btn btn-success col-md-offset-5']
        );
        ?>
    </div>
    <div class="col-md-6">
        <h1 class="text-center"><?= __('Search for Application Status') ?></h1>
        <?= $this->Form->create(null, ['url'=>['controller'=>'Citizen','action'=>'search'],'class' => 'form-horizontal', 'role' => 'form']) ?>
            <div class="row">
                <div class="col-md-10">
                    <?php echo $this->Form->input('case_id',['label'=> __('Case ID'),'type'=>'text']); ?>
                    <?= $this->Form->button(__('Search'), ['class' => 'btn btn-success   pull-right', 'style' => 'margin-top:20px']) ?>
                </div>
            </div>
        <?= $this->Form->end(); ?>
    </div>
</div>