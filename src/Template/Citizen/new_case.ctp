<div class="row">
    <div class="col-md-9" style="border-right: 1px dotted #EDB0AF">
        <?= $this->Form->create(null, ['class' => 'form-horizontal', 'role' => 'form']) ?>
        <div class="row">
            <div class="col-md-12">
                <?php
                echo $this->Form->input('name');
                echo $this->Form->input('name');
                echo $this->Form->input('name');
                echo $this->Form->input('name');
                echo $this->Form->input('name');
                echo $this->Form->input('name');
                ?>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn blue pull-right', 'style' => 'margin-top:20px']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="col-md-3">
        <div class="form-info">
            <h2><em>Important</em> Information</h2>
            <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip  commodo quat.</p>

            <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>

            <button class="btn btn-default" type="button">More details</button>
        </div>
    </div>
</div>