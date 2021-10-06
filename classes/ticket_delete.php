<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class ticket_delete extends ticket
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'ticket';

	// Page object name
	public $PageObjName = "ticket_delete";

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

		// Table object (ticket)
		if (!isset($GLOBALS["ticket"]) || get_class($GLOBALS["ticket"]) == PROJECT_NAMESPACE . "ticket") {
			$GLOBALS["ticket"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ticket"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ticket');

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
		global $ticket;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ticket);
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
			$key .= @$ar['TicketNumber'];
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
			$this->TicketNumber->Visible = FALSE;
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
					$this->terminate(GetUrl("ticketlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		$this->Subject->setVisibility();
		$this->TicketReportDate->setVisibility();
		$this->IncidentDate->setVisibility();
		$this->IncidentTime->setVisibility();
		$this->TicketDescription->Visible = FALSE;
		$this->TicketCategory->setVisibility();
		$this->TicketType->setVisibility();
		$this->ReportedBy->setVisibility();
		$this->TicketStatus->setVisibility();
		$this->TicketNumber->setVisibility();
		$this->ReporterEmail->setVisibility();
		$this->ReporterMobile->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->DeptSection->setVisibility();
		$this->TicketLevel->setVisibility();
		$this->AllocatedTo->setVisibility();
		$this->EscalatedTo->setVisibility();
		$this->TicketSolution->setVisibility();
		$this->Evidence->Visible = FALSE;
		$this->SeverityLevel->setVisibility();
		$this->Days->setVisibility();
		$this->DataLastUpdated->setVisibility();
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
		$this->setupLookupOptions($this->TicketCategory);
		$this->setupLookupOptions($this->TicketType);
		$this->setupLookupOptions($this->ReportedBy);
		$this->setupLookupOptions($this->TicketStatus);
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->AllocatedTo);
		$this->setupLookupOptions($this->EscalatedTo);
		$this->setupLookupOptions($this->SeverityLevel);

		// Check permission
		if (!$Security->canDelete()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("ticketlist.php");
			return;
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		$filter = $this->getFilterFromRecordKeys();
		if ($filter == "") {
			$this->terminate("ticketlist.php"); // Prevent SQL injection, return to list
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
				$this->terminate("ticketlist.php"); // Return to list
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
		$this->Subject->setDbValue($row['Subject']);
		$this->TicketReportDate->setDbValue($row['TicketReportDate']);
		$this->IncidentDate->setDbValue($row['IncidentDate']);
		$this->IncidentTime->setDbValue($row['IncidentTime']);
		$this->TicketDescription->setDbValue($row['TicketDescription']);
		$this->TicketCategory->setDbValue($row['TicketCategory']);
		$this->TicketType->setDbValue($row['TicketType']);
		$this->ReportedBy->setDbValue($row['ReportedBy']);
		$this->TicketStatus->setDbValue($row['TicketStatus']);
		$this->TicketNumber->setDbValue($row['TicketNumber']);
		$this->ReporterEmail->setDbValue($row['ReporterEmail']);
		$this->ReporterMobile->setDbValue($row['ReporterMobile']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->DeptSection->setDbValue($row['DeptSection']);
		$this->TicketLevel->setDbValue($row['TicketLevel']);
		$this->AllocatedTo->setDbValue($row['AllocatedTo']);
		$this->EscalatedTo->setDbValue($row['EscalatedTo']);
		$this->TicketSolution->setDbValue($row['TicketSolution']);
		$this->Evidence->Upload->DbValue = $row['Evidence'];
		if (is_array($this->Evidence->Upload->DbValue) || is_object($this->Evidence->Upload->DbValue)) // Byte array
			$this->Evidence->Upload->DbValue = BytesToString($this->Evidence->Upload->DbValue);
		$this->SeverityLevel->setDbValue($row['SeverityLevel']);
		$this->Days->setDbValue($row['Days']);
		$this->DataLastUpdated->setDbValue($row['DataLastUpdated']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['Subject'] = NULL;
		$row['TicketReportDate'] = NULL;
		$row['IncidentDate'] = NULL;
		$row['IncidentTime'] = NULL;
		$row['TicketDescription'] = NULL;
		$row['TicketCategory'] = NULL;
		$row['TicketType'] = NULL;
		$row['ReportedBy'] = NULL;
		$row['TicketStatus'] = NULL;
		$row['TicketNumber'] = NULL;
		$row['ReporterEmail'] = NULL;
		$row['ReporterMobile'] = NULL;
		$row['ProvinceCode'] = NULL;
		$row['LACode'] = NULL;
		$row['DepartmentCode'] = NULL;
		$row['DeptSection'] = NULL;
		$row['TicketLevel'] = NULL;
		$row['AllocatedTo'] = NULL;
		$row['EscalatedTo'] = NULL;
		$row['TicketSolution'] = NULL;
		$row['Evidence'] = NULL;
		$row['SeverityLevel'] = NULL;
		$row['Days'] = NULL;
		$row['DataLastUpdated'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Days->FormValue == $this->Days->CurrentValue && is_numeric(ConvertToFloatString($this->Days->CurrentValue)))
			$this->Days->CurrentValue = ConvertToFloatString($this->Days->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// Subject
		// TicketReportDate
		// IncidentDate
		// IncidentTime
		// TicketDescription
		// TicketCategory
		// TicketType
		// ReportedBy
		// TicketStatus
		// TicketNumber
		// ReporterEmail
		// ReporterMobile
		// ProvinceCode
		// LACode
		// DepartmentCode
		// DeptSection
		// TicketLevel
		// AllocatedTo
		// EscalatedTo
		// TicketSolution
		// Evidence
		// SeverityLevel
		// Days
		// DataLastUpdated

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Subject
			$this->Subject->ViewValue = $this->Subject->CurrentValue;
			$this->Subject->ViewCustomAttributes = "";

			// TicketReportDate
			$this->TicketReportDate->ViewValue = $this->TicketReportDate->CurrentValue;
			$this->TicketReportDate->ViewValue = FormatDateTime($this->TicketReportDate->ViewValue, 0);
			$this->TicketReportDate->ViewCustomAttributes = "";

			// IncidentDate
			$this->IncidentDate->ViewValue = $this->IncidentDate->CurrentValue;
			$this->IncidentDate->ViewValue = FormatDateTime($this->IncidentDate->ViewValue, 0);
			$this->IncidentDate->ViewCustomAttributes = "";

			// IncidentTime
			$this->IncidentTime->ViewValue = $this->IncidentTime->CurrentValue;
			$this->IncidentTime->ViewValue = FormatDateTime($this->IncidentTime->ViewValue, 4);
			$this->IncidentTime->ViewCustomAttributes = "";

			// TicketCategory
			$this->TicketCategory->ViewValue = $this->TicketCategory->CurrentValue;
			$curVal = strval($this->TicketCategory->CurrentValue);
			if ($curVal != "") {
				$this->TicketCategory->ViewValue = $this->TicketCategory->lookupCacheOption($curVal);
				if ($this->TicketCategory->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`TicketCategory`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketCategory->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketCategory->ViewValue = $this->TicketCategory->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketCategory->ViewValue = $this->TicketCategory->CurrentValue;
					}
				}
			} else {
				$this->TicketCategory->ViewValue = NULL;
			}
			$this->TicketCategory->ViewCustomAttributes = "";

			// TicketType
			$curVal = strval($this->TicketType->CurrentValue);
			if ($curVal != "") {
				$this->TicketType->ViewValue = $this->TicketType->lookupCacheOption($curVal);
				if ($this->TicketType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`TicketType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketType->ViewValue = $this->TicketType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketType->ViewValue = $this->TicketType->CurrentValue;
					}
				}
			} else {
				$this->TicketType->ViewValue = NULL;
			}
			$this->TicketType->ViewCustomAttributes = "";

			// ReportedBy
			$curVal = strval($this->ReportedBy->CurrentValue);
			if ($curVal != "") {
				$this->ReportedBy->ViewValue = $this->ReportedBy->lookupCacheOption($curVal);
				if ($this->ReportedBy->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`UserCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ReportedBy->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->ReportedBy->ViewValue = $this->ReportedBy->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ReportedBy->ViewValue = $this->ReportedBy->CurrentValue;
					}
				}
			} else {
				$this->ReportedBy->ViewValue = NULL;
			}
			$this->ReportedBy->ViewCustomAttributes = "";

			// TicketStatus
			$curVal = strval($this->TicketStatus->CurrentValue);
			if ($curVal != "") {
				$this->TicketStatus->ViewValue = $this->TicketStatus->lookupCacheOption($curVal);
				if ($this->TicketStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`StatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketStatus->ViewValue = $this->TicketStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketStatus->ViewValue = $this->TicketStatus->CurrentValue;
					}
				}
			} else {
				$this->TicketStatus->ViewValue = NULL;
			}
			$this->TicketStatus->ViewCustomAttributes = "";

			// TicketNumber
			$this->TicketNumber->ViewValue = $this->TicketNumber->CurrentValue;
			$this->TicketNumber->ViewCustomAttributes = "";

			// ReporterEmail
			$this->ReporterEmail->ViewValue = $this->ReporterEmail->CurrentValue;
			$this->ReporterEmail->ViewCustomAttributes = "";

			// ReporterMobile
			$this->ReporterMobile->ViewValue = $this->ReporterMobile->CurrentValue;
			$this->ReporterMobile->ViewCustomAttributes = "";

			// ProvinceCode
			$curVal = strval($this->ProvinceCode->CurrentValue);
			if ($curVal != "") {
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				if ($this->ProvinceCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
					}
				}
			} else {
				$this->ProvinceCode->ViewValue = NULL;
			}
			$this->ProvinceCode->ViewCustomAttributes = "";

			// LACode
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

			// DeptSection
			$this->DeptSection->ViewCustomAttributes = "";

			// TicketLevel
			$this->TicketLevel->ViewValue = $this->TicketLevel->CurrentValue;
			$this->TicketLevel->ViewCustomAttributes = "";

			// AllocatedTo
			$curVal = strval($this->AllocatedTo->CurrentValue);
			if ($curVal != "") {
				$this->AllocatedTo->ViewValue = $this->AllocatedTo->lookupCacheOption($curVal);
				if ($this->AllocatedTo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AllocatedTo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AllocatedTo->ViewValue = $this->AllocatedTo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AllocatedTo->ViewValue = $this->AllocatedTo->CurrentValue;
					}
				}
			} else {
				$this->AllocatedTo->ViewValue = NULL;
			}
			$this->AllocatedTo->ViewCustomAttributes = "";

			// EscalatedTo
			$curVal = strval($this->EscalatedTo->CurrentValue);
			if ($curVal != "") {
				$this->EscalatedTo->ViewValue = $this->EscalatedTo->lookupCacheOption($curVal);
				if ($this->EscalatedTo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EscalatedTo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->EscalatedTo->ViewValue = $this->EscalatedTo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EscalatedTo->ViewValue = $this->EscalatedTo->CurrentValue;
					}
				}
			} else {
				$this->EscalatedTo->ViewValue = NULL;
			}
			$this->EscalatedTo->ViewCustomAttributes = "";

			// TicketSolution
			$this->TicketSolution->ViewValue = $this->TicketSolution->CurrentValue;
			$this->TicketSolution->ViewCustomAttributes = "";

			// SeverityLevel
			$curVal = strval($this->SeverityLevel->CurrentValue);
			if ($curVal != "") {
				$this->SeverityLevel->ViewValue = $this->SeverityLevel->lookupCacheOption($curVal);
				if ($this->SeverityLevel->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SeverityLevelCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SeverityLevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SeverityLevel->ViewValue = $this->SeverityLevel->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SeverityLevel->ViewValue = $this->SeverityLevel->CurrentValue;
					}
				}
			} else {
				$this->SeverityLevel->ViewValue = NULL;
			}
			$this->SeverityLevel->ViewCustomAttributes = "";

			// Days
			$this->Days->ViewValue = $this->Days->CurrentValue;
			$this->Days->ViewValue = FormatNumber($this->Days->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Days->ViewCustomAttributes = "";

			// DataLastUpdated
			$this->DataLastUpdated->ViewValue = $this->DataLastUpdated->CurrentValue;
			$this->DataLastUpdated->ViewValue = FormatDateTime($this->DataLastUpdated->ViewValue, 0);
			$this->DataLastUpdated->ViewCustomAttributes = "";

			// Subject
			$this->Subject->LinkCustomAttributes = "";
			$this->Subject->HrefValue = "";
			$this->Subject->TooltipValue = "";

			// TicketReportDate
			$this->TicketReportDate->LinkCustomAttributes = "";
			$this->TicketReportDate->HrefValue = "";
			$this->TicketReportDate->TooltipValue = "";

			// IncidentDate
			$this->IncidentDate->LinkCustomAttributes = "";
			$this->IncidentDate->HrefValue = "";
			$this->IncidentDate->TooltipValue = "";

			// IncidentTime
			$this->IncidentTime->LinkCustomAttributes = "";
			$this->IncidentTime->HrefValue = "";
			$this->IncidentTime->TooltipValue = "";

			// TicketCategory
			$this->TicketCategory->LinkCustomAttributes = "";
			$this->TicketCategory->HrefValue = "";
			$this->TicketCategory->TooltipValue = "";

			// TicketType
			$this->TicketType->LinkCustomAttributes = "";
			$this->TicketType->HrefValue = "";
			$this->TicketType->TooltipValue = "";

			// ReportedBy
			$this->ReportedBy->LinkCustomAttributes = "";
			$this->ReportedBy->HrefValue = "";
			$this->ReportedBy->TooltipValue = "";

			// TicketStatus
			$this->TicketStatus->LinkCustomAttributes = "";
			$this->TicketStatus->HrefValue = "";
			$this->TicketStatus->TooltipValue = "";

			// TicketNumber
			$this->TicketNumber->LinkCustomAttributes = "";
			$this->TicketNumber->HrefValue = "";
			$this->TicketNumber->TooltipValue = "";

			// ReporterEmail
			$this->ReporterEmail->LinkCustomAttributes = "";
			$this->ReporterEmail->HrefValue = "";
			$this->ReporterEmail->TooltipValue = "";

			// ReporterMobile
			$this->ReporterMobile->LinkCustomAttributes = "";
			$this->ReporterMobile->HrefValue = "";
			$this->ReporterMobile->TooltipValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// DeptSection
			$this->DeptSection->LinkCustomAttributes = "";
			$this->DeptSection->HrefValue = "";
			$this->DeptSection->TooltipValue = "";

			// TicketLevel
			$this->TicketLevel->LinkCustomAttributes = "";
			$this->TicketLevel->HrefValue = "";
			$this->TicketLevel->TooltipValue = "";

			// AllocatedTo
			$this->AllocatedTo->LinkCustomAttributes = "";
			$this->AllocatedTo->HrefValue = "";
			$this->AllocatedTo->TooltipValue = "";

			// EscalatedTo
			$this->EscalatedTo->LinkCustomAttributes = "";
			$this->EscalatedTo->HrefValue = "";
			$this->EscalatedTo->TooltipValue = "";

			// TicketSolution
			$this->TicketSolution->LinkCustomAttributes = "";
			$this->TicketSolution->HrefValue = "";
			$this->TicketSolution->TooltipValue = "";

			// SeverityLevel
			$this->SeverityLevel->LinkCustomAttributes = "";
			$this->SeverityLevel->HrefValue = "";
			$this->SeverityLevel->TooltipValue = "";

			// Days
			$this->Days->LinkCustomAttributes = "";
			$this->Days->HrefValue = "";
			$this->Days->TooltipValue = "";

			// DataLastUpdated
			$this->DataLastUpdated->LinkCustomAttributes = "";
			$this->DataLastUpdated->HrefValue = "";
			$this->DataLastUpdated->TooltipValue = "";
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
				$thisKey .= $row['TicketNumber'];
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ticketlist.php"), "", $this->TableVar, TRUE);
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
				case "x_TicketCategory":
					break;
				case "x_TicketType":
					break;
				case "x_ReportedBy":
					break;
				case "x_TicketStatus":
					break;
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_AllocatedTo":
					break;
				case "x_EscalatedTo":
					break;
				case "x_SeverityLevel":
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
						case "x_TicketCategory":
							break;
						case "x_TicketType":
							break;
						case "x_ReportedBy":
							break;
						case "x_TicketStatus":
							break;
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_AllocatedTo":
							break;
						case "x_EscalatedTo":
							break;
						case "x_SeverityLevel":
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