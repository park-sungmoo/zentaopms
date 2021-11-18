/**
 * Load branches
 *
 * @param  int $productID
 * @access public
 * @return void
 */
function loadBranches(productID)
{
    $('#branch').remove();
    $('#branch_chosen').remove();
    var oldBranch = 0;
    if(typeof(productGroups[productID]) != "undefined")
    {
        oldBranch = productGroups[productID]['branches'];
    }

    $.get(createLink('branch', 'ajaxGetBranches', 'productID=' + productID + '&oldBranch=0&param=&projectID=' + executionID), function(data)
    {
        if(data)
        {
            $('#product').closest('.input-group').append(data);
            $('#branch').chosen();
        }
    });
}
