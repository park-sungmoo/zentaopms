<?php
/**
 * The obtain view file of webapp module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <Yidong@cnezsoft.com>
 * @package     webapp
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<table class='cont-lt1'>
  <tr valign='top'>
    <td class='side'>
      <div class='box-title'><?php echo $lang->webapp->obtain;?></div>
      <div class='box-content a-center'>
        <?php
        echo "<span id='byupdatedtime'>" . html::a(inlink('obtain', 'type=byUpdatedTime'), $lang->webapp->byUpdatedTime) . '</span><br />';
        echo "<span id='byaddedtime'>"   . html::a(inlink('obtain', 'type=byAddedTime'),   $lang->webapp->byAddedTime)   . '</span><br />';
        echo "<span id='bydownloads'>"   . html::a(inlink('obtain', 'type=byDownloads'),   $lang->webapp->byDownloads)   . '</span><br />';
        ?>
      </div>
      <div class='box-title'><?php echo $lang->webapp->bySearch;?></div>
      <div class='box-content a-center'>
        <form method='post' action='<?php echo inlink('obtain', 'type=bySearch');?>'>
        <?php echo html::input('key', $this->post->key, "class='text-1'") . html::submitButton($lang->webapp->bySearch);?>
        </form>
      </div>
      <div class='box-title'><?php echo $lang->webapp->byCategory;?></div>
      <div class='box-content' class='tree'>
        <?php $moduleTree ? print($moduleTree) : print($lang->webapp->errorGetModules);?>
      </div>
    </td>
    <td class='divider'></td>
    <td> 
      <?php if($webapps):?>
      <ul id='webapps'>
        <?php foreach($webapps as $webapp):?>
        <li>
          <table class='fixed exttable'>
            <tr>
              <td rowspan='3' width='73' height='73' class='webapp-icon'><img src='<?php echo empty($webapp->icon) ? '/theme/default/images/main/webapp-default.png' : $config->webapp->url . $webapp->icon?>' width='72' height='72' /></td>
              <td class='webapp-name'><?php echo $webapp->name?></td>
            </tr>
            <tr><td class='webapp-info'><span title='<?php echo $webapp->desc?>'><?php echo empty($webapp->desc) ? '&nbsp;' : $webapp->desc?></span></td></tr>
            <tr><td><?php echo isset($installeds[$webapp->id]) ? html::commonButton($lang->webapp->installed, "disabled='disabled' style='color:gray'") : html::a(inLink('install', "webappID={$webapp->id}"), $lang->webapp->install, '_self', "class='button-c iframe'")?></td></tr>
          </table>
        </li>
        <?php endforeach;?>
      </ul>
      <p class='c-left'><?php if($pager) $pager->show();?></p>
      <?php else:?>
        <div class='box-title'><?php echo $lang->webapp->errorOccurs;?></div>
        <div class='box-content'><?php echo $lang->webapp->errorGetExtensions;?></div>
      <?php endif;?>
    </td>
  </tr>
</table>
<script>
$('#<?php echo $type;?>').addClass('active')
$('#module<?php echo $moduleID;?>').addClass('active')
</script>
<?php include '../../common/view/footer.html.php';?>
