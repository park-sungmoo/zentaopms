<?php
/**
 * The moveextfiles view file of upgrade module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2022 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Shujie Tian <tianshujie@cnezsoft.com>
 * @package     upgrade
 * @version     $Id: moveextfiles.html.php 5119 2022-02-21 13:22:42Z $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='container'>
  <form method='post' target='hiddenwin'>
    <div class='modal-dialog'>
      <div class='modal-header'>
        <strong><?php echo $lang->upgrade->moveEXTFiles;?></strong>
      </div>
      <div class='modal-body'>
        <div>
          <div class="checkbox-primary" title="<?php echo $lang->selectAll?>">
            <input type='checkbox' id='checkAll' checked><label for='checkAll'><strong><?php echo $lang->upgrade->fileName;?></strong></label>
          </div>
          <?php echo html::checkbox('files', $files, '', 'checked');?>
        </div>
      </div>
      <div class='modal-footer text-center'><?php echo html::submitButton();?></div>
    </div>
  </form>
</div>
<?php include '../../common/view/footer.lite.html.php';?>
