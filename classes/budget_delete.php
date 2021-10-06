<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class budget_delete extends budget
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'budget';

	// Page object name
	public $PageObjName = "budget_delete";

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

		// Table object (budget)
		if (!isset($GLOBALS["budget"]) || get_class($GLOBALS["budget"]) == PROJECT_NAMESPACE . "budget") {
			$GLOBALS["budget"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["budget"];
		}

		// Table object (detailed_action)
		if (!isset($GLOBALS['detailed_action']))
			$GLOBALS['detailed_action'] = new detailed_action();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'budget');

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
		global $budget;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($budget);
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
			$key .= @$ar['BudgetLine'];
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
			$this->BudgetLine->Visible = FALSE;
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
					$this->terminate(GetUrl("budgetlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		$this->OutcomeCode->setVisibility();
		$this->OutputCode->setVisibility();
		$this->ActionCode->setVisibility();
		$this->DetailedActionCode->setVisibility();
		$this->FinancialYear->setVisibility();
		$this->AccountCode->setVisibility();
		$this->ItemCode->Visible = FALSE;
		$this->MeansOfImplementation->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->Quantity->setVisibility();
		$this->PeriodType->Visible = FALSE;
		$this->PeriodLength->Visible = FALSE;
		$this->Frequency->setVisibility();
		$this->UnitCost->setVisibility();
		$this->BudgetEstimate->setVisibility();
		$this->ActualAmount->Visible = FALSE;
		$this->Status->Visible = FALSE;
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->BudgetLine->setVisibility();
		$this->ProgramCode->setVisibility();
		$this->SubProgramCode->setVisibility();
		$this->ApprovedBudget->setVisibility();
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
		$this->setupLookupOptions($this->OutcomeCode);
		$this->setupLookupOptions($this->OutputCode);
		$this->setupLookupOptions($this->ActionCode);
		$this->setupLookupOptions($this->DetailedActionCode);
		$this->setupLookupOptions($this->FinancialYear);
		$this->setupLookupOptions($this->AccountCode);
		$this->setupLookupOptions($this->MeansOfImplementation);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->PeriodType);
		$this->setupLookupOptions($this->Status);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->ProgramCode);
		$this->setupLookupOptions($this->SubProgramCode);

		// Check permission
		if (!$Security->canDelete()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("budgetlist.php");
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
			$this->terminate("budgetlist.php"); // Prevent SQL injection, return to list
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
				$this->terminate("budgetlist.php"); // Return to list
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
		$this->OutcomeCode->setDbValue($row['OutcomeCode']);
		$this->OutputCode->setDbValue($row['OutputCode']);
		$this->ActionCode->setDbValue($row['ActionCode']);
		$this->DetailedActionCode->setDbValue($row['DetailedActionCode']);
		$this->FinancialYear->setDbValue($row['FinancialYear']);
		$this->AccountCode->setDbValue($row['AccountCode']);
		$this->ItemCode->setDbValue($row['ItemCode']);
		$this->MeansOfImplementation->setDbValue($row['MeansOfImplementation']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->Quantity->setDbValue($row['Quantity']);
		$this->PeriodType->setDbValue($row['PeriodType']);
		$this->PeriodLength->setDbValue($row['PeriodLength']);
		$this->Frequency->setDbValue($row['Frequency']);
		$this->UnitCost->setDbValue($row['UnitCost']);
		$this->BudgetEstimate->setDbValue($row['BudgetEstimate']);
		$this->ActualAmount->setDbValue($row['ActualAmount']);
		$this->Status->setDbValue($row['Status']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->BudgetLine->setDbValue($row['BudgetLine']);
		$this->ProgramCode->setDbValue($row['ProgramCode']);
		$this->SubProgramCode->setDbValue($row['SubProgramCode']);
		$this->ApprovedBudget->setDbValue($row['ApprovedBudget']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['OutcomeCode'] = NULL;
		$row['OutputCode'] = NULL;
		$row['ActionCode'] = NULL;
		$row['DetailedActionCode'] = NULL;
		$row['FinancialYear'] = NULL;
		$row['AccountCode'] = NULL;
		$row['ItemCode'] = NULL;
		$row['MeansOfImplementation'] = NULL;
		$row['UnitOfMeasure'] = NULL;
		$row['Quantity'] = NULL;
		$row['PeriodType'] = NULL;
		$row['PeriodLength'] = NULL;
		$row['Frequency'] = NULL;
		$row['UnitCost'] = NULL;
		$row['BudgetEstimate'] = NULL;
		$row['ActualAmount'] = NULL;
		$row['Status'] = NULL;
		$row['LACode'] = NULL;
		$row['DepartmentCode'] = NULL;
		$row['SectionCode'] = NULL;
		$row['BudgetLine'] = NULL;
		$row['ProgramCode'] = NULL;
		$row['SubProgramCode'] = NULL;
		$row['ApprovedBudget'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Quantity->FormValue == $this->Quantity->CurrentValue && is_numeric(ConvertToFloatString($this->Quantity->CurrentValue)))
			$this->Quantity->CurrentValue = ConvertToFloatString($this->Quantity->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Frequency->FormValue == $this->Frequency->CurrentValue && is_numeric(ConvertToFloatString($this->Frequency->CurrentValue)))
			$this->Frequency->CurrentValue = ConvertToFloatString($this->Frequency->CurrentValue);

		// Convert decimal values if posted back
		if ($this->UnitCost->FormValue == $this->UnitCost->CurrentValue && is_numeric(ConvertToFloatString($this->UnitCost->CurrentValue)))
			$this->UnitCost->CurrentValue = ConvertToFloatString($this->UnitCost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BudgetEstimate->FormValue == $this->BudgetEstimate->CurrentValue && is_numeric(ConvertToFloatString($this->BudgetEstimate->CurrentValue)))
			$this->BudgetEstimate->CurrentValue = ConvertToFloatString($this->BudgetEstimate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ApprovedBudget->FormValue == $this->ApprovedBudget->CurrentValue && is_numeric(ConvertToFloatString($this->ApprovedBudget->CurrentValue)))
			$this->ApprovedBudget->CurrentValue = ConvertToFloatString($this->ApprovedBudget->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// OutcomeCode
		// OutputCode
		// ActionCode
		// DetailedActionCode
		// FinancialYear
		// AccountCode
		// ItemCode
		// MeansOfImplementation
		// UnitOfMeasure
		// Quantity
		// PeriodType
		// PeriodLength
		// Frequency
		// UnitCost
		// BudgetEstimate
		// ActualAmount
		// Status
		// LACode
		// DepartmentCode
		// SectionCode
		// BudgetLine
		// ProgramCode
		// SubProgramCode
		// ApprovedBudget

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// OutcomeCode
			$curVal = strval($this->OutcomeCode->CurrentValue);
			if ($curVal != "") {
				$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
				if ($this->OutcomeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
					}
				}
			} else {
				$this->OutcomeCode->ViewValue = NULL;
			}
			$this->OutcomeCode->ViewCustomAttributes = "";

			// OutputCode
			$curVal = strval($this->OutputCode->CurrentValue);
			if ($curVal != "") {
				$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
				if ($this->OutputCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
					}
				}
			} else {
				$this->OutputCode->ViewValue = NULL;
			}
			$this->OutputCode->ViewCustomAttributes = "";

			// ActionCode
			$curVal = strval($this->ActionCode->CurrentValue);
			if ($curVal != "") {
				$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
				if ($this->ActionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
					}
				}
			} else {
				$this->ActionCode->ViewValue = NULL;
			}
			$this->ActionCode->ViewCustomAttributes = "";

			// DetailedActionCode
			$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
			$curVal = strval($this->DetailedActionCode->CurrentValue);
			if ($curVal != "") {
				$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->lookupCacheOption($curVal);
				if ($this->DetailedActionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
					}
				}
			} else {
				$this->DetailedActionCode->ViewValue = NULL;
			}
			$this->DetailedActionCode->ViewCustomAttributes = "";

			// FinancialYear
			$curVal = strval($this->FinancialYear->CurrentValue);
			if ($curVal != "") {
				$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
				if ($this->FinancialYear->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->FinancialYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->FinancialYear->ViewValue = $this->FinancialYear->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
					}
				}
			} else {
				$this->FinancialYear->ViewValue = NULL;
			}
			$this->FinancialYear->ViewCustomAttributes = "";

			// AccountCode
			$curVal = strval($this->AccountCode->CurrentValue);
			if ($curVal != "") {
				$this->AccountCode->ViewValue = $this->AccountCode->lookupCacheOption($curVal);
				if ($this->AccountCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->AccountCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AccountCode->ViewValue = $this->AccountCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountCode->ViewValue = $this->AccountCode->CurrentValue;
					}
				}
			} else {
				$this->AccountCode->ViewValue = NULL;
			}
			$this->AccountCode->ViewCustomAttributes = "";

			// MeansOfImplementation
			$curVal = strval($this->MeansOfImplementation->CurrentValue);
			if ($curVal != "") {
				$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->lookupCacheOption($curVal);
				if ($this->MeansOfImplementation->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`moimp_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MeansOfImplementation->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->CurrentValue;
					}
				}
			} else {
				$this->MeansOfImplementation->ViewValue = NULL;
			}
			$this->MeansOfImplementation->ViewCustomAttributes = "";

			// UnitOfMeasure
			$curVal = strval($this->UnitOfMeasure->CurrentValue);
			if ($curVal != "") {
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
				if ($this->UnitOfMeasure->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
					}
				}
			} else {
				$this->UnitOfMeasure->ViewValue = NULL;
			}
			$this->UnitOfMeasure->ViewCustomAttributes = "";

			// Quantity
			$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
			$this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, 4, -2, -2, -2);
			$this->Quantity->CellCssStyle .= "text-align: right;";
			$this->Quantity->ViewCustomAttributes = "";

			// Frequency
			$this->Frequency->ViewValue = $this->Frequency->CurrentValue;
			$this->Frequency->ViewValue = FormatNumber($this->Frequency->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Frequency->ViewCustomAttributes = "";

			// UnitCost
			$this->UnitCost->ViewValue = $this->UnitCost->CurrentValue;
			$this->UnitCost->ViewValue = FormatNumber($this->UnitCost->ViewValue, 2, -2, -2, -2);
			$this->UnitCost->CellCssStyle .= "text-align: right;";
			$this->UnitCost->ViewCustomAttributes = "";

			// BudgetEstimate
			$this->BudgetEstimate->ViewValue = $this->BudgetEstimate->CurrentValue;
			$this->BudgetEstimate->ViewValue = FormatNumber($this->BudgetEstimate->ViewValue, 2, -2, -2, -2);
			$this->BudgetEstimate->CellCssStyle .= "text-align: right;";
			$this->BudgetEstimate->ViewCustomAttributes = "";

			// ActualAmount
			$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
			$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
			$this->ActualAmount->CellCssStyle .= "text-align: right;";
			$this->ActualAmount->ViewCustomAttributes = "";

			// Status
			$this->Status->ViewValue = $this->Status->CurrentValue;
			$curVal = strval($this->Status->CurrentValue);
			if ($curVal != "") {
				$this->Status->ViewValue = $this->Status->lookupCacheOption($curVal);
				if ($this->Status->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Status->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Status->ViewValue = $this->Status->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Status->ViewValue = $this->Status->CurrentValue;
					}
				}
			} else {
				$this->Status->ViewValue = NULL;
			}
			$this->Status->ViewCustomAttributes = "";

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
			$curVal = strval($this->LACode->CurrentValue);
			if ($curVal != "") {
				$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
				if ($this->LACode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LACode->ViewValue = $this->LACode->CurrentValue;
					}
				}
			} else {
				$this->LACode->ViewValue = NULL;
			}
			$this->LACode->ViewCustomAttributes = "";

			// DepartmentCode
			$curVal = strval($this->DepartmentCode->CurrentValue);
			if ($curVal != "") {
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
				if ($this->DepartmentCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
					}
				}
			} else {
				$this->DepartmentCode->ViewValue = NULL;
			}
			$this->DepartmentCode->ViewCustomAttributes = "";

			// SectionCode
			$curVal = strval($this->SectionCode->CurrentValue);
			if ($curVal != "") {
				$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
				if ($this->SectionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SectionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SectionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SectionCode->ViewValue = $this->SectionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
					}
				}
			} else {
				$this->SectionCode->ViewValue = NULL;
			}
			$this->SectionCode->ViewCustomAttributes = "";

			// BudgetLine
			$this->BudgetLine->ViewValue = $this->BudgetLine->CurrentValue;
			$this->BudgetLine->ViewCustomAttributes = "";

			// ProgramCode
			$curVal = strval($this->ProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
				if ($this->ProgramCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
					}
				}
			} else {
				$this->ProgramCode->ViewValue = NULL;
			}
			$this->ProgramCode->ViewCustomAttributes = "";

			// SubProgramCode
			$curVal = strval($this->SubProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->SubProgramCode->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
				if ($this->SubProgramCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SubProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SubProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SubProgramCode->ViewValue = $this->SubProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SubProgramCode->ViewValue = $this->SubProgramCode->CurrentValue;
					}
				}
			} else {
				$this->SubProgramCode->ViewValue = NULL;
			}
			$this->SubProgramCode->ViewCustomAttributes = "";

			// ApprovedBudget
			$this->ApprovedBudget->ViewValue = $this->ApprovedBudget->CurrentValue;
			$this->ApprovedBudget->ViewValue = FormatNumber($this->ApprovedBudget->ViewValue, 2, -2, -2, -2);
			$this->ApprovedBudget->ViewCustomAttributes = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";
			$this->OutcomeCode->TooltipValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";
			$this->OutputCode->TooltipValue = "";

			// ActionCode
			$this->ActionCode->LinkCustomAttributes = "";
			$this->ActionCode->HrefValue = "";
			$this->ActionCode->TooltipValue = "";

			// DetailedActionCode
			$this->DetailedActionCode->LinkCustomAttributes = "";
			$this->DetailedActionCode->HrefValue = "";
			$this->DetailedActionCode->TooltipValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";
			$this->FinancialYear->TooltipValue = "";

			// AccountCode
			$this->AccountCode->LinkCustomAttributes = "";
			$this->AccountCode->HrefValue = "";
			$this->AccountCode->TooltipValue = "";

			// MeansOfImplementation
			$this->MeansOfImplementation->LinkCustomAttributes = "";
			$this->MeansOfImplementation->HrefValue = "";
			$this->MeansOfImplementation->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";
			$this->Quantity->TooltipValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";
			$this->Frequency->TooltipValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";
			$this->UnitCost->TooltipValue = "";

			// BudgetEstimate
			$this->BudgetEstimate->LinkCustomAttributes = "";
			$this->BudgetEstimate->HrefValue = "";
			$this->BudgetEstimate->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";
			$this->SectionCode->TooltipValue = "";

			// BudgetLine
			$this->BudgetLine->LinkCustomAttributes = "";
			$this->BudgetLine->HrefValue = "";
			$this->BudgetLine->TooltipValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";
			$this->ProgramCode->TooltipValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";
			$this->SubProgramCode->TooltipValue = "";

			// ApprovedBudget
			$this->ApprovedBudget->LinkCustomAttributes = "";
			$this->ApprovedBudget->HrefValue = "";
			$this->ApprovedBudget->TooltipValue = "";
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
				$thisKey .= $row['BudgetLine'];
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
			if ($masterTblVar == "detailed_action") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["detailed_action"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["detailed_action"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DepartmentCode", Get("DepartmentCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DepartmentCode->setQueryStringValue($parm);
					$this->DepartmentCode->setQueryStringValue($GLOBALS["detailed_action"]->DepartmentCode->QueryStringValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DepartmentCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_FinancialYear", Get("FinancialYear"))) !== NULL) {
					$GLOBALS["detailed_action"]->FinancialYear->setQueryStringValue($parm);
					$this->FinancialYear->setQueryStringValue($GLOBALS["detailed_action"]->FinancialYear->QueryStringValue);
					$this->FinancialYear->setSessionValue($this->FinancialYear->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->FinancialYear->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ActionCode", Get("ActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ActionCode->setQueryStringValue($parm);
					$this->ActionCode->setQueryStringValue($GLOBALS["detailed_action"]->ActionCode->QueryStringValue);
					$this->ActionCode->setSessionValue($this->ActionCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ActionCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OutcomeCode", Get("OutcomeCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutcomeCode->setQueryStringValue($parm);
					$this->OutcomeCode->setQueryStringValue($GLOBALS["detailed_action"]->OutcomeCode->QueryStringValue);
					$this->OutcomeCode->setSessionValue($this->OutcomeCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutcomeCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OutputCode", Get("OutputCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutputCode->setQueryStringValue($parm);
					$this->OutputCode->setQueryStringValue($GLOBALS["detailed_action"]->OutputCode->QueryStringValue);
					$this->OutputCode->setSessionValue($this->OutputCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutputCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DetailedActionCode", Get("DetailedActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DetailedActionCode->setQueryStringValue($parm);
					$this->DetailedActionCode->setQueryStringValue($GLOBALS["detailed_action"]->DetailedActionCode->QueryStringValue);
					$this->DetailedActionCode->setSessionValue($this->DetailedActionCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DetailedActionCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ProgramCode", Get("ProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ProgramCode->setQueryStringValue($parm);
					$this->ProgramCode->setQueryStringValue($GLOBALS["detailed_action"]->ProgramCode->QueryStringValue);
					$this->ProgramCode->setSessionValue($this->ProgramCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ProgramCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_SubProgramCode", Get("SubProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->SubProgramCode->setQueryStringValue($parm);
					$this->SubProgramCode->setQueryStringValue($GLOBALS["detailed_action"]->SubProgramCode->QueryStringValue);
					$this->SubProgramCode->setSessionValue($this->SubProgramCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->SubProgramCode->QueryStringValue))
						$validMaster = FALSE;
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
			if ($masterTblVar == "detailed_action") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["detailed_action"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["detailed_action"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DepartmentCode", Post("DepartmentCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DepartmentCode->setFormValue($parm);
					$this->DepartmentCode->setFormValue($GLOBALS["detailed_action"]->DepartmentCode->FormValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DepartmentCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_FinancialYear", Post("FinancialYear"))) !== NULL) {
					$GLOBALS["detailed_action"]->FinancialYear->setFormValue($parm);
					$this->FinancialYear->setFormValue($GLOBALS["detailed_action"]->FinancialYear->FormValue);
					$this->FinancialYear->setSessionValue($this->FinancialYear->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->FinancialYear->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ActionCode", Post("ActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ActionCode->setFormValue($parm);
					$this->ActionCode->setFormValue($GLOBALS["detailed_action"]->ActionCode->FormValue);
					$this->ActionCode->setSessionValue($this->ActionCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ActionCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OutcomeCode", Post("OutcomeCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutcomeCode->setFormValue($parm);
					$this->OutcomeCode->setFormValue($GLOBALS["detailed_action"]->OutcomeCode->FormValue);
					$this->OutcomeCode->setSessionValue($this->OutcomeCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutcomeCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OutputCode", Post("OutputCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutputCode->setFormValue($parm);
					$this->OutputCode->setFormValue($GLOBALS["detailed_action"]->OutputCode->FormValue);
					$this->OutputCode->setSessionValue($this->OutputCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutputCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DetailedActionCode", Post("DetailedActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DetailedActionCode->setFormValue($parm);
					$this->DetailedActionCode->setFormValue($GLOBALS["detailed_action"]->DetailedActionCode->FormValue);
					$this->DetailedActionCode->setSessionValue($this->DetailedActionCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DetailedActionCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ProgramCode", Post("ProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ProgramCode->setFormValue($parm);
					$this->ProgramCode->setFormValue($GLOBALS["detailed_action"]->ProgramCode->FormValue);
					$this->ProgramCode->setSessionValue($this->ProgramCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ProgramCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_SubProgramCode", Post("SubProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->SubProgramCode->setFormValue($parm);
					$this->SubProgramCode->setFormValue($GLOBALS["detailed_action"]->SubProgramCode->FormValue);
					$this->SubProgramCode->setSessionValue($this->SubProgramCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->SubProgramCode->FormValue))
						$validMaster = FALSE;
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
			if ($masterTblVar != "detailed_action") {
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->DepartmentCode->CurrentValue == "")
					$this->DepartmentCode->setSessionValue("");
				if ($this->FinancialYear->CurrentValue == "")
					$this->FinancialYear->setSessionValue("");
				if ($this->ActionCode->CurrentValue == "")
					$this->ActionCode->setSessionValue("");
				if ($this->OutcomeCode->CurrentValue == "")
					$this->OutcomeCode->setSessionValue("");
				if ($this->OutputCode->CurrentValue == "")
					$this->OutputCode->setSessionValue("");
				if ($this->DetailedActionCode->CurrentValue == "")
					$this->DetailedActionCode->setSessionValue("");
				if ($this->ProgramCode->CurrentValue == "")
					$this->ProgramCode->setSessionValue("");
				if ($this->SubProgramCode->CurrentValue == "")
					$this->SubProgramCode->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("budgetlist.php"), "", $this->TableVar, TRUE);
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
				case "x_OutcomeCode":
					break;
				case "x_OutputCode":
					break;
				case "x_ActionCode":
					break;
				case "x_DetailedActionCode":
					break;
				case "x_FinancialYear":
					break;
				case "x_AccountCode":
					break;
				case "x_MeansOfImplementation":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_PeriodType":
					break;
				case "x_Status":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_ProgramCode":
					break;
				case "x_SubProgramCode":
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
						case "x_OutcomeCode":
							break;
						case "x_OutputCode":
							break;
						case "x_ActionCode":
							break;
						case "x_DetailedActionCode":
							break;
						case "x_FinancialYear":
							break;
						case "x_AccountCode":
							break;
						case "x_MeansOfImplementation":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_PeriodType":
							break;
						case "x_Status":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_ProgramCode":
							break;
						case "x_SubProgramCode":
							break;
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