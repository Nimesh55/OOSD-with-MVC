<div class="container">
    <div class="row">
        <div class="col-lg-3 cyan"></div>
        <div class="col-lg-6 wrapper">
            <form class="form-horizontal" role="form" action="includes/passenger_register_in_company.inc.php" method="post">

                <div class="form-group">
                    <label for="pass_status" class="col-sm-3 control-label">Passenger Status:</label>
                    <div class="col-sm-9">
                        <input name="pass_status" type="text" class="form-control" id="pass_status" readonly value="<?php echo $state_name; ?>
                        ">
                    </div>
                </div>

                <div class="form-group">
                    <label for="company" class="col-sm-3 control-label">Company:</label>
                    <div class="col-sm-9">
                        <input name="company" type="text" class="form-control" id="company" readonly value="<?php echo $service_name; ?>
                        ">
                    </div>
                </div>

                <div class="form-group">
                    <label for="staff_id" class="col-sm-3 control-label">Staff ID:</label>
                    <div class="col-sm-9">
                        <input name="staff_id" type="text" class="form-control" id="staff_id" readonly value="<?php echo $staff_id; ?>
                        ">
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label for="view" class="col-sm-3 control-label">View File:</label>
                    <div class="col-sm-9">
                        <?php
                        if($passenger_file==null):
                            ?>
                            <input name="view" type="text" class="form-control" id="staff_id" readonly value="No file added">
                        <?php
                        else:
                            ?>
                            <input name="view" type="text" class="form-control" id="staff_id" readonly value="<?= $passenger_file['name'] ?>">
                            <button class="alert-success"><a href="includes/download.inc.php?name=<?php echo $passenger_file['name'];?>
                                                            &fname=<?php echo $passenger_file['fname'] ?>">Download</a></button>
                        <?php
                        endif;
                        ?>

                    </div>
                </div>
                <br>

                <input type="submit" class="btn btn-primary btn-lg" value="Remove" name="remove">

            </form>

        </div>
        <div class="col-lg-3 orange"></div>
    </div>
</div>