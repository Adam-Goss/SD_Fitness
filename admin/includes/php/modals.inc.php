<?php
# modals to be included

?>
<!-- modals -->
  <!-- add blog page modal-->
  <div class="modal fade" id="addBlogPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="#">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Blog Page</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" placeholder="Page Title">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="editor1" class="form-control" placeholder="Description"></textarea>
            </div>
            <div class="form-group">
              <label>Content</label>
              <textarea name="editor2" class="form-control" placeholder="Content"></textarea>
            </div>
            <div class="form-group">
              <label>Image File</label>
              <?php
              //ADD PHP FOR IMAGE FILE UPLOAD
              ?>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Published
              </label>
            </div>
            <div class="form-group">
              <label>Meta Tags</label>
              <input type="text" class="form-control" placeholder="Add Some Tags...">
            </div>
            <div class="form-group">
              <label>Meta Description</label>
              <input type="text" class="form-control" placeholder="Add Meta Description...">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END OF ADD BLOG PAGE MODAL -->
  <!-- add user modal-->
  <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="#">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add User</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Type</label>
              <select class="" name="user_type">
                <option value="member">Member</option>
                <option value="admin">Admin</option>
              </select>
            </div>
            <div class="form-group">
              <label>First Name</label>
              <input type="text" name="first_name" class="form-control" placeholder="First Name">
            </div>
            <div class="form-group">
              <label>Second Name</label>
              <input type="text" name="second_name" class="form-control" placeholder="Second Name">
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" name="email" class="form-control" placeholder="Email Address">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="pass1" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" name="pass2" class="form-control" placeholder="Confirm Password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add User</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END OF ADD USER MODAL -->
  <!-- add product module -->
  <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="#">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Product</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" placeholder="Page Title">
            </div>
            <div class="form-group">
              <label>Category</label>
              <?php
                //ADD PHP FOR DROP DOWN CATEGORIES
              ?>
              <select class="" name="category">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div class="form-group">
              <label>Gender</label>
              <select class="" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div class="form-group">
              <label>Age Group</label>
              <select class="" name="age_group">
                <option value="all">All</option>
                <option value="youth">Youth</option>
                <option value="junior">Junior</option>
                <option value="pro">Pro</option>
              </select>
            </div>
            <div class="form-group">
              <label>Volume</label>
              <input type="number" name="volume" value="" placeholder="Volume">
            </div>
            <div class="form-group">
              <label>Season</label>
              <input type="number" name="season" value="" placeholder="Season">
            </div>
          </div>
            <div class="form-group">
              <label>Short Description</label>
              <textarea name="editor1" class="form-control" placeholder="Short Description"></textarea>
            </div>
            <div class="form-group">
              <label>Long Description</label>
              <textarea name="editor2" class="form-control" placeholder="Long Description"></textarea>
            </div>
            <div class="form-group">
              <label>Product Content</label>
              <textarea name="editor3" class="form-control" placeholder="Content"></textarea>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="number" name="price" value="" placeholder="Price">
            </div>
            <div class="form-group">
              <label>PDF</label>
              <?php
              //ADD PHP TO ENABLE PDF FILE UPLOAD
              ?>
            </div>
            <div class="form-group">
              <label>Image File</label>
              <?php
              //ADD PHP TO ENABLE IMAGE FILE UPLOAD
              ?>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END OF ADD PRODUCT MODAL -->
<!-- END OF MODALS -->
<?php
