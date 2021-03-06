<?php
/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/4/2016
 * Time: 2:33 PM
 */
?>

<!-- modal-->
<div id="addModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Adding Word</h3>
            </div>
            <form id="add-word-form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Word</h4>

                            <div id="add_word_error"></div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="word">Word</label>
                                        <input required="required" type="text" class="form-control"
                                               id="word" name="word"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="category">Category</label>
                                        <select id="category" class="form-control" required>
                                            <option value="">Select Category</option>
                                            <option value="Hand Tool">Hand Tool</option>
                                            <option value="Power Tool">Power Tool</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="definition">Definition</label>
                                        <input required="required" type="text" class="form-control"
                                               id="definition" name="definition"/>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div id="myDropzone" class="dropzone">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" value="SUBMIT" class="btn btn-success" id="submit-all">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->