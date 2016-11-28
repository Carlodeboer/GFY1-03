<html>
<body>

  <form method="post" enctype="multipart/form-data" class="form-horizontal">

   <table class="table table-bordered table-responsive">

      <tr>
       <td><label class="control-label">Username.</label></td>
          <td><input class="form-control" type="text" name="user_name" placeholder="Enter Username" value="<?php echo $username; ?>" /></td>
      </tr>

      <tr>
       <td><label class="control-label">Profession(Job).</label></td>
          <td><input class="form-control" type="text" name="user_job" placeholder="Your Profession" value="<?php echo $userjob; ?>" /></td>
      </tr>

      <tr>
       <td><label class="control-label">Profile Img.</label></td>
          <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
      </tr>

      <tr>
          <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
          <span class="glyphicon glyphicon-save"></span> &nbsp; save
          </button>
          </td>
      </tr>

      </table>

  </form>

</body>
</html>
