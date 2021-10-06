<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class ipc_tracking_delete extends ipc_tracking
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'ipc_tracking';

	// Page object name
	public $PageObjName = "ipc_tracking_delete";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (ipc_tracking)
		if (!isset($GLOBALS["ipc_tracking"]) || get_class($GLOBALS["ipc_tracking"]) == PROJECT_NAMESPACE . "ipc_tracking") {
			$GLOBALS["ipc_tracking"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ipc_tracking"];
		}

		// Table object (contract)
		if (!isset($GLOBALS['contract']))
			$GLOBALS['contract'] = new contract();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ipc_tracking');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (musers)
		$UserTable = $UserTable ?: new musers();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $ipc_tracking;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ipc_tracking);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['IPCNo'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->IPCNo->Visible = FALSE;
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $TotalRecords = 0;
	public $RecordCount;
	public $RecKeys = [];
	public $StartRowCount = 1;
	public $RowCount = 0;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canDelete()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (IsPasswordExpired())
				$this->terminate(GetUrl("changepwd.php"));
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canDelete()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("ipc_trackinglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		$this->IPCNo->setVisibility();
		$this->ContractNo->setVisibility();
		$this->ContractAuthorizedByAG->setVisibility();
		$this->VATApplied->setVisibility();
		$this->ArithmeticCheckDone->setVisibility();
		$this->VariationsApproved->setVisibility();
		$this->PerformanceBondValidUntil->setVisibility();
		$this->AdvancePaymentBondValidUntil->setVisibility();
		$this->RetentionDeductionClause->setVisibility();
		$this->RetentionDeducted->setVisibility();
		$this->LiquidatedDamagesDeducted->setVisibility();
		$this->LiquidatedPenaltiesDeducted->Visible = FALSE;
		$this->AdvancedPaymentDeducted->setVisibility();
		$this->CurrentProgressReportAttached->setVisibility();
		$this->CurrentProgressReport->Visible = FALSE;
		$this->DateOfSiteInspection->setVisibility();
		$this->TimeExtensionAuthorized->setVisibility();
		$this->LabResultsChecked->setVisibility();
		$this->LabResults->Visible = FALSE;
		$this->TerminationNoticeGiven->setVisibility();
		$this->CopiesEmailedToMLG->setVisibility();
		$this->ContractStillValid->setVisibility();
		$this->DeskOfficer->setVisibility();
		$this->DeskOfficerDate->setVisibility();
		$this->SupervisingEngineer->setVisibility();
		$this->EngineerDate->setVisibility();
		$this->CouncilSecretary->setVisibility();
		$this->CSDate->setVisibility();
		$this->MLGComments->Visible = FALSE;
		$this->ContractType->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check permission

		if (!$Security->canDelete()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("ipc_trackinglist.php");
			return;
		}

		// Set up master/detail parameters
		$this->setupMasterParms();

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		$filter = $this->getFilterFromRecordKeys();
		if ($filter == "") {
			$this->terminate("ipc_trackinglist.php"); // Prevent SQL injection, return to list
			return;
		}

		// Set up filter (WHERE Clause)
		$this->CurrentFilter = $filter;

		// Get action
		if (IsApi()) {
			$this->CurrentAction = "delete"; // Delete record directly
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action");
		} elseif (Get("action") == "1") {
			$this->CurrentAction = "delete"; // Delete record directly
		} else {
			$this->CurrentAction = "show"; // Display record
		}
		if ($this->isDelete()) {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->deleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
				if (IsApi()) {
					$this->terminate(TRUE);
					return;
				} else {
					$this->terminate($this->getReturnUrl()); // Return to caller
				}
			} else { // Delete failed
				if (IsApi()) {
					$this->terminate();
					return;
				}
				$this->CurrentAction = "show"; // Display record
			}
		}
		if ($this->isShow()) { // Load records for display
			if ($this->Recordset = $this->loadRecordset())
				$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->close();
				$this->terminate("ipc_trackinglist.php"); // Return to list
			}
		}
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->IPCNo->setDbValue($row['IPCNo']);
		$this->ContractNo->setDbValue($row['ContractNo']);
		$this->ContractAuthorizedByAG->setDbValue($row['ContractAuthorizedByAG']);
		$this->VATApplied->setDbValue($row['VATApplied']);
		$this->ArithmeticCheckDone->setDbValue($row['ArithmeticCheckDone']);
		$this->VariationsApproved->setDbValue($row['VariationsApproved']);
		$this->PerformanceBondValidUntil->setDbValue($row['PerformanceBondValidUntil']);
		$this->AdvancePaymentBondValidUntil->setDbValue($row['AdvancePaymentBondValidUntil']);
		$this->RetentionDeductionClause->setDbValue($row['RetentionDeductionClause']);
		$this->RetentionDeducted->setDbValue($row['RetentionDeducted']);
		$this->LiquidatedDamagesDeducted->setDbValue($row['LiquidatedDamagesDeducted']);
		$this->LiquidatedPenaltiesDeducted->setDbValue($row['LiquidatedPenaltiesDeducted']);
		$this->AdvancedPaymentDeducted->setDbValue($row['AdvancedPaymentDeducted']);
		$this->CurrentProgressReportAttached->setDbValue($row['CurrentProgressReportAttached']);
		$this->CurrentProgressReport->Upload->DbValue = $row['CurrentProgressReport'];
		if (is_array($this->CurrentProgressReport->Upload->DbValue) || is_object($this->CurrentProgressReport->Upload->DbValue)) // Byte array
			$this->CurrentProgressReport->Upload->DbValue = BytesToString($this->CurrentProgressReport->Upload->DbValue);
		$this->DateOfSiteInspection->setDbValue($row['DateOfSiteInspection']);
		$this->TimeExtensionAuthorized->setDbValue($row['TimeExtensionAuthorized']);
		$this->LabResultsChecked->setDbValue($row['LabResultsChecked']);
		$this->LabResults->Upload->DbValue = $row['LabResults'];
		if (is_array($this->LabResults->Upload->DbValue) || is_object($this->LabResults->Upload->DbValue)) // Byte array
			$this->LabResults->Upload->DbValue = BytesToString($this->LabResults->Upload->DbValue);
		$this->TerminationNoticeGiven->setDbValue($row['TerminationNoticeGiven']);
		$this->CopiesEmailedToMLG->setDbValue($row['CopiesEmailedToMLG']);
		$this->ContractStillValid->setDbValue($row['ContractStillValid']);
		$this->DeskOfficer->setDbValue($row['DeskOfficer']);
		$this->DeskOfficerDate->setDbValue($row['DeskOfficerDate']);
		$this->SupervisingEngineer->setDbValue($row['SupervisingEngineer']);
		$this->EngineerDate->setDbValue($row['EngineerDate']);
		$this->CouncilSecretary->setDbValue($row['CouncilSecretary']);
		$this->CSDate->setDbValue($row['CSDate']);
		$this->MLGComments->setDbValue($row['MLGComments']);
		$this->ContractType->setDbValue($row['ContractType']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['IPCNo'] = NULL;
		$row['ContractNo'] = NULL;
		$row['ContractAuthorizedByAG'] = NULL;
		$row['VATApplied'] = NULL;
		$row['ArithmeticCheckDone'] = NULL;
		$row['VariationsApproved'] = NULL;
		$row['PerformanceBondValidUntil'] = NULL;
		$row['AdvancePaymentBondValidUntil'] = NULL;
		$row['RetentionDeductionClause'] = NULL;
		$row['RetentionDeducted'] = NULL;
		$row['LiquidatedDamagesDeducted'] = NULL;
		$row['LiquidatedPenaltiesDeducted'] = NULL;
		$row['AdvancedPaymentDeducted'] = NULL;
		$row['CurrentProgressReportAttached'] = NULL;
		$row['CurrentProgressReport'] = NULL;
		$row['DateOfSiteInspection'] = NULL;
		$row['TimeExtensionAuthorized'] = NULL;
		$row['LabResultsChecked'] = NULL;
		$row['LabResults'] = NULL;
		$row['TerminationNoticeGiven'] = NULL;
		$row['CopiesEmailedToMLG'] = NULL;
		$row['ContractStillValid'] = NULL;
		$row['DeskOfficer'] = NULL;
		$row['DeskOfficerDate'] = NULL;
		$row['SupervisingEngineer'] = NULL;
		$row['EngineerDate'] = NULL;
		$row['CouncilSecretary'] = NULL;
		$row['CSDate'] = NULL;
		$row['MLGComments'] = NULL;
		$row['ContractType'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// IPCNo
		// ContractNo
		// ContractAuthorizedByAG
		// VATApplied
		// ArithmeticCheckDone
		// VariationsApproved
		// PerformanceBondValidUntil
		// AdvancePaymentBondValidUntil
		// RetentionDeductionClause
		// RetentionDeducted
		// LiquidatedDamagesDeducted
		// LiquidatedPenaltiesDeducted
		// AdvancedPaymentDeducted
		// CurrentProgressReportAttached
		// CurrentProgressReport
		// DateOfSiteInspection
		// TimeExtensionAuthorized
		// LabResultsChecked
		// LabResults
		// TerminationNoticeGiven
		// CopiesEmailedToMLG
		// ContractStillValid
		// DeskOfficer
		// DeskOfficerDate
		// SupervisingEngineer
		// EngineerDate
		// CouncilSecretary
		// CSDate
		// MLGComments
		// ContractType

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// IPCNo
			$this->IPCNo->ViewValue = $this->IPCNo->CurrentValue;
			$this->IPCNo->ViewCustomAttributes = "";

			// ContractNo
			$this->ContractNo->ViewValue = $this->ContractNo->CurrentValue;
			$this->ContractNo->ViewCustomAttributes = "";

			// ContractAuthorizedByAG
			if (ConvertToBool($this->ContractAuthorizedByAG->CurrentValue)) {
				$this->ContractAuthorizedByAG->ViewValue = $this->ContractAuthorizedByAG->tagCaption(1) != "" ? $this->ContractAuthorizedByAG->tagCaption(1) : "Yes";
			} else {
				$this->ContractAuthorizedByAG->ViewValue = $this->ContractAuthorizedByAG->tagCaption(2) != "" ? $this->ContractAuthorizedByAG->tagCaption(2) : "No";
			}
			$this->ContractAuthorizedByAG->ViewCustomAttributes = "";

			// VATApplied
			if (ConvertToBool($this->VATApplied->CurrentValue)) {
				$this->VATApplied->ViewValue = $this->VATApplied->tagCaption(1) != "" ? $this->VATApplied->tagCaption(1) : "Yes";
			} else {
				$this->VATApplied->ViewValue = $this->VATApplied->tagCaption(2) != "" ? $this->VATApplied->tagCaption(2) : "No";
			}
			$this->VATApplied->ViewCustomAttributes = "";

			// ArithmeticCheckDone
			if (ConvertToBool($this->ArithmeticCheckDone->CurrentValue)) {
				$this->ArithmeticCheckDone->ViewValue = $this->ArithmeticCheckDone->tagCaption(1) != "" ? $this->ArithmeticCheckDone->tagCaption(1) : "Yes";
			} else {
				$this->ArithmeticCheckDone->ViewValue = $this->ArithmeticCheckDone->tagCaption(2) != "" ? $this->ArithmeticCheckDone->tagCaption(2) : "No";
			}
			$this->ArithmeticCheckDone->ViewCustomAttributes = "";

			// VariationsApproved
			if (ConvertToBool($this->VariationsApproved->CurrentValue)) {
				$this->VariationsApproved->ViewValue = $this->VariationsApproved->tagCaption(1) != "" ? $this->VariationsApproved->tagCaption(1) : "Yes";
			} else {
				$this->VariationsApproved->ViewValue = $this->VariationsApproved->tagCaption(2) != "" ? $this->VariationsApproved->tagCaption(2) : "No";
			}
			$this->VariationsApproved->ViewCustomAttributes = "";

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->ViewValue = $this->PerformanceBondValidUntil->CurrentValue;
			$this->PerformanceBondValidUntil->ViewValue = FormatDateTime($this->PerformanceBondValidUntil->ViewValue, 0);
			$this->PerformanceBondValidUntil->ViewCustomAttributes = "";

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->ViewValue = $this->AdvancePaymentBondValidUntil->CurrentValue;
			$this->AdvancePaymentBondValidUntil->ViewValue = FormatDateTime($this->AdvancePaymentBondValidUntil->ViewValue, 0);
			$this->AdvancePaymentBondValidUntil->ViewCustomAttributes = "";

			// RetentionDeductionClause
			$this->RetentionDeductionClause->ViewValue = $this->RetentionDeductionClause->CurrentValue;
			$this->RetentionDeductionClause->ViewCustomAttributes = "";

			// RetentionDeducted
			if (ConvertToBool($this->RetentionDeducted->CurrentValue)) {
				$this->RetentionDeducted->ViewValue = $this->RetentionDeducted->tagCaption(1) != "" ? $this->RetentionDeducted->tagCaption(1) : "Yes";
			} else {
				$this->RetentionDeducted->ViewValue = $this->RetentionDeducted->tagCaption(2) != "" ? $this->RetentionDeducted->tagCaption(2) : "No";
			}
			$this->RetentionDeducted->ViewCustomAttributes = "";

			// LiquidatedDamagesDeducted
			if (ConvertToBool($this->LiquidatedDamagesDeducted->CurrentValue)) {
				$this->LiquidatedDamagesDeducted->ViewValue = $this->LiquidatedDamagesDeducted->tagCaption(1) != "" ? $this->LiquidatedDamagesDeducted->tagCaption(1) : "Yes";
			} else {
				$this->LiquidatedDamagesDeducted->ViewValue = $this->LiquidatedDamagesDeducted->tagCaption(2) != "" ? $this->LiquidatedDamagesDeducted->tagCaption(2) : "No";
			}
			$this->LiquidatedDamagesDeducted->ViewCustomAttributes = "";

			// AdvancedPaymentDeducted
			if (ConvertToBool($this->AdvancedPaymentDeducted->CurrentValue)) {
				$this->AdvancedPaymentDeducted->ViewValue = $this->AdvancedPaymentDeducted->tagCaption(1) != "" ? $this->AdvancedPaymentDeducted->tagCaption(1) : "Yes";
			} else {
				$this->AdvancedPaymentDeducted->ViewValue = $this->AdvancedPaymentDeducted->tagCaption(2) != "" ? $this->AdvancedPaymentDeducted->tagCaption(2) : "No";
			}
			$this->AdvancedPaymentDeducted->ViewCustomAttributes = "";

			// CurrentProgressReportAttached
			if (ConvertToBool($this->CurrentProgressReportAttached->CurrentValue)) {
				$this->CurrentProgressReportAttached->ViewValue = $this->CurrentProgressReportAttached->tagCaption(1) != "" ? $this->CurrentProgressReportAttached->tagCaption(1) : "Yes";
			} else {
				$this->CurrentProgressReportAttached->ViewValue = $this->CurrentProgressReportAttached->tagCaption(2) != "" ? $this->CurrentProgressReportAttached->tagCaption(2) : "No";
			}
			$this->CurrentProgressReportAttached->ViewCustomAttributes = "";

			// DateOfSiteInspection
			$this->DateOfSiteInspection->ViewValue = $this->DateOfSiteInspection->CurrentValue;
			$this->DateOfSiteInspection->ViewValue = FormatDateTime($this->DateOfSiteInspection->ViewValue, 0);
			$this->DateOfSiteInspection->ViewCustomAttributes = "";

			// TimeExtensionAuthorized
			if (ConvertToBool($this->TimeExtensionAuthorized->CurrentValue)) {
				$this->TimeExtensionAuthorized->ViewValue = $this->TimeExtensionAuthorized->tagCaption(1) != "" ? $this->TimeExtensionAuthorized->tagCaption(1) : "Yes";
			} else {
				$this->TimeExtensionAuthorized->ViewValue = $this->TimeExtensionAuthorized->tagCaption(2) != "" ? $this->TimeExtensionAuthorized->tagCaption(2) : "No";
			}
			$this->TimeExtensionAuthorized->ViewCustomAttributes = "";

			// LabResultsChecked
			if (ConvertToBool($this->LabResultsChecked->CurrentValue)) {
				$this->LabResultsChecked->ViewValue = $this->LabResultsChecked->tagCaption(1) != "" ? $this->LabResultsChecked->tagCaption(1) : "Yes";
			} else {
				$this->LabResultsChecked->ViewValue = $this->LabResultsChecked->tagCaption(2) != "" ? $this->LabResultsChecked->tagCaption(2) : "No";
			}
			$this->LabResultsChecked->ViewCustomAttributes = "";

			// TerminationNoticeGiven
			if (ConvertToBool($this->TerminationNoticeGiven->CurrentValue)) {
				$this->TerminationNoticeGiven->ViewValue = $this->TerminationNoticeGiven->tagCaption(1) != "" ? $this->TerminationNoticeGiven->tagCaption(1) : "Yes";
			} else {
				$this->TerminationNoticeGiven->ViewValue = $this->TerminationNoticeGiven->tagCaption(2) != "" ? $this->TerminationNoticeGiven->tagCaption(2) : "No";
			}
			$this->TerminationNoticeGiven->ViewCustomAttributes = "";

			// CopiesEmailedToMLG
			if (ConvertToBool($this->CopiesEmailedToMLG->CurrentValue)) {
				$this->CopiesEmailedToMLG->ViewValue = $this->CopiesEmailedToMLG->tagCaption(1) != "" ? $this->CopiesEmailedToMLG->tagCaption(1) : "Yes";
			} else {
				$this->CopiesEmailedToMLG->ViewValue = $this->CopiesEmailedToMLG->tagCaption(2) != "" ? $this->CopiesEmailedToMLG->tagCaption(2) : "No";
			}
			$this->CopiesEmailedToMLG->ViewCustomAttributes = "";

			// ContractStillValid
			if (ConvertToBool($this->ContractStillValid->CurrentValue)) {
				$this->ContractStillValid->ViewValue = $this->ContractStillValid->tagCaption(1) != "" ? $this->ContractStillValid->tagCaption(1) : "Yes";
			} else {
				$this->ContractStillValid->ViewValue = $this->ContractStillValid->tagCaption(2) != "" ? $this->ContractStillValid->tagCaption(2) : "No";
			}
			$this->ContractStillValid->ViewCustomAttributes = "";

			// DeskOfficer
			$this->DeskOfficer->ViewValue = $this->DeskOfficer->CurrentValue;
			$this->DeskOfficer->ViewCustomAttributes = "";

			// DeskOfficerDate
			$this->DeskOfficerDate->ViewValue = $this->DeskOfficerDate->CurrentValue;
			$this->DeskOfficerDate->ViewValue = FormatDateTime($this->DeskOfficerDate->ViewValue, 0);
			$this->DeskOfficerDate->ViewCustomAttributes = "";

			// SupervisingEngineer
			$this->SupervisingEngineer->ViewValue = $this->SupervisingEngineer->CurrentValue;
			$this->SupervisingEngineer->ViewCustomAttributes = "";

			// EngineerDate
			$this->EngineerDate->ViewValue = $this->EngineerDate->CurrentValue;
			$this->EngineerDate->ViewValue = FormatDateTime($this->EngineerDate->ViewValue, 0);
			$this->EngineerDate->ViewCustomAttributes = "";

			// CouncilSecretary
			$this->CouncilSecretary->ViewValue = $this->CouncilSecretary->CurrentValue;
			$this->CouncilSecretary->ViewCustomAttributes = "";

			// CSDate
			$this->CSDate->ViewValue = $this->CSDate->CurrentValue;
			$this->CSDate->ViewValue = FormatDateTime($this->CSDate->ViewValue, 0);
			$this->CSDate->ViewCustomAttributes = "";

			// ContractType
			$this->ContractType->ViewValue = $this->ContractType->CurrentValue;
			$this->ContractType->ViewValue = FormatNumber($this->ContractType->ViewValue, 0, -2, -2, -2);
			$this->ContractType->ViewCustomAttributes = "";

			// IPCNo
			$this->IPCNo->LinkCustomAttributes = "";
			$this->IPCNo->HrefValue = "";
			$this->IPCNo->TooltipValue = "";

			// ContractNo
			$this->ContractNo->LinkCustomAttributes = "";
			$this->ContractNo->HrefValue = "";
			$this->ContractNo->TooltipValue = "";

			// ContractAuthorizedByAG
			$this->ContractAuthorizedByAG->LinkCustomAttributes = "";
			$this->ContractAuthorizedByAG->HrefValue = "";
			$this->ContractAuthorizedByAG->TooltipValue = "";

			// VATApplied
			$this->VATApplied->LinkCustomAttributes = "";
			$this->VATApplied->HrefValue = "";
			$this->VATApplied->TooltipValue = "";

			// ArithmeticCheckDone
			$this->ArithmeticCheckDone->LinkCustomAttributes = "";
			$this->ArithmeticCheckDone->HrefValue = "";
			$this->ArithmeticCheckDone->TooltipValue = "";

			// VariationsApproved
			$this->VariationsApproved->LinkCustomAttributes = "";
			$this->VariationsApproved->HrefValue = "";
			$this->VariationsApproved->TooltipValue = "";

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->LinkCustomAttributes = "";
			$this->PerformanceBondValidUntil->HrefValue = "";
			$this->PerformanceBondValidUntil->TooltipValue = "";

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->LinkCustomAttributes = "";
			$this->AdvancePaymentBondValidUntil->HrefValue = "";
			$this->AdvancePaymentBondValidUntil->TooltipValue = "";

			// RetentionDeductionClause
			$this->RetentionDeductionClause->LinkCustomAttributes = "";
			$this->RetentionDeductionClause->HrefValue = "";
			$this->RetentionDeductionClause->TooltipValue = "";

			// RetentionDeducted
			$this->RetentionDeducted->LinkCustomAttributes = "";
			$this->RetentionDeducted->HrefValue = "";
			$this->RetentionDeducted->TooltipValue = "";

			// LiquidatedDamagesDeducted
			$this->LiquidatedDamagesDeducted->LinkCustomAttributes = "";
			$this->LiquidatedDamagesDeducted->HrefValue = "";
			$this->LiquidatedDamagesDeducted->TooltipValue = "";

			// AdvancedPaymentDeducted
			$this->AdvancedPaymentDeducted->LinkCustomAttributes = "";
			$this->AdvancedPaymentDeducted->HrefValue = "";
			$this->AdvancedPaymentDeducted->TooltipValue = "";

			// CurrentProgressReportAttached
			$this->CurrentProgressReportAttached->LinkCustomAttributes = "";
			$this->CurrentProgressReportAttached->HrefValue = "";
			$this->CurrentProgressReportAttached->TooltipValue = "";

			// DateOfSiteInspection
			$this->DateOfSiteInspection->LinkCustomAttributes = "";
			$this->DateOfSiteInspection->HrefValue = "";
			$this->DateOfSiteInspection->TooltipValue = "";

			// TimeExtensionAuthorized
			$this->TimeExtensionAuthorized->LinkCustomAttributes = "";
			$this->TimeExtensionAuthorized->HrefValue = "";
			$this->TimeExtensionAuthorized->TooltipValue = "";

			// LabResultsChecked
			$this->LabResultsChecked->LinkCustomAttributes = "";
			$this->LabResultsChecked->HrefValue = "";
			$this->LabResultsChecked->TooltipValue = "";

			// TerminationNoticeGiven
			$this->TerminationNoticeGiven->LinkCustomAttributes = "";
			$this->TerminationNoticeGiven->HrefValue = "";
			$this->TerminationNoticeGiven->TooltipValue = "";

			// CopiesEmailedToMLG
			$this->CopiesEmailedToMLG->LinkCustomAttributes = "";
			$this->CopiesEmailedToMLG->HrefValue = "";
			$this->CopiesEmailedToMLG->TooltipValue = "";

			// ContractStillValid
			$this->ContractStillValid->LinkCustomAttributes = "";
			$this->ContractStillValid->HrefValue = "";
			$this->ContractStillValid->TooltipValue = "";

			// DeskOfficer
			$this->DeskOfficer->LinkCustomAttributes = "";
			$this->DeskOfficer->HrefValue = "";
			$this->DeskOfficer->TooltipValue = "";

			// DeskOfficerDate
			$this->DeskOfficerDate->LinkCustomAttributes = "";
			$this->DeskOfficerDate->HrefValue = "";
			$this->DeskOfficerDate->TooltipValue = "";

			// SupervisingEngineer
			$this->SupervisingEngineer->LinkCustomAttributes = "";
			$this->SupervisingEngineer->HrefValue = "";
			$this->SupervisingEngineer->TooltipValue = "";

			// EngineerDate
			$this->EngineerDate->LinkCustomAttributes = "";
			$this->EngineerDate->HrefValue = "";
			$this->EngineerDate->TooltipValue = "";

			// CouncilSecretary
			$this->CouncilSecretary->LinkCustomAttributes = "";
			$this->CouncilSecretary->HrefValue = "";
			$this->CouncilSecretary->TooltipValue = "";

			// CSDate
			$this->CSDate->LinkCustomAttributes = "";
			$this->CSDate->HrefValue = "";
			$this->CSDate->TooltipValue = "";

			// ContractType
			$this->ContractType->LinkCustomAttributes = "";
			$this->ContractType->HrefValue = "";
			$this->ContractType->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		$conn->beginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['IPCNo'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}
		if ($deleteRows) {
			$conn->commitTrans(); // Commit the changes
		} else {
			$conn->rollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "contract") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ContractNo", Get("ContractNo"))) !== NULL) {
					$GLOBALS["contract"]->ContractNo->setQueryStringValue($parm);
					$this->ContractNo->setQueryStringValue($GLOBALS["contract"]->ContractNo->QueryStringValue);
					$this->ContractNo->setSessionValue($this->ContractNo->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "contract") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ContractNo", Post("ContractNo"))) !== NULL) {
					$GLOBALS["contract"]->ContractNo->setFormValue($parm);
					$this->ContractNo->setFormValue($GLOBALS["contract"]->ContractNo->FormValue);
					$this->ContractNo->setSessionValue($this->ContractNo->FormValue);
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "contract") {
				if ($this->ContractNo->CurrentValue == "")
					$this->ContractNo->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ipc_trackinglist.php"), "", $this->TableVar, TRUE);
		$pageId = "delete";
		$Breadcrumb->add("delete", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_ContractAuthorizedByAG":
					break;
				case "x_VATApplied":
					break;
				case "x_ArithmeticCheckDone":
					break;
				case "x_VariationsApproved":
					break;
				case "x_RetentionDeducted":
					break;
				case "x_LiquidatedDamagesDeducted":
					break;
				case "x_LiquidatedPenaltiesDeducted":
					break;
				case "x_AdvancedPaymentDeducted":
					break;
				case "x_CurrentProgressReportAttached":
					break;
				case "x_TimeExtensionAuthorized":
					break;
				case "x_LabResultsChecked":
					break;
				case "x_TerminationNoticeGiven":
					break;
				case "x_CopiesEmailedToMLG":
					break;
				case "x_ContractStillValid":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
} // End class
?>