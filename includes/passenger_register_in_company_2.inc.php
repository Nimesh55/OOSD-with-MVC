<div class="container">
    <div class="row">
        <div class="col-lg-3 cyan"></div>
        <div class="col-lg-6 wrapper">
            <form class="form-horizontal" role="form" action="includes/passenger_register_in_company.inc.php"
                  method="post" enctype="multipart/form-data">
                <?php
                if (isset($_POST['error']) && strcmp($_POST['error'], "identified") == 0) {

                    echo "<div class=\"alert alert-danger\"><strong>" . '*Enter the correct Staff Id!!!' . "</strong></div>";
                }
                elseif (isset($_POST['error']) && strcmp($_POST['error'], "noService") == 0) {

                    echo "<div class=\"alert alert-danger\"><strong>" . '*Select a Service!!!' . "</strong></div>";
                }
                ?>
                <div class="form-group">
                    <label for="company" class="col-sm-3 control-label">Company:</label>
                    <div class="col-sm-9">
                        <select name="service_no" id="service" class="form-control">

                            <?php
                            foreach ($services as $service) {

                                echo "<option value=\"{$service['service_no']}\">{$service['name']}</option>";
                            }


                            ?>

                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label for="staff_id" class="col-sm-3 control-label">staff ID:</label>
                    <div class="col-sm-9">
                        <input name="staff_id" type="text" class="form-control" id="staff_id">
                    </div>
                </div>

                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Select a file:</label>
                    <div class="col-sm-9">
<!--                        <input type="file" id="file" class="form-control" name="file"/>-->

                        <div class="input-group">
                            <input type="text" class="form-control" readonly>
                            <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    Browse File <input type="file" id="file" name="file" style="display: none;">
                                </span>
                            </label>
                        </div>

                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">



                    </div>


                </div>

                <br>
                <div class="btn-group btn-group-lg">
                    <input type="submit" class="btn btn-primary btn-lg ctrlbutton" value="Request" name="request">
                    <input type="submit" class="btn btn-primary btn-lg ctrlbutton" value="Back to Home" name="home">
                </div>

            </form>

        </div>
        <div class="col-lg-3 orange"></div>
    </div>
</div>