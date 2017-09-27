<?php

require ('soap_calc_api.php');
$soap_calc_api = new SoapCalcApi();

if (isset($_REQUEST['s'])) {
    $s = $_REQUEST['s'];
} else {
    $s = "";
}
$alloils = $soap_calc_api->getSoapData("admin", $s);

?>

<div class="wrap">
    <h1 class="wp-heading-inline">  <?php echo __('Settings'); ?>
    </h1>
    <hr class="wp-header-end">

    <h2 class="screen-reader-text">Filter pages list</h2>
    <ul class="subsubsub">
        <li class="all"><a href="javascript:void(0);"
                           class="current">All <span class="count">(<?php echo count($alloils) - 1; ?>)</span></a></li>
                   
    </ul>
    <form id="posts-filter" method="get" action="">

        <p class="search-box">

            <label class="screen-reader-text" for="post-search-input"><?php _e('Search Oils', 'soap_calc_manager'); ?>:</label>

            <input type="hidden" name="page" value="soap_api_manager" /> <input
                id="post-search-input" type="text"
                value="<?php echo esc_attr($s); ?>" name="s" size="30" /> <input
                class="button" type="submit"
                value="<?php _e('Search Oils', 'soap_calc_manager'); ?>"
                id="search-submit" />

        </p>

    </form>


    <div class="tablenav top">
        <div class="tablenav-pages one-page">
            <span class="displaying-num"><?php echo count($alloils) - 1; ?> items</span>
            <span class="pagination-links"><span class="tablenav-pages-navspan"
                                                 aria-hidden="true">�</span> <span class="tablenav-pages-navspan"
                                                 aria-hidden="true">�</span> <span class="paging-input"> <label
                        for="current-page-selector" class="screen-reader-text">Current Page</label>
                    <input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1" aria-describedby="table-paging"> 
                           <span class="tablenav-paging-text"> of <span class="total-pages"><!-- 1 --></span>
                    </span>
                </span> <span class="tablenav-pages-navspan" aria-hidden="true">�</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">�</span>
              </span>
        </div>
        <br class="clear">
    </div>


     <h2 class="screen-reader-text">Oils list</h2>
    <table class="wp-list-table widefat fixed striped oils">
        <thead>
            <tr>

          <th scope="col" id="oil_id" class="manage-column  column-oil-name">Oil Name</th>                
                <th scope="col" id="status" class="manage-column  column-oil-status">Status</th>
                <th scope="col" id="date" class="manage-column column-date sortable asc "><span>Date</span><span  class="sorting-indicator"></span></th>
            </tr>
        </thead>
        <tbody id="the-list">


            <?php
            if (isset($alloils) && !empty($alloils)) {
                foreach ($alloils as $oil) {
                    ?>

                    <tr id="oil-<?php echo $oil->id; ?>" class="iedit level-0 oil-<?php echo $oil->id; ?> type-oil status-publish hentry pmpro-has-access">
                        <td class="author column-author" data-colname="oil_id">
                          <strong><a class="row-title" href="#" aria-label="Cart (Edit)"><?php echo $oil->name ?></a></strong>

                            <div class="row-actions">
                                <span class="inline hide-if-no-js" id="quick-edit-<?php echo $oil->id; ?>"><a href="javascript:void(0);" class="editinline" aria-label="Quick edit<?php echo $oil->name; ?> inline">Inline&nbsp;Edit</a>
                                </span>
                            </div></td>


                            <td class="column-status">
                            <label for="active_<?php echo $oil->id; ?>">
                                <input id="active_<?php echo $oil->id; ?>" class="radio_status" type="radio" name="status_<?php echo $oil->id; ?>" value="1" <?php echo ($oil->status=='1') ? 'checked' : '' ?> /> Active
                            </label>
                            <br />
                            <label for="in-active_<?php echo $oil->id; ?>">
                                <input id="in-active_<?php echo $oil->id; ?>" class="radio_status" type="radio" name="status_<?php echo $oil->id; ?>" value="2" <?php echo ($oil->status=='2') ? 'checked' : '' ?>/> In-Active
                            </label>
                          <span class="spinner" id="status_spinner-<?php echo $oil->id; ?>"></span>
                        </td>

                         <td class="date column-date" data-colname="Date"><abbr
                                title="<?php echo date("Y/m/d H:i:s", strtotime($oil->date_added)); ?>"><?php echo date("Y/m/d H:i:s", strtotime($oil->date_added)); ?></abbr></td>
</tr>

                    <?php 
                  }
                  }?>
          <tbody>
        <tfoot>
            <tr>

                <th scope="col" id="oil_id" class="manage-column  column-oil-name">Oil Name</th>                
                <th scope="col" id="status" class="manage-column  column-oil-status">Status</th>
                <th scope="col" id="date" class="manage-column column-date sortable asc "><span>Date</span><span  class="sorting-indicator"></span></th>
            </tr>
        </tfoot>
    </table>
    <div class="tablenav bottom">
        <div class="alignleft actions"></div>
        <div class="tablenav-pages one-page">
            <span class="displaying-num"><?php echo count($alloils) - 1; ?> items</span>
            <span class="pagination-links">
              <span class="tablenav-pages-navspan" aria-hidden="true">�</span>
               <span class="tablenav-pages-navspan" aria-hidden="true">�</span> 
               <span class="screen-reader-text">Current Page</span><span id="table-paging" class="paging-input">
                <span class="tablenav-paging-text">1 of <span class="total-pages">
                  <!-- 1 --></span>
                </span>
              </span>
                <span class="tablenav-pages-navspan" aria-hidden="true">�</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">�</span>
              </span>
        </div>
        <br class="clear">
    </div>
    <div id="ajax-response"></div>
    <br class="clear">
</div>
  </div>