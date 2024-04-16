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

<div class="modal fade" id="advanceDNS" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Configure Advanced DNS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body">
                <form class="" method="POST" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                    <input type="hidden" name="website" class="web">
                    <input type="hidden" name="DNS" class="dns">
                    <div class="form-group">
            
                        <label> DNS 1</label>
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-globe"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="1.xx.x.xxx" id="dns1" name="dns-1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label> DNS 2</label>
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-globe"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="1.xx.xx.x.x" id="dns2" name="dns-2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label> DNS 3</label>
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-globe"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="dns3" placeholder="1.xxx.xxxx.x.x" name="dns-3">
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="addDNS"><i class="far fa-save"></i> Update</button>
                    <button type="button" class="btn btn-danger m-t-15 waves-effect float-right" data-dismiss="modal"><i class="fas fa-window-close"></i> close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteDNS" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Delete Website</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body">
                <form class="" method="POST" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                    <input type="hidden" name="website" class="web">
                    <input type="hidden" name="DNS" class="dns">
                    
                    <div class="text-center">
                        <h4>Delete Record</h4>

                        <p>Are you sure you want to delete this record?</p>

                    </div>
                    
                    <button type="submit" class="btn btn-danger m-t-15 waves-effect" name="deleteSite"><i class="fas fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-success m-t-15 waves-effect float-right" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="dnsModal" tabindex="-1" role="dialog" aria-labelledby="dnsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dnsModalLabel">DNS Lookup Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="dnsResult">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changeimage">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>Change Display Image</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>" enctype="multipart/form-data">
                    
                        <div class="form-group row">
                            <label for="title" class="ti col-sm control-label">Upload Image</label>
                            <div class="form-group">

                                <div class="col col-md-3">
                                    <img id="output_image"/>	
                                </div>
                            </div>

                            <div class="col-sm">
                                <input type="file" accept="image/*" id="file" name="file" onchange="preview_image(event)" class="form-control-file">
                            </div>
                        </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="icon-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" name="profilepic"><i class="icon-arrow-up"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>