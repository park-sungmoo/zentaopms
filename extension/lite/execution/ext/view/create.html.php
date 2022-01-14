<?php
/**
 * The create view of execution module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     execution
 * @version     $Id: create.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php if(isset($tips)):?>
<?php $defaultURL = $this->createLink('execution', 'kanban', 'executionID=' . $executionID);?>
<?php die(js::locate($defaultURL));?>
<?php endif;?>

<?php include $app->getModuleRoot() . 'common/view/header.html.php';?>
<?php include $app->getModuleRoot() . 'common/view/kindeditor.html.php';?>
<?php js::import($jsRoot . 'misc/date.js');?>
<?php js::set('weekend', $config->execution->weekend);?>
<?php js::set('holders', $lang->execution->placeholder);?>
<?php js::set('errorSameProducts', $lang->execution->errorSameProducts);?>
<?php js::set('errorSameBranches', $lang->execution->errorSameBranches);?>
<?php js::set('productID', empty($productID) ? 0 : $productID);?>
<?php js::set('isStage', $isStage);?>
<?php js::set('copyExecutionID', $copyExecutionID);?>
<?php js::set('systemMode', $config->systemMode);?>
<?php js::set('projectCommon', $lang->project->common);?>
<?php js::set('multiBranchProducts', $multiBranchProducts);?>
<?php js::set('systemMode', $config->systemMode);?>
<div id='mainContent' class='main-content'>
  <div class='center-block'>
    <div class='main-header'>
      <h2><?php echo $lang->execution->create;?></h2>
      <div class="pull-right btn-toolbar">
        <button type='button' class='btn btn-link' data-toggle='modal' data-target='#copyProjectModal'><?php echo html::icon($lang->icons['copy'], 'muted') . ' ' . ((($from == 'execution') and ($config->systemMode == 'new')) ? $lang->execution->copyExec : $lang->execution->copy);?></button>
      </div>
    </div>
    <form class='form-indicator main-form form-ajax' method='post' target='hiddenwin' id='dataform'>
      <table class='table table-form'>
        <?php if($config->systemMode == 'new'):?>
        <tr>
          <th class='w-120px'><?php echo $lang->execution->projectName;?></th>
          <td class="col-main"><?php echo html::select("project", $allProjects, $projectID, "class='form-control chosen' required onchange='refreshPage(this.value)'");?></td>
          <td colspan='2'></td>
        </tr>
        <?php endif;?>
        <tr>
          <th class='w-120px'><?php echo $lang->execution->name;?></th>
          <td class="col-main"><?php echo html::input('name', $name, "class='form-control' required");?></td>
          <td colspan='2'>
            <?php echo html::hidden('begin', date('Y-m-d'));?>
            <?php echo html::hidden('end', date('Y-m-d'));?>
            <?php echo html::hidden('days', '1');?>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->execution->code;?></th>
          <td><?php echo html::input('code', $code, "class='form-control' required");?></td><td></td><td></td>
        </tr>
        <tr class='hide'>
          <th><?php echo $lang->execution->status;?></th>
          <td><?php echo html::hidden('status', 'wait');?></td>
          <td></td>
          <td></td>
        </tr>
        <?php $this->printExtendFields('', 'table', 'columns=3');?>
        <tr>
          <th><?php echo $lang->execution->owner;?></th>
          <td><?php echo html::select('PM', $pmUsers, empty($copyExecution) ? '' : $copyExecution->PM, "class='form-control chosen'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->execution->team;?></th>
          <td colspan='3'><?php echo html::select('teamMembers[]', $users, '', "class='form-control chosen' multiple"); ?></td>
        </tr>
        <tr>
          <th><?php echo $lang->execution->desc;?></th>
          <td colspan='3'>
            <?php echo $this->fetch('user', 'ajaxPrintTemplates', 'type=execution&link=desc');?>
            <?php echo html::textarea('desc', '', "rows='6' class='form-control kindeditor' hidefocus='true'");?>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->execution->acl;?></th>
          <td colspan='3'><?php echo nl2br(html::radio('acl', $lang->execution->aclList, $acl, "onclick='setWhite(this.value);'", 'block'));?></td>
        </tr>
        <tr class="hidden" id="whitelistBox">
          <th><?php echo $lang->whitelist;?></th>
          <td colspan='2'>
            <div class='input-group'>
              <?php echo html::select('whitelist[]', $users, $whitelist, 'class="form-control chosen" multiple');?>
              <?php echo $this->fetch('my', 'buildContactLists', "dropdownName=whitelist");?>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan='4' class='text-center form-actions'>
            <?php echo html::submitButton();?>
            <?php echo html::hidden('lifetime', key($lang->execution->lifeTimeList));?>
            <?php echo html::hidden("products[]", key($allProducts));?>
            <?php echo html::hidden("PO", '');?>
            <?php echo html::hidden("QD", '');?>
            <?php echo html::hidden("RD", '');?>
            <?php echo html::hidden("type", 'kanban');?>
            <?php echo html::hidden("vision", 'lite');?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<div class='modal fade modal-scroll-inside' id='copyProjectModal'>
  <div class='modal-dialog mw-900px'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><i class="icon icon-close"></i></button>
      <h4 class='modal-title' id='myModalLabel'><?php echo $lang->execution->copyTitle;?></h4>
    </div>
    <div class='modal-body'>
      <?php if(count($executions) == 1):?>
      <div class='alert with-icon'>
        <i class='icon-exclamation-sign'></i>
        <div class='content'><?php echo $lang->execution->copyNoExecution;?></div>
      </div>
      <?php else:?>
      <div id='copyProjects' class='row'>
      <?php foreach ($executions as $id => $execution):?>
      <?php if(empty($id)):?>
      <?php if($copyExecutionID != 0):?>
      <div class='col-md-4 col-sm-6'><a href='javascript:;' data-id='' class='cancel'><?php echo html::icon($lang->icons['cancel']) . ' ' . $lang->execution->cancelCopy;?></a></div>
      <?php endif;?>
      <?php else: ?>
      <div class='col-md-4 col-sm-6'><a href='javascript:;' data-id='<?php echo $id;?>' class='nobr <?php echo ($copyExecutionID == $id) ? ' active' : '';?>'><?php echo html::icon($lang->icons[$execution->type], 'text-muted') . ' ' . $execution->name;?></a></div>
      <?php endif; ?>
      <?php endforeach;?>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>
<?php include $app->getModuleRoot() . 'common/view/footer.html.php';?>
