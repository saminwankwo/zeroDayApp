<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add a website</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body">
                <form class="" method="POST" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                    <div class="form-group">
                        <label>New Website</label>
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-globe"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="www.mydomain.com" name="site">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="addSite"><i class="far fa-save"></i> Save</button>
                    <button type="button" class="btn btn-danger m-t-15 waves-effect float-right" data-dismiss="modal"><i class="fas fa-window-close"></i> close</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php echo 'one of this'?>