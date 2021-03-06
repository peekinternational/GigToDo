<style>
.popover label {
    display: block;
    width: 100%;
    height: 100%;
    margin-top: 10px;
    color: #404040;
    cursor: pointer;
    font: 400 12px/16px "Helvetica Neue",Helvetica,Arial,sans-serif;
}
.popover .fake-radio-green {
    position: relative;
    overflow: hidden;
    vertical-align: top;
}
.popover input[type=radio] {
    position: absolute;
    opacity: 0;
    top: -20px;
    left: -20px;
}
.popover label .radio-img {
    float: left;
}
.fake-radio-green input[type=radio]:checked+.radio-img {
    background: transparent url(../images/checkbox-on.jpg) no-repeat;
    background-size: 16px 16px;
}
.fake-radio-green .radio-img {
    background: transparent url(../images/checkbox-off.jpg) no-repeat;
    background-size: 16px 16px;
    vertical-align: middle;
    display: inline-block;
    width: 16px;
    height: 16px;
}
.popover label div {
    padding-left: 10px;
    font-size: 14px;
    display: inline-block;
}
.popover label input:checked~div>small {
    display: block;
}
.popover label small {
    font-size: 12px;
    padding-top: 5px;
    display: none;
    color: #999;
}
</style>

<div class="message-sender-area">
  <p class="bg-danger p-2 text-white mv-0 d-none"><i class="fa fa-warning"></i> You seem to have typed word(s) that are in violation of our policy. No direct payments or emails allowed.</p>
  <?php if($seller_vacation == "on" AND $seller_status != "block-ban"){ ?>
  <div class="alert alert-info mt-2">
    <div id="seller-vacation-div" class="mb-0">
      <p class="lead mb-0"><strong>Opps! </strong> This seller is on vacation and is not receiving messages at the momment. Please try again later.</p>
    </div>
  </div>
  <?php } ?>
  <?php if($seller_status == "block-ban"){ ?>
  <div class="alert alert-danger mt-2">
  <p class="lead mb-0">This seller has been blocked so you can't send him messages anymore.</p>
  </div>
  <?php } ?>
  <?php if($seller_status != "block-ban" AND $seller_vacation == "off"){ ?>
  <form method="post" action="" id="insert-message-form">
    <p class="typing-status mb-1 invisible">Dummy Text</p>
    <textarea class="message-text text"  id="message" placeholder="Type your message here..."></textarea>
    <div class="d-flex flex-column flex-sm-row justify-content-between position-relative">
      <div class="attachment d-flex flex-row align-items-center">
        <p class="mb-2 mt-2 d-none files"></p>
        <label for="file">
          <input type="hidden" id="sendType" value="send-msg">
          <input type="hidden" id="fileVal">
          <input type="file" hidden name="" id="file" />
          <div class="d-flex flex-row align-items-center">
            <i class="fal fa-paperclip"></i>
            Attach File
          </div>
        </label>
        <!-- <div class="file-size">Max Size 30MB</div> -->
      </div>
      
      <button class="send-message" type="submit" id="send-msg">SEND</button>
      <button type="button" class="arrow-drop float-right" data-html="true" data-toggle="popover" data-placement="top" data-content='
      <strong>Pressing Enter will :</strong>
      <label class="fake-radio-green">
        <input type="radio" name="toggle-send" value="new-line">
        <span class="radio-img"></span>
        <div>Start a new line <small>Press Ctrl+Enter to send message.</small></div>
      </label>
      <label class="fake-radio-green">
        <input type="radio" name="toggle-send" value="send-msg"><span class="radio-img"></span>
        <div>Send message<small>Press Shift+Enter to start a new line.</small></div>
      </label>
      <script>
      var current = $("#sendType").val();
      $("input[value=" + current + "]").prop("checked", true);
      $(".fake-radio-green input").click(function(){
      var val = $(this).val();
      $("#sendType").val(val);
      });
      </script>'> <i class="fa fa-chevron-down"></i>
      </button>
    </div>
  </form>
  <?php } ?>
</div>



<script>
$(document).ready(function(){
$(function () {
  $('[data-toggle="popover"]').popover();
});
var text =  $('.text').emojioneArea({
  events: {
  keydown: function (editor, event) {
    // typeStatus
    var seller_id = "<?= $login_seller_id; ?>";
    var status = "typing";
    $.ajax({
      method: 'POST',
      url: 'typeStatus',
      data: {seller_id: seller_id, message_group_id:message_group_id , status: status}
    });
    action = $("#sendType").val();
    if(action == "send-msg"){
     if (event.keyCode == 13 && event.shiftKey) {
     
     }else if(event.keyCode == 13){
        event.preventDefault();
        sendMessage();
      }
    }else{
      if(event.keyCode == 13 && event.ctrlKey){
        event.preventDefault();
        sendMessage();
      }
    }
  },
  keyup: function (editor, event) {
    // match_words
    var value = $(".emojionearea-editor").html();
    $.ajax({
      url: "match_words",
      method:"POST",
      data: {value : value},
      success:function(val){
        if(val == "match"){
          $('.bg-danger').removeClass("d-none");
        }else{
          $('.bg-danger').addClass("d-none");
        }
      }
    });
    // typeStatus
    var seller_id = "<?= $login_seller_id; ?>";
    var status = "untyping";
    setTimeout(function(){
      $.ajax({
        method: 'POST',
        url: 'typeStatus',
        data: {seller_id: seller_id, message_group_id:message_group_id, status: status}
      });
    }, 2000);
  }
 }
});
});
</script>