<?php
namespace PHPMaker2020\lgmis20;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$document_text_view = new document_text_view();

// Run the page
$document_text_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_text_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$document_text_view->isExport()) { ?>
<script>
var fdocument_textview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdocument_textview = currentForm = new ew.Form("fdocument_textview", "view");
	loadjs.done("fdocument_textview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$document_text_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $document_text_view->ExportOptions->render("body") ?>
<?php $document_text_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $document_text_view->showPageHeader(); ?>
<?php
$document_text_view->showMessage();
?>
<?php if (!$document_text_view->IsModal) { ?>
<?php if (!$document_text_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $document_text_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdocument_textview" id="fdocument_textview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_text">
<input type="hidden" name="modal" value="<?php echo (int)$document_text_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($document_text_view->TextBody->Visible) { // TextBody ?>
	<tr id="r_TextBody">
		<td class="<?php echo $document_text_view->TableLeftColumnClass ?>"><span id="elh_document_text_TextBody"><?php echo $document_text_view->TextBody->caption() ?></span></td>
		<td data-name="TextBody" <?php echo $document_text_view->TextBody->cellAttributes() ?>>
<span id="el_document_text_TextBody">
<span<?php echo $document_text_view->TextBody->viewAttributes() ?>><?php echo $document_text_view->TextBody->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_text_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $document_text_view->TableLeftColumnClass ?>"><span id="elh_document_text_ID"><?php echo $document_text_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $document_text_view->ID->cellAttributes() ?>>
<span id="el_document_text_ID">
<span<?php echo $document_text_view->ID->viewAttributes() ?>><?php echo $document_text_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_text_view->Ref->Visible) { // Ref ?>
	<tr id="r_Ref">
		<td class="<?php echo $document_text_view->TableLeftColumnClass ?>"><span id="elh_document_text_Ref"><?php echo $document_text_view->Ref->caption() ?></span></td>
		<td data-name="Ref" <?php echo $document_text_view->Ref->cellAttributes() ?>>
<span id="el_document_text_Ref">
<span<?php echo $document_text_view->Ref->viewAttributes() ?>><?php echo $document_text_view->Ref->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$document_text_view->IsModal) { ?>
<?php if (!$document_text_view->isExport()) { ?>
<?php echo $document_text_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$document_text_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$document_text_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$document_text_view->terminate();
?>