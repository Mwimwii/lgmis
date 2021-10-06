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
$property_account_list = new property_account_list();

// Run the page
$property_account_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_account_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_account_list->isExport()) { ?>
<script>
var fproperty_accountlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_accountlist = currentForm = new ew.Form("fproperty_accountlist", "list");
	fproperty_accountlist.formKeyCountName = '<?php echo $property_account_list->FormKeyCountName ?>';

	// Validate form
	fproperty_accountlist.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($property_account_list->AccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->AccountNo->caption(), $property_account_list->AccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->ValuationNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValuationNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->ValuationNo->caption(), $property_account_list->ValuationNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->ChargeCode->caption(), $property_account_list->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->BalanceBF->caption(), $property_account_list->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->CurrentDemand->caption(), $property_account_list->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->VAT->caption(), $property_account_list->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->AmountPaid->caption(), $property_account_list->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->BillPeriod->caption(), $property_account_list->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->BillYear->caption(), $property_account_list->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->ClientSerNo->caption(), $property_account_list->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->AmountDue->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountDue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->AmountDue->caption(), $property_account_list->AmountDue->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_account_list->AmountBeingPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountBeingPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->AmountBeingPaid->caption(), $property_account_list->AmountBeingPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountBeingPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_account_list->AmountBeingPaid->errorMessage()) ?>");
			<?php if ($property_account_list->PayIndicator->Required) { ?>
				elm = this.getElements("x" + infix + "_PayIndicator");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_account_list->PayIndicator->caption(), $property_account_list->PayIndicator->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fproperty_accountlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_accountlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fproperty_accountlist.lists["x_ChargeCode"] = <?php echo $property_account_list->ChargeCode->Lookup->toClientList($property_account_list) ?>;
	fproperty_accountlist.lists["x_ChargeCode"].options = <?php echo JsonEncode($property_account_list->ChargeCode->lookupOptions()) ?>;
	fproperty_accountlist.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fproperty_accountlist.lists["x_ClientSerNo"] = <?php echo $property_account_list->ClientSerNo->Lookup->toClientList($property_account_list) ?>;
	fproperty_accountlist.lists["x_ClientSerNo"].options = <?php echo JsonEncode($property_account_list->ClientSerNo->lookupOptions()) ?>;
	fproperty_accountlist.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fproperty_accountlist.lists["x_PayIndicator"] = <?php echo $property_account_list->PayIndicator->Lookup->toClientList($property_account_list) ?>;
	fproperty_accountlist.lists["x_PayIndicator"].options = <?php echo JsonEncode($property_account_list->PayIndicator->lookupOptions()) ?>;
	loadjs.done("fproperty_accountlist");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = true;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_account_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_account_list->TotalRecords > 0 && $property_account_list->ExportOptions->visible()) { ?>
<?php $property_account_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_account_list->ImportOptions->visible()) { ?>
<?php $property_account_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$property_account_list->renderOtherOptions();
?>
<?php $property_account_list->showPageHeader(); ?>
<?php
$property_account_list->showMessage();
?>
<?php if ($property_account_list->TotalRecords > 0 || $property_account->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_account_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_account">
<?php if (!$property_account_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_accountlist" id="fproperty_accountlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_account">
<div id="gmp_property_account" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_account_list->TotalRecords > 0 || $property_account_list->isGridEdit()) { ?>
<table id="tbl_property_accountlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_account->RowType = ROWTYPE_HEADER;

// Render list options
$property_account_list->renderListOptions();

// Render list options (header, left)
$property_account_list->ListOptions->render("header", "left");
?>
<?php if ($property_account_list->AccountNo->Visible) { // AccountNo ?>
	<?php if ($property_account_list->SortUrl($property_account_list->AccountNo) == "") { ?>
		<th data-name="AccountNo" class="<?php echo $property_account_list->AccountNo->headerCellClass() ?>"><div id="elh_property_account_AccountNo" class="property_account_AccountNo"><div class="ew-table-header-caption"><?php echo $property_account_list->AccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountNo" class="<?php echo $property_account_list->AccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->AccountNo) ?>', 1);"><div id="elh_property_account_AccountNo" class="property_account_AccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->AccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->AccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->AccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($property_account_list->SortUrl($property_account_list->ValuationNo) == "") { ?>
		<th data-name="ValuationNo" class="<?php echo $property_account_list->ValuationNo->headerCellClass() ?>"><div id="elh_property_account_ValuationNo" class="property_account_ValuationNo"><div class="ew-table-header-caption"><?php echo $property_account_list->ValuationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationNo" class="<?php echo $property_account_list->ValuationNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->ValuationNo) ?>', 1);"><div id="elh_property_account_ValuationNo" class="property_account_ValuationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->ValuationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->ValuationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($property_account_list->SortUrl($property_account_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $property_account_list->ChargeCode->headerCellClass() ?>"><div id="elh_property_account_ChargeCode" class="property_account_ChargeCode"><div class="ew-table-header-caption"><?php echo $property_account_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $property_account_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->ChargeCode) ?>', 1);"><div id="elh_property_account_ChargeCode" class="property_account_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($property_account_list->SortUrl($property_account_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $property_account_list->BalanceBF->headerCellClass() ?>"><div id="elh_property_account_BalanceBF" class="property_account_BalanceBF"><div class="ew-table-header-caption"><?php echo $property_account_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $property_account_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->BalanceBF) ?>', 1);"><div id="elh_property_account_BalanceBF" class="property_account_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($property_account_list->SortUrl($property_account_list->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $property_account_list->CurrentDemand->headerCellClass() ?>"><div id="elh_property_account_CurrentDemand" class="property_account_CurrentDemand"><div class="ew-table-header-caption"><?php echo $property_account_list->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $property_account_list->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->CurrentDemand) ?>', 1);"><div id="elh_property_account_CurrentDemand" class="property_account_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->VAT->Visible) { // VAT ?>
	<?php if ($property_account_list->SortUrl($property_account_list->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $property_account_list->VAT->headerCellClass() ?>"><div id="elh_property_account_VAT" class="property_account_VAT"><div class="ew-table-header-caption"><?php echo $property_account_list->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $property_account_list->VAT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->VAT) ?>', 1);"><div id="elh_property_account_VAT" class="property_account_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property_account_list->SortUrl($property_account_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $property_account_list->AmountPaid->headerCellClass() ?>"><div id="elh_property_account_AmountPaid" class="property_account_AmountPaid"><div class="ew-table-header-caption"><?php echo $property_account_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $property_account_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->AmountPaid) ?>', 1);"><div id="elh_property_account_AmountPaid" class="property_account_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($property_account_list->SortUrl($property_account_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $property_account_list->BillPeriod->headerCellClass() ?>"><div id="elh_property_account_BillPeriod" class="property_account_BillPeriod"><div class="ew-table-header-caption"><?php echo $property_account_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $property_account_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->BillPeriod) ?>', 1);"><div id="elh_property_account_BillPeriod" class="property_account_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->BillYear->Visible) { // BillYear ?>
	<?php if ($property_account_list->SortUrl($property_account_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $property_account_list->BillYear->headerCellClass() ?>"><div id="elh_property_account_BillYear" class="property_account_BillYear"><div class="ew-table-header-caption"><?php echo $property_account_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $property_account_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->BillYear) ?>', 1);"><div id="elh_property_account_BillYear" class="property_account_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($property_account_list->SortUrl($property_account_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_account_list->ClientSerNo->headerCellClass() ?>"><div id="elh_property_account_ClientSerNo" class="property_account_ClientSerNo"><div class="ew-table-header-caption"><?php echo $property_account_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_account_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->ClientSerNo) ?>', 1);"><div id="elh_property_account_ClientSerNo" class="property_account_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->AmountDue->Visible) { // AmountDue ?>
	<?php if ($property_account_list->SortUrl($property_account_list->AmountDue) == "") { ?>
		<th data-name="AmountDue" class="<?php echo $property_account_list->AmountDue->headerCellClass() ?>"><div id="elh_property_account_AmountDue" class="property_account_AmountDue"><div class="ew-table-header-caption"><?php echo $property_account_list->AmountDue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountDue" class="<?php echo $property_account_list->AmountDue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->AmountDue) ?>', 1);"><div id="elh_property_account_AmountDue" class="property_account_AmountDue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->AmountDue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->AmountDue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->AmountDue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->AmountBeingPaid->Visible) { // AmountBeingPaid ?>
	<?php if ($property_account_list->SortUrl($property_account_list->AmountBeingPaid) == "") { ?>
		<th data-name="AmountBeingPaid" class="<?php echo $property_account_list->AmountBeingPaid->headerCellClass() ?>"><div id="elh_property_account_AmountBeingPaid" class="property_account_AmountBeingPaid"><div class="ew-table-header-caption"><?php echo $property_account_list->AmountBeingPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountBeingPaid" class="<?php echo $property_account_list->AmountBeingPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->AmountBeingPaid) ?>', 1);"><div id="elh_property_account_AmountBeingPaid" class="property_account_AmountBeingPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->AmountBeingPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->AmountBeingPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->AmountBeingPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_account_list->PayIndicator->Visible) { // PayIndicator ?>
	<?php if ($property_account_list->SortUrl($property_account_list->PayIndicator) == "") { ?>
		<th data-name="PayIndicator" class="<?php echo $property_account_list->PayIndicator->headerCellClass() ?>"><div id="elh_property_account_PayIndicator" class="property_account_PayIndicator"><div class="ew-table-header-caption"><?php echo $property_account_list->PayIndicator->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayIndicator" class="<?php echo $property_account_list->PayIndicator->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_account_list->SortUrl($property_account_list->PayIndicator) ?>', 1);"><div id="elh_property_account_PayIndicator" class="property_account_PayIndicator">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_account_list->PayIndicator->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_account_list->PayIndicator->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_account_list->PayIndicator->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_account_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_account_list->ExportAll && $property_account_list->isExport()) {
	$property_account_list->StopRecord = $property_account_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_account_list->TotalRecords > $property_account_list->StartRecord + $property_account_list->DisplayRecords - 1)
		$property_account_list->StopRecord = $property_account_list->StartRecord + $property_account_list->DisplayRecords - 1;
	else
		$property_account_list->StopRecord = $property_account_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($property_account->isConfirm() || $property_account_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($property_account_list->FormKeyCountName) && ($property_account_list->isGridAdd() || $property_account_list->isGridEdit() || $property_account->isConfirm())) {
		$property_account_list->KeyCount = $CurrentForm->getValue($property_account_list->FormKeyCountName);
		$property_account_list->StopRecord = $property_account_list->StartRecord + $property_account_list->KeyCount - 1;
	}
}
$property_account_list->RecordCount = $property_account_list->StartRecord - 1;
if ($property_account_list->Recordset && !$property_account_list->Recordset->EOF) {
	$property_account_list->Recordset->moveFirst();
	$selectLimit = $property_account_list->UseSelectLimit;
	if (!$selectLimit && $property_account_list->StartRecord > 1)
		$property_account_list->Recordset->move($property_account_list->StartRecord - 1);
} elseif (!$property_account->AllowAddDeleteRow && $property_account_list->StopRecord == 0) {
	$property_account_list->StopRecord = $property_account->GridAddRowCount;
}

// Initialize aggregate
$property_account->RowType = ROWTYPE_AGGREGATEINIT;
$property_account->resetAttributes();
$property_account_list->renderRow();
if ($property_account_list->isGridEdit())
	$property_account_list->RowIndex = 0;
while ($property_account_list->RecordCount < $property_account_list->StopRecord) {
	$property_account_list->RecordCount++;
	if ($property_account_list->RecordCount >= $property_account_list->StartRecord) {
		$property_account_list->RowCount++;
		if ($property_account_list->isGridAdd() || $property_account_list->isGridEdit() || $property_account->isConfirm()) {
			$property_account_list->RowIndex++;
			$CurrentForm->Index = $property_account_list->RowIndex;
			if ($CurrentForm->hasValue($property_account_list->FormActionName) && ($property_account->isConfirm() || $property_account_list->EventCancelled))
				$property_account_list->RowAction = strval($CurrentForm->getValue($property_account_list->FormActionName));
			elseif ($property_account_list->isGridAdd())
				$property_account_list->RowAction = "insert";
			else
				$property_account_list->RowAction = "";
		}

		// Set up key count
		$property_account_list->KeyCount = $property_account_list->RowIndex;

		// Init row class and style
		$property_account->resetAttributes();
		$property_account->CssClass = "";
		if ($property_account_list->isGridAdd()) {
			$property_account_list->loadRowValues(); // Load default values
		} else {
			$property_account_list->loadRowValues($property_account_list->Recordset); // Load row values
		}
		$property_account->RowType = ROWTYPE_VIEW; // Render view
		if ($property_account_list->isGridEdit()) { // Grid edit
			if ($property_account->EventCancelled)
				$property_account_list->restoreCurrentRowFormValues($property_account_list->RowIndex); // Restore form values
			if ($property_account_list->RowAction == "insert")
				$property_account->RowType = ROWTYPE_ADD; // Render add
			else
				$property_account->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($property_account_list->isGridEdit() && ($property_account->RowType == ROWTYPE_EDIT || $property_account->RowType == ROWTYPE_ADD) && $property_account->EventCancelled) // Update failed
			$property_account_list->restoreCurrentRowFormValues($property_account_list->RowIndex); // Restore form values
		if ($property_account->RowType == ROWTYPE_EDIT) // Edit row
			$property_account_list->EditRowCount++;

		// Set up row id / data-rowindex
		$property_account->RowAttrs->merge(["data-rowindex" => $property_account_list->RowCount, "id" => "r" . $property_account_list->RowCount . "_property_account", "data-rowtype" => $property_account->RowType]);

		// Render row
		$property_account_list->renderRow();

		// Render list options
		$property_account_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($property_account_list->RowAction != "delete" && $property_account_list->RowAction != "insertdelete" && !($property_account_list->RowAction == "insert" && $property_account->isConfirm() && $property_account_list->emptyRow())) {
?>
	<tr <?php echo $property_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_account_list->ListOptions->render("body", "left", $property_account_list->RowCount);
?>
	<?php if ($property_account_list->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo" <?php echo $property_account_list->AccountNo->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AccountNo" class="form-group"></span>
<input type="hidden" data-table="property_account" data-field="x_AccountNo" name="o<?php echo $property_account_list->RowIndex ?>_AccountNo" id="o<?php echo $property_account_list->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($property_account_list->AccountNo->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AccountNo" class="form-group">
<span<?php echo $property_account_list->AccountNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_account_list->AccountNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_account" data-field="x_AccountNo" name="x<?php echo $property_account_list->RowIndex ?>_AccountNo" id="x<?php echo $property_account_list->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($property_account_list->AccountNo->CurrentValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AccountNo">
<span<?php echo $property_account_list->AccountNo->viewAttributes() ?>><?php echo $property_account_list->AccountNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" <?php echo $property_account_list->ValuationNo->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_ValuationNo" class="form-group">
<input type="text" data-table="property_account" data-field="x_ValuationNo" name="x<?php echo $property_account_list->RowIndex ?>_ValuationNo" id="x<?php echo $property_account_list->RowIndex ?>_ValuationNo" size="30" placeholder="<?php echo HtmlEncode($property_account_list->ValuationNo->getPlaceHolder()) ?>" value="<?php echo $property_account_list->ValuationNo->EditValue ?>"<?php echo $property_account_list->ValuationNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_ValuationNo" name="o<?php echo $property_account_list->RowIndex ?>_ValuationNo" id="o<?php echo $property_account_list->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_account_list->ValuationNo->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_ValuationNo" class="form-group">
<span<?php echo $property_account_list->ValuationNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_account_list->ValuationNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_account" data-field="x_ValuationNo" name="x<?php echo $property_account_list->RowIndex ?>_ValuationNo" id="x<?php echo $property_account_list->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_account_list->ValuationNo->CurrentValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_ValuationNo">
<span<?php echo $property_account_list->ValuationNo->viewAttributes() ?>><?php echo $property_account_list->ValuationNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $property_account_list->ChargeCode->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_ChargeCode" class="form-group">
<?php
$onchange = $property_account_list->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_account_list->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_account_list->RowIndex ?>_ChargeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $property_account_list->RowIndex ?>_ChargeCode" id="sv_x<?php echo $property_account_list->RowIndex ?>_ChargeCode" value="<?php echo RemoveHtml($property_account_list->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_account_list->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_account_list->ChargeCode->getPlaceHolder()) ?>"<?php echo $property_account_list->ChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_ChargeCode" data-value-separator="<?php echo $property_account_list->ChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_account_list->RowIndex ?>_ChargeCode" id="x<?php echo $property_account_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_account_list->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fproperty_accountlist"], function() {
	fproperty_accountlist.createAutoSuggest({"id":"x<?php echo $property_account_list->RowIndex ?>_ChargeCode","forceSelect":false});
});
</script>
<?php echo $property_account_list->ChargeCode->Lookup->getParamTag($property_account_list, "p_x" . $property_account_list->RowIndex . "_ChargeCode") ?>
</span>
<input type="hidden" data-table="property_account" data-field="x_ChargeCode" name="o<?php echo $property_account_list->RowIndex ?>_ChargeCode" id="o<?php echo $property_account_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_account_list->ChargeCode->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_ChargeCode" class="form-group">
<span<?php echo $property_account_list->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_account_list->ChargeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_account" data-field="x_ChargeCode" name="x<?php echo $property_account_list->RowIndex ?>_ChargeCode" id="x<?php echo $property_account_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_account_list->ChargeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_ChargeCode">
<span<?php echo $property_account_list->ChargeCode->viewAttributes() ?>><?php echo $property_account_list->ChargeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $property_account_list->BalanceBF->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_BalanceBF" class="form-group">
<input type="text" data-table="property_account" data-field="x_BalanceBF" name="x<?php echo $property_account_list->RowIndex ?>_BalanceBF" id="x<?php echo $property_account_list->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($property_account_list->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_account_list->BalanceBF->EditValue ?>"<?php echo $property_account_list->BalanceBF->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_BalanceBF" name="o<?php echo $property_account_list->RowIndex ?>_BalanceBF" id="o<?php echo $property_account_list->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_account_list->BalanceBF->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_BalanceBF" class="form-group">
<span<?php echo $property_account_list->BalanceBF->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_account_list->BalanceBF->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_account" data-field="x_BalanceBF" name="x<?php echo $property_account_list->RowIndex ?>_BalanceBF" id="x<?php echo $property_account_list->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_account_list->BalanceBF->CurrentValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_BalanceBF">
<span<?php echo $property_account_list->BalanceBF->viewAttributes() ?>><?php echo $property_account_list->BalanceBF->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $property_account_list->CurrentDemand->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_CurrentDemand" class="form-group">
<input type="text" data-table="property_account" data-field="x_CurrentDemand" name="x<?php echo $property_account_list->RowIndex ?>_CurrentDemand" id="x<?php echo $property_account_list->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($property_account_list->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $property_account_list->CurrentDemand->EditValue ?>"<?php echo $property_account_list->CurrentDemand->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_CurrentDemand" name="o<?php echo $property_account_list->RowIndex ?>_CurrentDemand" id="o<?php echo $property_account_list->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($property_account_list->CurrentDemand->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_CurrentDemand" class="form-group">
<span<?php echo $property_account_list->CurrentDemand->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_account_list->CurrentDemand->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_account" data-field="x_CurrentDemand" name="x<?php echo $property_account_list->RowIndex ?>_CurrentDemand" id="x<?php echo $property_account_list->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($property_account_list->CurrentDemand->CurrentValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_CurrentDemand">
<span<?php echo $property_account_list->CurrentDemand->viewAttributes() ?>><?php echo $property_account_list->CurrentDemand->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $property_account_list->VAT->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_VAT" class="form-group">
<input type="text" data-table="property_account" data-field="x_VAT" name="x<?php echo $property_account_list->RowIndex ?>_VAT" id="x<?php echo $property_account_list->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($property_account_list->VAT->getPlaceHolder()) ?>" value="<?php echo $property_account_list->VAT->EditValue ?>"<?php echo $property_account_list->VAT->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_VAT" name="o<?php echo $property_account_list->RowIndex ?>_VAT" id="o<?php echo $property_account_list->RowIndex ?>_VAT" value="<?php echo HtmlEncode($property_account_list->VAT->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_VAT" class="form-group">
<span<?php echo $property_account_list->VAT->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_account_list->VAT->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_account" data-field="x_VAT" name="x<?php echo $property_account_list->RowIndex ?>_VAT" id="x<?php echo $property_account_list->RowIndex ?>_VAT" value="<?php echo HtmlEncode($property_account_list->VAT->CurrentValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_VAT">
<span<?php echo $property_account_list->VAT->viewAttributes() ?>><?php echo $property_account_list->VAT->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $property_account_list->AmountPaid->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AmountPaid" class="form-group">
<input type="text" data-table="property_account" data-field="x_AmountPaid" name="x<?php echo $property_account_list->RowIndex ?>_AmountPaid" id="x<?php echo $property_account_list->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($property_account_list->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_account_list->AmountPaid->EditValue ?>"<?php echo $property_account_list->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_AmountPaid" name="o<?php echo $property_account_list->RowIndex ?>_AmountPaid" id="o<?php echo $property_account_list->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_account_list->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AmountPaid" class="form-group">
<span<?php echo $property_account_list->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_account_list->AmountPaid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_account" data-field="x_AmountPaid" name="x<?php echo $property_account_list->RowIndex ?>_AmountPaid" id="x<?php echo $property_account_list->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_account_list->AmountPaid->CurrentValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AmountPaid">
<span<?php echo $property_account_list->AmountPaid->viewAttributes() ?>><?php echo $property_account_list->AmountPaid->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $property_account_list->BillPeriod->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_BillPeriod" class="form-group">
<input type="text" data-table="property_account" data-field="x_BillPeriod" name="x<?php echo $property_account_list->RowIndex ?>_BillPeriod" id="x<?php echo $property_account_list->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($property_account_list->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $property_account_list->BillPeriod->EditValue ?>"<?php echo $property_account_list->BillPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_BillPeriod" name="o<?php echo $property_account_list->RowIndex ?>_BillPeriod" id="o<?php echo $property_account_list->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($property_account_list->BillPeriod->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_BillPeriod" class="form-group">
<span<?php echo $property_account_list->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_account_list->BillPeriod->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_account" data-field="x_BillPeriod" name="x<?php echo $property_account_list->RowIndex ?>_BillPeriod" id="x<?php echo $property_account_list->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($property_account_list->BillPeriod->CurrentValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_BillPeriod">
<span<?php echo $property_account_list->BillPeriod->viewAttributes() ?>><?php echo $property_account_list->BillPeriod->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $property_account_list->BillYear->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_BillYear" class="form-group">
<input type="text" data-table="property_account" data-field="x_BillYear" name="x<?php echo $property_account_list->RowIndex ?>_BillYear" id="x<?php echo $property_account_list->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($property_account_list->BillYear->getPlaceHolder()) ?>" value="<?php echo $property_account_list->BillYear->EditValue ?>"<?php echo $property_account_list->BillYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_BillYear" name="o<?php echo $property_account_list->RowIndex ?>_BillYear" id="o<?php echo $property_account_list->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($property_account_list->BillYear->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_BillYear" class="form-group">
<span<?php echo $property_account_list->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_account_list->BillYear->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_account" data-field="x_BillYear" name="x<?php echo $property_account_list->RowIndex ?>_BillYear" id="x<?php echo $property_account_list->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($property_account_list->BillYear->CurrentValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_BillYear">
<span<?php echo $property_account_list->BillYear->viewAttributes() ?>><?php echo $property_account_list->BillYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $property_account_list->ClientSerNo->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="property_account" data-field="x_ClientSerNo" name="o<?php echo $property_account_list->RowIndex ?>_ClientSerNo" id="o<?php echo $property_account_list->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_account_list->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_ClientSerNo">
<span<?php echo $property_account_list->ClientSerNo->viewAttributes() ?>><?php echo $property_account_list->ClientSerNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->AmountDue->Visible) { // AmountDue ?>
		<td data-name="AmountDue" <?php echo $property_account_list->AmountDue->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AmountDue" class="form-group">
<input type="text" data-table="property_account" data-field="x_AmountDue" name="x<?php echo $property_account_list->RowIndex ?>_AmountDue" id="x<?php echo $property_account_list->RowIndex ?>_AmountDue" size="30" placeholder="<?php echo HtmlEncode($property_account_list->AmountDue->getPlaceHolder()) ?>" value="<?php echo $property_account_list->AmountDue->EditValue ?>"<?php echo $property_account_list->AmountDue->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_AmountDue" name="o<?php echo $property_account_list->RowIndex ?>_AmountDue" id="o<?php echo $property_account_list->RowIndex ?>_AmountDue" value="<?php echo HtmlEncode($property_account_list->AmountDue->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AmountDue" class="form-group">
<span<?php echo $property_account_list->AmountDue->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_account_list->AmountDue->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_account" data-field="x_AmountDue" name="x<?php echo $property_account_list->RowIndex ?>_AmountDue" id="x<?php echo $property_account_list->RowIndex ?>_AmountDue" value="<?php echo HtmlEncode($property_account_list->AmountDue->CurrentValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AmountDue">
<span<?php echo $property_account_list->AmountDue->viewAttributes() ?>><?php echo $property_account_list->AmountDue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->AmountBeingPaid->Visible) { // AmountBeingPaid ?>
		<td data-name="AmountBeingPaid" <?php echo $property_account_list->AmountBeingPaid->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AmountBeingPaid" class="form-group">
<input type="text" data-table="property_account" data-field="x_AmountBeingPaid" name="x<?php echo $property_account_list->RowIndex ?>_AmountBeingPaid" id="x<?php echo $property_account_list->RowIndex ?>_AmountBeingPaid" size="30" placeholder="<?php echo HtmlEncode($property_account_list->AmountBeingPaid->getPlaceHolder()) ?>" value="<?php echo $property_account_list->AmountBeingPaid->EditValue ?>"<?php echo $property_account_list->AmountBeingPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_AmountBeingPaid" name="o<?php echo $property_account_list->RowIndex ?>_AmountBeingPaid" id="o<?php echo $property_account_list->RowIndex ?>_AmountBeingPaid" value="<?php echo HtmlEncode($property_account_list->AmountBeingPaid->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AmountBeingPaid" class="form-group">
<input type="text" data-table="property_account" data-field="x_AmountBeingPaid" name="x<?php echo $property_account_list->RowIndex ?>_AmountBeingPaid" id="x<?php echo $property_account_list->RowIndex ?>_AmountBeingPaid" size="30" placeholder="<?php echo HtmlEncode($property_account_list->AmountBeingPaid->getPlaceHolder()) ?>" value="<?php echo $property_account_list->AmountBeingPaid->EditValue ?>"<?php echo $property_account_list->AmountBeingPaid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_AmountBeingPaid">
<span<?php echo $property_account_list->AmountBeingPaid->viewAttributes() ?>><?php echo $property_account_list->AmountBeingPaid->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_account_list->PayIndicator->Visible) { // PayIndicator ?>
		<td data-name="PayIndicator" <?php echo $property_account_list->PayIndicator->cellAttributes() ?>>
<?php if ($property_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_PayIndicator" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property_account" data-field="x_PayIndicator" data-value-separator="<?php echo $property_account_list->PayIndicator->displayValueSeparatorAttribute() ?>" id="x<?php echo $property_account_list->RowIndex ?>_PayIndicator" name="x<?php echo $property_account_list->RowIndex ?>_PayIndicator"<?php echo $property_account_list->PayIndicator->editAttributes() ?>>
			<?php echo $property_account_list->PayIndicator->selectOptionListHtml("x{$property_account_list->RowIndex}_PayIndicator") ?>
		</select>
</div>
<?php echo $property_account_list->PayIndicator->Lookup->getParamTag($property_account_list, "p_x" . $property_account_list->RowIndex . "_PayIndicator") ?>
</span>
<input type="hidden" data-table="property_account" data-field="x_PayIndicator" name="o<?php echo $property_account_list->RowIndex ?>_PayIndicator" id="o<?php echo $property_account_list->RowIndex ?>_PayIndicator" value="<?php echo HtmlEncode($property_account_list->PayIndicator->OldValue) ?>">
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_PayIndicator" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property_account" data-field="x_PayIndicator" data-value-separator="<?php echo $property_account_list->PayIndicator->displayValueSeparatorAttribute() ?>" id="x<?php echo $property_account_list->RowIndex ?>_PayIndicator" name="x<?php echo $property_account_list->RowIndex ?>_PayIndicator"<?php echo $property_account_list->PayIndicator->editAttributes() ?>>
			<?php echo $property_account_list->PayIndicator->selectOptionListHtml("x{$property_account_list->RowIndex}_PayIndicator") ?>
		</select>
</div>
<?php echo $property_account_list->PayIndicator->Lookup->getParamTag($property_account_list, "p_x" . $property_account_list->RowIndex . "_PayIndicator") ?>
</span>
<?php } ?>
<?php if ($property_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_account_list->RowCount ?>_property_account_PayIndicator">
<span<?php echo $property_account_list->PayIndicator->viewAttributes() ?>><?php echo $property_account_list->PayIndicator->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_account_list->ListOptions->render("body", "right", $property_account_list->RowCount);
?>
	</tr>
<?php if ($property_account->RowType == ROWTYPE_ADD || $property_account->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fproperty_accountlist", "load"], function() {
	fproperty_accountlist.updateLists(<?php echo $property_account_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$property_account_list->isGridAdd())
		if (!$property_account_list->Recordset->EOF)
			$property_account_list->Recordset->moveNext();
}
?>
<?php
	if ($property_account_list->isGridAdd() || $property_account_list->isGridEdit()) {
		$property_account_list->RowIndex = '$rowindex$';
		$property_account_list->loadRowValues();

		// Set row properties
		$property_account->resetAttributes();
		$property_account->RowAttrs->merge(["data-rowindex" => $property_account_list->RowIndex, "id" => "r0_property_account", "data-rowtype" => ROWTYPE_ADD]);
		$property_account->RowAttrs->appendClass("ew-template");
		$property_account->RowType = ROWTYPE_ADD;

		// Render row
		$property_account_list->renderRow();

		// Render list options
		$property_account_list->renderListOptions();
		$property_account_list->StartRowCount = 0;
?>
	<tr <?php echo $property_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_account_list->ListOptions->render("body", "left", $property_account_list->RowIndex);
?>
	<?php if ($property_account_list->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo">
<span id="el$rowindex$_property_account_AccountNo" class="form-group property_account_AccountNo"></span>
<input type="hidden" data-table="property_account" data-field="x_AccountNo" name="o<?php echo $property_account_list->RowIndex ?>_AccountNo" id="o<?php echo $property_account_list->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($property_account_list->AccountNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo">
<span id="el$rowindex$_property_account_ValuationNo" class="form-group property_account_ValuationNo">
<input type="text" data-table="property_account" data-field="x_ValuationNo" name="x<?php echo $property_account_list->RowIndex ?>_ValuationNo" id="x<?php echo $property_account_list->RowIndex ?>_ValuationNo" size="30" placeholder="<?php echo HtmlEncode($property_account_list->ValuationNo->getPlaceHolder()) ?>" value="<?php echo $property_account_list->ValuationNo->EditValue ?>"<?php echo $property_account_list->ValuationNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_ValuationNo" name="o<?php echo $property_account_list->RowIndex ?>_ValuationNo" id="o<?php echo $property_account_list->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_account_list->ValuationNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode">
<span id="el$rowindex$_property_account_ChargeCode" class="form-group property_account_ChargeCode">
<?php
$onchange = $property_account_list->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_account_list->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_account_list->RowIndex ?>_ChargeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $property_account_list->RowIndex ?>_ChargeCode" id="sv_x<?php echo $property_account_list->RowIndex ?>_ChargeCode" value="<?php echo RemoveHtml($property_account_list->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_account_list->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_account_list->ChargeCode->getPlaceHolder()) ?>"<?php echo $property_account_list->ChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_ChargeCode" data-value-separator="<?php echo $property_account_list->ChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_account_list->RowIndex ?>_ChargeCode" id="x<?php echo $property_account_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_account_list->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fproperty_accountlist"], function() {
	fproperty_accountlist.createAutoSuggest({"id":"x<?php echo $property_account_list->RowIndex ?>_ChargeCode","forceSelect":false});
});
</script>
<?php echo $property_account_list->ChargeCode->Lookup->getParamTag($property_account_list, "p_x" . $property_account_list->RowIndex . "_ChargeCode") ?>
</span>
<input type="hidden" data-table="property_account" data-field="x_ChargeCode" name="o<?php echo $property_account_list->RowIndex ?>_ChargeCode" id="o<?php echo $property_account_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_account_list->ChargeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF">
<span id="el$rowindex$_property_account_BalanceBF" class="form-group property_account_BalanceBF">
<input type="text" data-table="property_account" data-field="x_BalanceBF" name="x<?php echo $property_account_list->RowIndex ?>_BalanceBF" id="x<?php echo $property_account_list->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($property_account_list->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_account_list->BalanceBF->EditValue ?>"<?php echo $property_account_list->BalanceBF->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_BalanceBF" name="o<?php echo $property_account_list->RowIndex ?>_BalanceBF" id="o<?php echo $property_account_list->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_account_list->BalanceBF->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand">
<span id="el$rowindex$_property_account_CurrentDemand" class="form-group property_account_CurrentDemand">
<input type="text" data-table="property_account" data-field="x_CurrentDemand" name="x<?php echo $property_account_list->RowIndex ?>_CurrentDemand" id="x<?php echo $property_account_list->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($property_account_list->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $property_account_list->CurrentDemand->EditValue ?>"<?php echo $property_account_list->CurrentDemand->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_CurrentDemand" name="o<?php echo $property_account_list->RowIndex ?>_CurrentDemand" id="o<?php echo $property_account_list->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($property_account_list->CurrentDemand->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT">
<span id="el$rowindex$_property_account_VAT" class="form-group property_account_VAT">
<input type="text" data-table="property_account" data-field="x_VAT" name="x<?php echo $property_account_list->RowIndex ?>_VAT" id="x<?php echo $property_account_list->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($property_account_list->VAT->getPlaceHolder()) ?>" value="<?php echo $property_account_list->VAT->EditValue ?>"<?php echo $property_account_list->VAT->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_VAT" name="o<?php echo $property_account_list->RowIndex ?>_VAT" id="o<?php echo $property_account_list->RowIndex ?>_VAT" value="<?php echo HtmlEncode($property_account_list->VAT->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<span id="el$rowindex$_property_account_AmountPaid" class="form-group property_account_AmountPaid">
<input type="text" data-table="property_account" data-field="x_AmountPaid" name="x<?php echo $property_account_list->RowIndex ?>_AmountPaid" id="x<?php echo $property_account_list->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($property_account_list->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_account_list->AmountPaid->EditValue ?>"<?php echo $property_account_list->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_AmountPaid" name="o<?php echo $property_account_list->RowIndex ?>_AmountPaid" id="o<?php echo $property_account_list->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_account_list->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod">
<span id="el$rowindex$_property_account_BillPeriod" class="form-group property_account_BillPeriod">
<input type="text" data-table="property_account" data-field="x_BillPeriod" name="x<?php echo $property_account_list->RowIndex ?>_BillPeriod" id="x<?php echo $property_account_list->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($property_account_list->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $property_account_list->BillPeriod->EditValue ?>"<?php echo $property_account_list->BillPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_BillPeriod" name="o<?php echo $property_account_list->RowIndex ?>_BillPeriod" id="o<?php echo $property_account_list->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($property_account_list->BillPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear">
<span id="el$rowindex$_property_account_BillYear" class="form-group property_account_BillYear">
<input type="text" data-table="property_account" data-field="x_BillYear" name="x<?php echo $property_account_list->RowIndex ?>_BillYear" id="x<?php echo $property_account_list->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($property_account_list->BillYear->getPlaceHolder()) ?>" value="<?php echo $property_account_list->BillYear->EditValue ?>"<?php echo $property_account_list->BillYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_BillYear" name="o<?php echo $property_account_list->RowIndex ?>_BillYear" id="o<?php echo $property_account_list->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($property_account_list->BillYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo">
<input type="hidden" data-table="property_account" data-field="x_ClientSerNo" name="o<?php echo $property_account_list->RowIndex ?>_ClientSerNo" id="o<?php echo $property_account_list->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_account_list->ClientSerNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->AmountDue->Visible) { // AmountDue ?>
		<td data-name="AmountDue">
<span id="el$rowindex$_property_account_AmountDue" class="form-group property_account_AmountDue">
<input type="text" data-table="property_account" data-field="x_AmountDue" name="x<?php echo $property_account_list->RowIndex ?>_AmountDue" id="x<?php echo $property_account_list->RowIndex ?>_AmountDue" size="30" placeholder="<?php echo HtmlEncode($property_account_list->AmountDue->getPlaceHolder()) ?>" value="<?php echo $property_account_list->AmountDue->EditValue ?>"<?php echo $property_account_list->AmountDue->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_AmountDue" name="o<?php echo $property_account_list->RowIndex ?>_AmountDue" id="o<?php echo $property_account_list->RowIndex ?>_AmountDue" value="<?php echo HtmlEncode($property_account_list->AmountDue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->AmountBeingPaid->Visible) { // AmountBeingPaid ?>
		<td data-name="AmountBeingPaid">
<span id="el$rowindex$_property_account_AmountBeingPaid" class="form-group property_account_AmountBeingPaid">
<input type="text" data-table="property_account" data-field="x_AmountBeingPaid" name="x<?php echo $property_account_list->RowIndex ?>_AmountBeingPaid" id="x<?php echo $property_account_list->RowIndex ?>_AmountBeingPaid" size="30" placeholder="<?php echo HtmlEncode($property_account_list->AmountBeingPaid->getPlaceHolder()) ?>" value="<?php echo $property_account_list->AmountBeingPaid->EditValue ?>"<?php echo $property_account_list->AmountBeingPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_account" data-field="x_AmountBeingPaid" name="o<?php echo $property_account_list->RowIndex ?>_AmountBeingPaid" id="o<?php echo $property_account_list->RowIndex ?>_AmountBeingPaid" value="<?php echo HtmlEncode($property_account_list->AmountBeingPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_account_list->PayIndicator->Visible) { // PayIndicator ?>
		<td data-name="PayIndicator">
<span id="el$rowindex$_property_account_PayIndicator" class="form-group property_account_PayIndicator">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property_account" data-field="x_PayIndicator" data-value-separator="<?php echo $property_account_list->PayIndicator->displayValueSeparatorAttribute() ?>" id="x<?php echo $property_account_list->RowIndex ?>_PayIndicator" name="x<?php echo $property_account_list->RowIndex ?>_PayIndicator"<?php echo $property_account_list->PayIndicator->editAttributes() ?>>
			<?php echo $property_account_list->PayIndicator->selectOptionListHtml("x{$property_account_list->RowIndex}_PayIndicator") ?>
		</select>
</div>
<?php echo $property_account_list->PayIndicator->Lookup->getParamTag($property_account_list, "p_x" . $property_account_list->RowIndex . "_PayIndicator") ?>
</span>
<input type="hidden" data-table="property_account" data-field="x_PayIndicator" name="o<?php echo $property_account_list->RowIndex ?>_PayIndicator" id="o<?php echo $property_account_list->RowIndex ?>_PayIndicator" value="<?php echo HtmlEncode($property_account_list->PayIndicator->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_account_list->ListOptions->render("body", "right", $property_account_list->RowIndex);
?>
<script>
loadjs.ready(["fproperty_accountlist", "load"], function() {
	fproperty_accountlist.updateLists(<?php echo $property_account_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
<?php

// Render aggregate row
$property_account->RowType = ROWTYPE_AGGREGATE;
$property_account->resetAttributes();
$property_account_list->renderRow();
?>
<?php if ($property_account_list->TotalRecords > 0 && !$property_account_list->isGridAdd() && !$property_account_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$property_account_list->renderListOptions();

// Render list options (footer, left)
$property_account_list->ListOptions->render("footer", "left");
?>
	<?php if ($property_account_list->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo" class="<?php echo $property_account_list->AccountNo->footerCellClass() ?>"><span id="elf_property_account_AccountNo" class="property_account_AccountNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" class="<?php echo $property_account_list->ValuationNo->footerCellClass() ?>"><span id="elf_property_account_ValuationNo" class="property_account_ValuationNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" class="<?php echo $property_account_list->ChargeCode->footerCellClass() ?>"><span id="elf_property_account_ChargeCode" class="property_account_ChargeCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" class="<?php echo $property_account_list->BalanceBF->footerCellClass() ?>"><span id="elf_property_account_BalanceBF" class="property_account_BalanceBF">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" class="<?php echo $property_account_list->CurrentDemand->footerCellClass() ?>"><span id="elf_property_account_CurrentDemand" class="property_account_CurrentDemand">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" class="<?php echo $property_account_list->VAT->footerCellClass() ?>"><span id="elf_property_account_VAT" class="property_account_VAT">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" class="<?php echo $property_account_list->AmountPaid->footerCellClass() ?>"><span id="elf_property_account_AmountPaid" class="property_account_AmountPaid">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" class="<?php echo $property_account_list->BillPeriod->footerCellClass() ?>"><span id="elf_property_account_BillPeriod" class="property_account_BillPeriod">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" class="<?php echo $property_account_list->BillYear->footerCellClass() ?>"><span id="elf_property_account_BillYear" class="property_account_BillYear">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" class="<?php echo $property_account_list->ClientSerNo->footerCellClass() ?>"><span id="elf_property_account_ClientSerNo" class="property_account_ClientSerNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->AmountDue->Visible) { // AmountDue ?>
		<td data-name="AmountDue" class="<?php echo $property_account_list->AmountDue->footerCellClass() ?>"><span id="elf_property_account_AmountDue" class="property_account_AmountDue">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $property_account_list->AmountDue->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->AmountBeingPaid->Visible) { // AmountBeingPaid ?>
		<td data-name="AmountBeingPaid" class="<?php echo $property_account_list->AmountBeingPaid->footerCellClass() ?>"><span id="elf_property_account_AmountBeingPaid" class="property_account_AmountBeingPaid">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $property_account_list->AmountBeingPaid->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($property_account_list->PayIndicator->Visible) { // PayIndicator ?>
		<td data-name="PayIndicator" class="<?php echo $property_account_list->PayIndicator->footerCellClass() ?>"><span id="elf_property_account_PayIndicator" class="property_account_PayIndicator">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$property_account_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($property_account_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $property_account_list->FormKeyCountName ?>" id="<?php echo $property_account_list->FormKeyCountName ?>" value="<?php echo $property_account_list->KeyCount ?>">
<?php echo $property_account_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$property_account->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_account_list->Recordset)
	$property_account_list->Recordset->Close();
?>
<?php if (!$property_account_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_account_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_account_list->TotalRecords == 0 && !$property_account->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_account_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_account_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$property_account->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_property_account",
		width: "",
		height: ""
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$property_account_list->terminate();
?>