

<div class="modal fade" id="contact" role="dialog"> 
            <div class='modal-dialog'>
                <div class='modal-content'> 
 
		    <form method="post" action="<?php echo $_PATH.'/util/mail.php'; ?>">
			<input type="hidden" name="title" value="contact" >
			<input type="hidden" name="source" value="<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; ?>" >
			<input type="hidden" name="return" value="<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" >
			<input type="hidden" name="callback" value="<?php echo "&some_args"; ?>" >
			<div class='modal-header'>
			    <h4>  <?php echo $modal['m_contact']; ?></h4>
			</div>
			<div class="modal-body">
			    <div class="form-group row">
				<label for="contact-name" class="col-lg-2 col-md-2 col-sm-2 control-label">
				    <?php echo $label['name']; ?>:
				</label>
				<div class="col-lg-10 col-md-10 col-sm-10">
				    <input required type="text" class="form-control" id="contact-name" name='name' placeholder="<?php echo $placeholder['full_name']; ?>">
				</div>


			    </div>
			    <div class="form-group row">
				<label for="contact-subject" class="col-lg-2 col-md-2 col-sm-2 control-label">
				    <?php echo $label['subject']; ?>:
				</label>
				<div class="col-lg-10 col-md-10 col-sm-10">
				    <input required type="text" class="form-control" id="contact-subject" name='subject' placeholder="<?php echo $placeholder['subject']; ?>">
				</div>
			    </div>
			    <div class="form-group row">
				<label for="contact-email" class="col-lg-2 col-md-2 col-sm-2 control-label">
				    <?php echo $label['email']; ?>:
				</label>
				<div class="col-lg-10 col-md-10 col-sm-10">
				    <input required type="text" class="form-control" id="contact-email" name='email' placeholder="<?php echo $placeholder['email']; ?>">
				</div>
			    </div>
			    <div class="form-group row">
				<label for="contact-message" class="col-lg-2 col-md-2 col-sm-2 control-label">
				    <?php echo $label['message']; ?>:
				</label>
				<div class="col-lg-10 col-md-10 col-sm-10">
				    <textarea class="form-control" id="contact-message" name="message" placeholder="<?php echo $placeholder['message']; ?>" rows="8">
				    </textarea>
				</div>
			    </div>
			    <p></p>
			</div>
			<div class="modal-footer">
			    <a class="btn btn-default" data-dismiss="modal" ><?php echo $button['close']; ?></a> 
			    <button type="submit" class="btn btn-group"><?php echo $button['submit']; ?></button>

			</div>
		    </form>

                </div>
            </div>
        </div>