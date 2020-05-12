<?php
  @session_start();
  require_once("includes/db.php");
  if(!isset($_SESSION['seller_user_name'])){
    echo "<script>window.open('login','_self')</script>";
  }

  require 'admin/timezones.php';

  $form_errors = Flash::render("form_errors");
  $form_data = Flash::render("form_data");
  if(is_array($form_errors)){
?>
<div class="alert alert-danger">
  <!--- alert alert-danger Starts --->
  <ul class="list-unstyled mb-0">
    <?php $i = 0; foreach ($form_errors as $error) { $i++; ?>
    <li class="list-unstyled-item"><?php echo $i ?>. <?php echo ucfirst($error); ?></li>
    <?php } ?>
  </ul>
</div>
<!--- alert alert-danger Ends --->
<?php } ?>
<form method="post" enctype="multipart/form-data" runat="server" autocomplete="off">
  <div class="edit-profile-image">
    <label class="cover-image-label" for="cover">
      <input type="file" id="cover" name="cover_photo" hidden />
      <input type="hidden" name="cover_photo">
      <div class="icontext d-flex flex-row align-items-center justify-content-center">
        <span>
          <img class="img-fluid d-block" src="assets/img/edit-profile/pen-icon.png" />
        </span>
        <span>
          تعديل صورة الغلاف
        </span>
      </div>
      <?php if(!empty($login_seller_cover_image)){ ?>
      <img src="<?= $site_url; ?>/cover_images/<?php echo $login_seller_cover_image; ?>" width="750" height="280" class="img-thumbnal cover_pic">
      <span class="remove text-danger"><i class="fa fa-trash"></i></span>
      <?php }else{ ?>
      <!-- <img src="cover_images/empty-cover.png" width="750" height="280" class="img-thumbnail img-circle" > -->
      <?php } ?>
    </label>
    <label class="profile-image" for="profile-image">
      <input type="file" id="profile-image" name="profile_photo" hidden />
      <input type="hidden" name="profile_photo">
      <?php if(!empty($login_seller_image)){ ?>
      <img src="<?= $site_url; ?>/user_images/<?php echo $login_seller_image; ?>" width="80" class="img-thumbnail img-circle" >
      <?php }else{ ?>
      <img class="img-fluid img-circle" src="assets/img/emongez_cube.png" />
      <?php } ?>
      <!-- <img class="img-fluid d-block" src="assets/img/emongez_cube.png" /> -->
      <img class="img-fluid d-block pen-icon" src="assets/img/edit-profile/pen-icon.png" />
    </label>
  </div>
  <div class="row">
    <div class="col-12 col-md-6">
      <div class="form-group d-flex flex-column">
        <label class="control-label">
          الاسم الأول
        </label>
        <input class="form-control" type="text" type="text" name="seller_name" value="<?php echo $login_seller_name; ?>" />
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="form-group d-flex flex-column">
        <label class="control-label">
          الاسم الأخير
        </label>
        <input class="form-control" type="email" name="seller_email" value="<?php echo $login_seller_email; ?>" readonly />
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="form-group d-flex flex-column custom_nice state_box">
        <label class="control-label">
          البلد
        </label>
        <select class="form-control wide" name="seller_country" required="" onChange="getState(this.value);" id="country">
          <option>
            اختار البلد
          </option>
          <?php
            $get_countries = $db->select("countries");
            while($row_countries = $get_countries->fetch()){
              $id = $row_countries->id;
              $name = $row_countries->name;
              echo "<option value='$name'".($name == $login_seller_country ? "selected" : "").">$name</option>";
            }
          ?>
        </select>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="form-group d-flex flex-column custom_nice state_box">
        <label class="control-label">حالة </label>
        <select class="form-control wide" name="seller_state" required="" onChange="getCity(this.value);" id="state-list">
          <?php if (!empty($login_seller_state)){ ?>
            <option selected><?= $login_seller_state; ?></option>
          <?php } ?>
          
        </select>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="form-group d-flex flex-column custom_nice state_box">
        <label class="control-label">مدينة </label>
        <select class="form-control wide" name="seller_city" required="" id="city-list">
          <?php if (!empty($login_seller_city)){ ?>
            <option selected><?= $login_seller_city; ?></option>
          <?php } ?>
          
        </select>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="form-group d-flex flex-column custom_nice">
        <label class="control-label">وحدة زمنية</label>
        <select class="form-control wide site_logo_type" name="seller_timezone" required="">
          <?php foreach ($timezones as $key => $zone) { ?>
            <option <?=($login_seller_timzeone == $zone)?"selected=''":""; ?> value="<?= $zone; ?>"><?= $zone; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group d-flex flex-column">
        <label class="control-label">
          اللغات
        </label>
        <!-- <input type="text" data-role="tagsinput" value="English,German"> -->
        <select name="seller_language" class="form-control wide">
          <?php if($login_seller_language == 0){ ?>
          <option class="hidden"> Select Language </option>
          <?php 
            $get_languages = $db->select("seller_languages");
            while($row_languages = $get_languages->fetch()){
            $language_id = $row_languages->language_id;
            $language_title = $row_languages->language_title;
            ?>
          <option value="<?php echo $language_id; ?>"> <?php echo $language_title; ?> </option>
          <?php } ?>
          <?php }else{ ?>
          <?php 
            $get_languages = $db->select("seller_languages");
            while($row_languages = $get_languages->fetch()){
            $language_id = $row_languages->language_id;
            $language_title = $row_languages->language_title;
            ?>
          <option value="<?php echo $language_id; ?>" <?php if($language_id == $login_seller_language){ echo "selected"; } ?>> <?php echo $language_title; ?> </option>
          <?php } ?>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group d-flex flex-column">
        <label class="control-label">كلمنا شوية عن نفسك</label>
        <textarea rows="5" class="form-control"name="seller_about" id="textarea-about" maxlength="300"><?php echo $login_seller_about; ?></textarea>
        <span class="float-right mt-1">
          <span class="count-about"> 0 </span> / 300 MAX
        </span>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group d-flex flex-row justify-content-end">
        <button class="button button-white" type="button" role="button">
          إلغاء
        </button>
        <button class="button button-red" type="submit" name="submit">
          حفظ
        </button>
      </div>
    </div>
  </div>
</form>



<!-- <form method="post" enctype="multipart/form-data" runat="server" autocomplete="off">
  <div class="form-group row">
    <label class="col-md-3 col-form-label"> Full Name </label>
    <div class="col-md-8">
      <input type="text" name="seller_name" value="<?php echo $login_seller_name; ?>" class="form-control" >
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-3 col-form-label"> Email </label>
    <div class="col-md-8">
      <input type="text" name="seller_email" value="<?php echo $login_seller_email; ?>" class="form-control" >
    </div>
  </div>

  <div class="form-group row">

  <label class="col-md-3 col-form-label"> Country </label>

  <div class="col-md-8">

    <select name="seller_country" class="form-control" required>
      <?php
      $get_countries = $db->select("countries");
      while($row_countries = $get_countries->fetch()){
        $id = $row_countries->id;
        $name = $row_countries->name;
        echo "<option value='$name'".($name == $login_seller_country ? "selected" : "").">$name</option>";
      }
      ?>
    </select>

  </div>

  </div>

    <div class="form-group row">
    <label class="col-md-3 col-form-label"> Timezone </label>
    <div class="col-md-8">
        <select name="seller_timezone" class="form-control site_logo_type" required="">
          <?php foreach ($timezones as $key => $zone) { ?>
            <option <?=($login_seller_timzeone == $zone)?"selected=''":""; ?> value="<?= $zone; ?>"><?= $zone; ?></option>
          <?php } ?>
        </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3 col-form-label"> Main Conversational Language </label>
    <div class="col-md-8">
      <select name="seller_language" class="form-control" >
        <?php if($login_seller_language == 0){ ?>
        <option class="hidden"> Select Language </option>
        <?php 
          $get_languages = $db->select("seller_languages");
          while($row_languages = $get_languages->fetch()){
          $language_id = $row_languages->language_id;
          $language_title = $row_languages->language_title;
          ?>
        <option value="<?php echo $language_id; ?>"> <?php echo $language_title; ?> </option>
        <?php } ?>
        <?php }else{ ?>
        <?php 
          $get_languages = $db->select("seller_languages");
          while($row_languages = $get_languages->fetch()){
          $language_id = $row_languages->language_id;
          $language_title = $row_languages->language_title;
          ?>
        <option value="<?php echo $language_id; ?>" <?php if($language_id == $login_seller_language){ echo "selected"; } ?>> <?php echo $language_title; ?> </option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-3 col-form-label"> Profile Photo </label>
    <div class="col-md-8">
      <input type="file" name="profile_photo" class="form-control">
      <input type="hidden" name="profile_photo">
      <p class="mt-2">
        This photo is your identity on <?php echo $site_name; ?>.<br>
        It appears on your profile, messages and proposals/services pages.
      </p>
      <?php if(!empty($login_seller_image)){ ?>
      <img src="user_images/<?php echo $login_seller_image; ?>" width="80" class="img-thumbnail img-circle" >
      <?php }else{ ?>
      <img src="user_images/empty-image.png" width="80" class="img-thumbnail img-circle" >
      <?php } ?>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-3 col-form-label"> Cover Photo </label>
    <div class="col-md-8">
      <input type="file" name="cover_photo" id="cover" class="form-control">
      <p class="mt-2">
        This is your cover photo on your 
        <a target="_blank" class="text-success" href="<?php echo $site_url ?>/<?php echo $_SESSION['seller_user_name']; ?>"> 
        Profile Page
        </a>
      </p>
      <?php if(!empty($login_seller_cover_image)){ ?>
      <img src="cover_images/<?php echo $login_seller_cover_image; ?>" width="80" class="img-thumbnail img-circle" >
      <?php }else{ ?>
      <img src="cover_images/empty-cover.png" width="80" class="img-thumbnail img-circle" >
      <?php } ?>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-3 col-form-label"> Headline </label>
    <div class="col-md-8">
      <textarea name="seller_headline" id="textarea-headline" rows="2" class="form-control" maxlength="150"><?php echo $login_seller_headline; ?></textarea>
      <span class="float-right mt-1">
      <span class="count-headline"> 0 </span> / 150 MAX
      </span>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-3 col-form-label"> Description</label>
    <div class="col-md-8">
      <textarea name="seller_about" id="textarea-about" rows="5" class="form-control" maxlength="300" placeholder="Tell us something about yourself..."><?php echo $login_seller_about; ?></textarea>
      <span class="float-right mt-1">
      <span class="count-about"> 0 </span> / 300 MAX
      </span>
    </div>
  </div>
  <hr>
  <button type="submit" name="submit" class="btn btn-success <?= $floatRight ?>" style="<?=($lang_dir == "right" ? 'margin-left: 110px;':'')?>">
  <i class="fa fa-floppy-o"></i> Save Changes
  </button>
</form> -->
<script>
  $(document).ready(function(){
  $image_crop = $('#image_demo').croppie({
      enableExif: true,
      viewport: {
        width:200,
        height:200,
        type:'square' //circle
      },
      boundary:{
        width:100,
        height:250
      }    
      });
    function crop(data){
      var reader = new FileReader();
      reader.onload = function (event) {
        $image_crop.croppie('bind',{
        url: event.target.result
        }).then(function(){
        console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(data.files[0]);
      $('#insertimageModal').modal('show');
      $('input[type=hidden][name=img_type]').val($(data).attr('name'));
    }
    $(document).on('change','input[type=file]:not(#cover)', function(){
    var size = $(this)[0].files[0].size; 
    var ext = $(this).val().split('.').pop().toLowerCase();
    if($.inArray(ext,['jpeg','jpg','gif','png']) == -1){
    alert('Your File Extension Is Not Allowed.');
    $(this).val('');
    }else{
    crop(this);
    }
    });
    $('.crop_image').click(function(event){
      var getUrl = '<?php echo $site_url; ?>';
    $('#wait').addClass("loader");
    var name = $('input[type=hidden][name=img_type]').val();
      $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(response){
        $.ajax({
          url:"crop_upload",
          type: "POST",
          data:{image: response, name: $('input[type=file][name='+ name +']').val().replace(/C:\\fakepath\\/i, '') },
          success:function(data){
            $('#wait').removeClass("loader");
            $('#insertimageModal').modal('hide');
            $('input[type=hidden][name='+ name +']').val(data);
            main = $('input[type=hidden][name='+ name +']').parent();
            main.prepend("<img src='"+getUrl+"/user_images/"+data+"' class='img-fluid'>");
            $('.img-circle').hide();
          }
        });
      });
      });

    // Cover Image Crop
    $image_crop_cover = $('#cover_demo').croppie({
        enableExif: true,
        viewport: {
          width:750,
          height:280,
          type:'square' //circle
        },
        boundary:{
          width:100,
          height:250
        }    
        });
      function crop_cover(data){
        var reader = new FileReader();
        reader.onload = function (event) {
          $image_crop_cover.croppie('bind',{
          url: event.target.result
          }).then(function(){
          console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(data.files[0]);
        $('#insertCoverModal').modal('show');
        $('input[type=hidden][name=img_type_cover]').val($(data).attr('name'));
      }
      $(document).on('change','input[type=file]:not(#profile-image)', function(){
        
      var size = $(this)[0].files[0].size; 
      var ext = $(this).val().split('.').pop().toLowerCase();
      if($.inArray(ext,['jpeg','jpg','gif','png']) == -1){
      alert('Your File Extension Is Not Allowed.');
      $(this).val('');
      }else{
      crop_cover(this);
      }
      });
      $('.crop_image_cover').click(function(event){
        var getUrl = '<?php echo $site_url; ?>';
      $('#wait').addClass("loader");
      var name = $('input[type=hidden][name=img_type_cover]').val();
        $image_crop_cover.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function(response){
          $.ajax({
            url:"crop_upload_cover",
            type: "POST",
            data:{image: response, name: $('input[type=file][name='+ name +']').val().replace(/C:\\fakepath\\/i, '') },
            success:function(data){
              $('#wait').removeClass("loader");
              $('#insertCoverModal').modal('hide');
              $('input[type=hidden][name='+ name +']').val(data);
              main = $('input[type=hidden][name='+ name +']').parent();
              main.prepend("<img src='"+getUrl+"/cover_images/"+data+"' class='img-fluid'>");
              $('.cover_pic').hide();
            }
          });
        });
        });
        $('.remove').click(function(){
          $('.cover_pic').remove();
          $('.remove').hide();
        });
    $("#textarea-headline").keydown(function(){
      var textarea_headline = $("#textarea-headline").val();
      $(".count-headline").text(textarea_headline.length);  
    });
    $("#textarea-about").keydown(function(){
      var textarea_about = $("#textarea-about").val();
      $(".count-about").text(textarea_about.length);
    });
  });
</script>
<?php
  if(isset($_POST['submit'])){
    $rules = array(
    "seller_name" => "required",
    "seller_email" => "required",
    "seller_country" => "required",
    "seller_language" => "required");

    $messages = array("seller_name" => "Full Name Is required.","seller_email" => "Email Is Required.","seller_country"=>"Country Is Required.","seller_language"=>"Main Conversational Language Is Required.");
    $val = new Validator($_POST,$rules,$messages);
    if($val->run() == false){
      Flash::add("form_errors",$val->get_all_errors());
      Flash::add("form_data",$_POST);
      echo "<script> window.open('settings?profile_settings','_self');</script>";
    }else{
      $seller_name = strip_tags($input->post('seller_name'));
      $seller_email = strip_tags($input->post('seller_email'));
      $seller_country = strip_tags($input->post('seller_country'));
      $seller_state = strip_tags($input->post('seller_state'));
      $seller_city = strip_tags($input->post('seller_city'));
      $seller_timezone = strip_tags($input->post('seller_timezone'));
      $seller_language = strip_tags($input->post('seller_language'));
      $seller_headline = strip_tags($input->post('seller_headline'));
      $seller_about = strip_tags($input->post('seller_about'));
      $profile_photo = strip_tags($input->post('profile_photo'));
      $cover_photo = strip_tags($input->post('cover_photo'));
      // $cover_photo = $_FILES['cover_photo']['name'];
      // $cover_photo_tmp = $_FILES['cover_photo']['tmp_name'];
      // $allowed = array('jpeg','jpg','gif','png','tif');
      // $cover_file_extension = pathinfo($cover_photo, PATHINFO_EXTENSION);
      // if(!in_array($cover_file_extension,$allowed) & !empty($cover_photo)){
      //   echo "<script>alert('Your File Format Extension Is Not Supported.')</script>";
      // }else{
        if(empty($profile_photo)){
          $profile_photo = $login_seller_image;
        }
        if(empty($cover_photo)){
          $cover_photo = $login_seller_cover_image;
        }else{
          // $cover_photo = pathinfo($cover_photo, PATHINFO_FILENAME);
          // $cover_photo = $cover_photo."_".time().".$cover_file_extension";
        }
        // move_uploaded_file($cover_photo_tmp,"cover_images/$cover_photo");
        
        $update_proposals = $db->update("proposals",array("language_id" => $seller_language),array("proposal_seller_id" => $login_seller_id));

        $sel_languages_relation = $db->query("select * from languages_relation where seller_id='$login_seller_id' and language_id='$seller_language'");
        $count_languages_relation = $sel_languages_relation->rowCount();

        if($count_languages_relation == 0){
          $insert_language = $db->insert("languages_relation",array("seller_id"=>$login_seller_id,"language_id"=>$seller_language,"language_level"=>'conversational'));
        }

        // if email changed
        if($seller_email != $login_seller_email){
          $verification_code = mt_rand();
        }elseif($seller_email == $login_seller_email){
          $verification_code = $login_seller_verification;
        }

        $update_seller = $db->update("sellers",array("seller_name"=>$seller_name,"seller_email"=>$seller_email,"seller_image"=>$profile_photo,"seller_cover_image"=>$cover_photo,"seller_country"=>$seller_country,"seller_state"=>$seller_state,"seller_city"=>$seller_city,"seller_timezone"=>$seller_timezone,"seller_headline"=>$seller_headline,"seller_about"=>$seller_about,"seller_language"=>$seller_language,"seller_verification"=>$verification_code),array("seller_id"=>$login_seller_id));
        
        if($update_seller){
          if (($seller_email == $login_seller_email) or ($seller_email != $login_seller_email and userConfirmEmail($seller_email))){
            echo "<script>
            swal({
            type: 'success',
            text: 'Profile settings updated successfully!',
            timer: 3000,
            onOpen: function(){
              swal.showLoading()
            }
            }).then(function(){
                // Read more about handling dismissals
                window.open('settings?profile_settings','_self');
            });
            </script>";
          }
        }
      // }
    }
  }
?>