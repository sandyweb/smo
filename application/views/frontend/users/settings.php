<div class="user_prof">
    <h4>
        <span>User Profile</span>
    </h4>
    <div class="clear"></div>
    <div style="padding:30px 20px 20px 20px;">
        <?php echo Form::open();?>
            <ul>
                <li>
                    <label>Email</label>
                    <span>
                        <?php echo Form::input('email', $user->email, array("class"=>"input"));?>
                    </span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>First Name</label>
                    <span>
                        <?php echo Form::input('username', $user->username, array("class"=>"input"));?>
                    </span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Last Name</label>
                    <span>
                        <?php echo Form::input('lastname', $user->lastname, array("class"=>"input"));?>
                    </span>
                    <div class="clear"></div>
                </li>
                    
                <li>
                    <label>Password</label>
                    <span>
                        <?php echo Form::password('password', NULL, array("class"=>"input"));?>
                    </span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Confirm Password</label>
                    <span>
                        <?php echo Form::password('password_confirm', NULL, array("class"=>"input"));?>
                    </span>
                    <div class="clear"></div>
                </li>   
                <li>
                <label>Profile Picture</label>
                </li>
                <li>
                    <img style="display:none; width:60px; height:60px;" id="profileImg">	
                    <div class="file" id="addPhotoWrapper">
                       	<span class="addPhoto" id="settingsAddPhotoImage">Add photo</span>
                        <input type="file" accept="image/*" tabindex="7" class="file-input-area" data-req="reqquestion" id="fileUpload" name="fileUpload">
                    </div>
                    <label><em>Recommended 200 x 200px .jpeg .png or .gif</em></label>
                </li>
               
            </ul>
        <?php echo Form::submit('save', __("Save"), array("class"=>"login-btn", "style"=>"height: 26px"));?>
        <?php echo Form::close();?>
    </div>
    <div class="clear"></div>
</div>