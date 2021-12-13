<?php
/**
 * The editcard of kanban module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2021 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Shujie Tian <tianshujie@easycorp.ltd>
 * @package     kanban
 * @version     $Id: editcard.html.php 4903 2021-12-13 14:25:59Z $ 
 * @link        https://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id="mainContent" class="main-content fade">
  <form method='post' enctype='multipart/form-data' target='hiddenwin' id='dataform'>
    <div class='main-header'>
      <h2><?php echo $lang->kanbancard->edit;?></h2>
    </div>
    <div class='main-row'>
      <div class='main-col col-8'>
        <div class='cell'>
          <div class='detail'>
            <div class='detail-title'><?php echo $lang->kanbancard->name;?></div>
            <div class='form-group'>
              <div class="input-control has-icon-right">
                <?php echo html::input('name', $card->name, 'class="form-control"');?>
              </div>
            </div>
          </div>
          <div class='detail'>
            <div class='detail-title'><?php echo $lang->kanbancard->desc;?></div>
            <div class='form-group'>
              <?php echo html::textarea('desc', $card->desc, "rows='5' class='form-control'");?>
            </div>
          </div>
          <div class='detail text-center form-actions'>
            <?php echo html::submitButton();?>
            <?php echo html::commonButton($lang->cancel, "data-dismiss='modal'", 'btn btn-wide');?>
          </div>
          <?php include '../../common/view/action.html.php';?>
        </div>
      </div>
      <div class='side-col col-4'>
        <div class='cell'>
          <div class='detail'>
            <div class='detail-title'><?php echo $lang->kanbancard->legendBasicInfo;?></div>
              <table class="table table-form">
                <tr>
                  <?php unset($users['closed']);?>
                  <th><?php echo $lang->kanbancard->assignedTo;?></th>
                  <td><?php echo html::select('assignedTo', $users, $card->assignedTo, "class='form-control chosen' multiple");?></td>
                </tr>
                <tr>
                  <th><?php echo $lang->kanbancard->begin;?></th>
                  <td><?php echo html::input('begin', helper::isZeroDate($card->begin) ? '' : $card->begin, "class='form-control form-datetime'");?></td>
                </tr>
                <tr>
                  <th><?php echo $lang->kanbancard->end;?></th>
                  <td><?php echo html::input('end', helper::isZeroDate($card->end) ? '' : $card->end, "class='form-control form-datetime'");?></td>
                </tr>
                <tr>
                  <th><?php echo $lang->kanbancard->pri;?></th>
                  <td><?php echo html::select('pri', $lang->kanbancard->priList, $card->pri, "class='form-control'");?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
