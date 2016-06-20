<?php
$status = \Cake\Core\Configure::read('status_options');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box my_box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Accordions with Icons
                </div>

            </div>
            <div class="portlet-body">
                <div class="panel-group accordion" id="accordion3">
                   <?php foreach ($inspectionResult as $result):?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#<?php echo $result->id?>">
                                  Date:  <?php echo date('d-M-Y',$result->actual_inspection_date)?> </a>
                            </h4>
                        </div>
                        <div id="<?php echo $result->id?>" class="panel-collapse collapse">

                            <!--Start body content--->
                            <div class="panel-body" style="height:200px; overflow-y:auto;">
                                <p><?php echo $result->inspection_summary?></p>

                              <?php if($result->inspectionResultFiles)
                              {?>

                                  <p> <?php foreach ($result->inspectionResultFiles as $file) : ?>
                                        <a class="btn blue" href="<?php echo $this->request->webroot."files".DS.'InspectionResults'.DS.$file->file_location; ?>" target="_blank"><?= $file->file_label?></a>
                                      <?php endforeach?></p>

                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>


                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>
