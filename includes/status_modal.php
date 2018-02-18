<div id="openModal1" class="modalDialog">
  <div>
    <form action="/includes/busy.php?id="<?php echo $pid ?> method="post">
    <a href="#close" title="Close" class="close">X</a>
        <h2 class="text-centered">Add New Status</h2>
            <div class="form-group">
              <select id="status-type" name="type">
                <option>Call</option>
                <option>Note</option>
              </select>
              <label class="control-label" for="select">Status Type</label><i class="bar"></i>
            </div>
            <div id="name-input" class="form-group">
              <input type="text" required="required"/ name="cid">
              <label class="control-label" for="input">Caller ID</label><i class="bar"></i>
            </div>
            <div class="form-group desc">
              <textarea required="required" onkeyup="increaseHeight(this);" name="comment"></textarea>
              <label class="control-label" for="textarea">Status Message</label><i class="bar"></i>

            <div class="checkbox">
              <label>
                <input id="checkbox-solved-status" type="checkbox" name="solved"/><i class="helper"></i>Problem Solved (Closed)
              </label>
            </div>

          </div>
          <div class="form-group desc" id="enter-solution" style="display:none;">
            <textarea required="required" onkeyup="increaseHeight(this);" name="solution"></textarea>
            <label class="control-label" for="textarea">Solution</label><i class="bar"></i>
            </div>
          <div class="button__container">
          <button class="button__load" style="margin-bottom:10px;" name="submit">Add Status</button>
      </div>
    </form>
  </div>
</div>
