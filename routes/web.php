<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InboundPlanningController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(url("/dashboard"));
});

Route::get("login", [App\Http\Controllers\Auth\LoginController::class, "showLoginForm"])->name("showLogin");
Route::post("login", [App\Http\Controllers\Auth\LoginController::class, "login"])->name("doLogin");
Route::post("logout", [App\Http\Controllers\Auth\LoginController::class, "logout"])->name("postLogout");
Route::get("logout", [App\Http\Controllers\Auth\LoginController::class, "logout"])->name("getLogout");
Route::get("reset-password", [App\Http\Controllers\Auth\PasswordController::class, "showFormResetPassword"])->name("showFormResetPassword");
Route::post("reset-password", [App\Http\Controllers\Auth\PasswordController::class, "doResetPassword"])->name("doResetPassword");


Route::group(["middleware" => "auth"], function () {

    Route::get("/dashboard", [App\Http\Controllers\DashboardController::class, "index"])->name("dashboard");

    Route::post("/dashboard_getInboundReport", [App\Http\Controllers\DashboardController::class, "dashboard_getInboundReport"])->name("dashboard_getInboundReport");
    Route::post("/dashboard_getOutboundReport", [App\Http\Controllers\DashboardController::class, "dashboard_getOutboundReport"])->name("dashboard_getOutboundReport");

    Route::group([
        "prefix" => "/test",
        "as" => "test.",
    ], function () {
        Route::get("/", [App\Http\Controllers\TestController::class, "index"])->name("index");
        Route::get("/view_simple_datatables", [App\Http\Controllers\TestController::class, "view_simple_datatables"])->name("view_simple_datatables");
        Route::get("/view_datatables", [App\Http\Controllers\TestController::class, "view_datatables"])->name("view_datatables");
        Route::get("/get_data_datatables", [App\Http\Controllers\TestController::class, "get_data_datatables"])->name("get_data_datatables");
        Route::get("/view_form", [App\Http\Controllers\TestController::class, "view_form"])->name("view_form");
        Route::post("/save_form", [App\Http\Controllers\TestController::class, "save_form"])->name("save_form");
        Route::get("/view_sweetalert2", [App\Http\Controllers\TestController::class, "view_sweetalert2"])->name("view_sweetalert2");
        Route::get("/view_sweetalert2_backend", [App\Http\Controllers\TestController::class, "view_sweetalert2_backend"])->name("view_sweetalert2_backend");
    });

    Route::get("/forbidden", function () {
        return view("error.no-access");
    })->name("forbidden");

    Route::post("/change_client_project_id", [App\Http\Controllers\DashboardController::class, "change_client_project_id"])->name("change_client_project_id");

    Route::post("/get_message", [App\Http\Controllers\DashboardController::class, "get_message"])->name("get_message");

    Route::get('/get-last-client-project-id', [App\Http\Controllers\MasterProjectController::class, 'getLastClientProjectID']);

    Route::group([
        "prefix" => "/inbound_planning",
        "as" => "inbound_planning.",
    ], function () {
        Route::get("/", [App\Http\Controllers\InboundPlanningController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\InboundPlanningController::class, "datatables"])->name("datatables");
        Route::get("/datatablesSupplier", [App\Http\Controllers\InboundPlanningController::class, "datatablesSupplier"])->name("datatablesSupplier");
        Route::get("/datatablesOrderType", [App\Http\Controllers\InboundPlanningController::class, "datatablesOrderType"])->name("datatablesOrderType");
        Route::get("/datatablesSKU", [App\Http\Controllers\InboundPlanningController::class, "datatablesSKU"])->name("datatablesSKU");
        Route::get("/datatablesUOM", [App\Http\Controllers\InboundPlanningController::class, "datatablesUOM"])->name("datatablesUOM");
        Route::get("/datatablesClassification", [App\Http\Controllers\InboundPlanningController::class, "datatablesClassification"])->name("datatablesClassification");
        Route::get("/datatablesTargetUserAssign", [App\Http\Controllers\InboundPlanningController::class, "datatablesTargetUserAssign"])->name("datatablesTargetUserAssign");
        Route::get("/datatablesInboundStatus", [App\Http\Controllers\InboundPlanningController::class, "datatablesInboundStatus"])->name("datatablesInboundStatus");
        Route::get("/datatablesScanVehicle", [App\Http\Controllers\InboundPlanningController::class, "datatablesScanVehicle"])->name("datatablesScanVehicle");
        Route::get("/templateExcel", [App\Http\Controllers\InboundPlanningController::class, "templateExcel"])->name("templateExcel");
        Route::get("/showFormUploadExcel", [App\Http\Controllers\InboundPlanningController::class, "showFormUploadExcel"])->name("showFormUploadExcel");
        Route::get("/create", [App\Http\Controllers\InboundPlanningController::class, "create"])->name("create");
        Route::post("/processUploadToForm", [App\Http\Controllers\InboundPlanningController::class, "processUploadToForm"])->name("processUploadToForm");
        Route::post("/storeInboundPlanning", [App\Http\Controllers\InboundPlanningController::class, "storeInboundPlanning"])->name("storeInboundPlanning");
        Route::get("/{id}/show", [App\Http\Controllers\InboundPlanningController::class, "show"])->name("show");
        Route::get("/{id}/edit", [App\Http\Controllers\InboundPlanningController::class, "edit"])->name("edit");
        Route::post("/{id}/update", [App\Http\Controllers\InboundPlanningController::class, "update"])->name("update");
        Route::get("/{id}/viewPDF", [App\Http\Controllers\InboundPlanningController::class, "viewPDF"])->name("viewPDF");
        Route::get("/{id}/viewPDFTallySheet", [App\Http\Controllers\InboundPlanningController::class, "viewPDFTallySheet"])->name("viewPDFTallySheet");
        Route::get("/{id}/cancel", [App\Http\Controllers\InboundPlanningController::class, "cancel"])->name("cancel");
        Route::get("/{id}/inboundCheckingAndReceive", [App\Http\Controllers\InboundPlanningController::class, "inboundCheckingAndReceive"])->name("inboundCheckingAndReceive");
        Route::post("/{id}/processCancel", [App\Http\Controllers\InboundPlanningController::class, "processCancel"])->name("processCancel");
        Route::post("/{id}/confirmToUnreceive", [App\Http\Controllers\InboundPlanningController::class, "confirmToUnreceive"])->name("confirmToUnreceive");
        Route::post("/{id}/processAssignChecker", [App\Http\Controllers\InboundPlanningController::class, "processAssignChecker"])->name("processAssignChecker");
        Route::post("/{id}/processSavePartialVehicle", [App\Http\Controllers\InboundPlanningController::class, "processSavePartialVehicle"])->name("processSavePartialVehicle");
        Route::post("/{id}/processUpdateVehicleFinish", [App\Http\Controllers\InboundPlanningController::class, "processUpdateVehicleFinish"])->name("processUpdateVehicleFinish");
        Route::post("/{id}/processScan", [App\Http\Controllers\InboundPlanningController::class, "processScan"])->name("processScan");
        Route::get("/{id}/datatablesCheckedItems", [App\Http\Controllers\InboundPlanningController::class, "datatablesCheckedItems"])->name("datatablesCheckedItems");
        Route::get("/{id}/datatablesOutstandingItems", [App\Http\Controllers\InboundPlanningController::class, "datatablesOutstandingItems"])->name("datatablesOutstandingItems");
        Route::post("/{id}/processRemoveScan", [App\Http\Controllers\InboundPlanningController::class, "processRemoveScan"])->name("processRemoveScan");
        Route::post("/{id}/confirmInboundPlanning", [App\Http\Controllers\InboundPlanningController::class, "confirmInboundPlanning"])->name("confirmInboundPlanning");
        Route::get("/{id}/checkMismatch", [App\Http\Controllers\InboundPlanningController::class, "checkMismatch"])->name("checkMismatch");
        Route::post("/{id}/confirmInboundPlanningMismatch", [App\Http\Controllers\InboundPlanningController::class, "confirmInboundPlanningMismatch"])->name("confirmInboundPlanningMismatch");

    });

    Route::group([
        "prefix" => "/goods_receiving",
        "as" => "goods_receiving.",
    ], function () {
        Route::get("/", [App\Http\Controllers\GoodsReceivingController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\GoodsReceivingController::class, "datatables"])->name("datatables");
        Route::get("/datatablesDestLocation", [App\Http\Controllers\GoodsReceivingController::class, "datatablesDestLocation"])->name("datatablesDestLocation");
        Route::get("/datatablesTargetUserAssign", [App\Http\Controllers\GoodsReceivingController::class, "datatablesTargetUserAssign"])->name("datatablesTargetUserAssign");
        Route::get("/datatablesTargetWarehousemanAssign/{id}", [App\Http\Controllers\GoodsReceivingController::class, "datatablesTargetWarehousemanAssign"])->name("datatablesTargetWarehousemanAssign");
        Route::get("/viewExcel", [App\Http\Controllers\GoodsReceivingController::class, "viewExcel"])->name("viewExcel");
        Route::get("/{id}/show", [App\Http\Controllers\GoodsReceivingController::class, "show"])->name("show");
        Route::post("/{id}/processGoodReceive", [App\Http\Controllers\GoodsReceivingController::class, "processGoodReceive"])->name("processGoodReceive");
        Route::get("/{id}/printGRN", [App\Http\Controllers\GoodsReceivingController::class, "printGRN"])->name("printGRN");
        Route::get("/{id}/showMovementLocation", [App\Http\Controllers\GoodsReceivingController::class, "showMovementLocation"])->name("showMovementLocation");
        Route::get("/{id}/printPutaway", [App\Http\Controllers\GoodsReceivingController::class, "printPutaway"])->name("printPutaway");
        Route::post("/{id}/processAssignWarehouseman", [App\Http\Controllers\GoodsReceivingController::class, "processAssignWarehouseman"])->name("processAssignWarehouseman");
        Route::post("/{id}/processReceiveDetail", [App\Http\Controllers\GoodsReceivingController::class, "processReceiveDetail"])->name("processReceiveDetail");
        Route::post("/{id}/confirmPutaway", [App\Http\Controllers\GoodsReceivingController::class, "confirmPutaway"])->name("confirmPutaway");
        Route::get("/{id}/datatablesListSKUByGR", [App\Http\Controllers\GoodsReceivingController::class, "datatablesListSKUByGR"])->name("datatablesListSKUByGR");
    });
    Route::group([
        "prefix" => "/inventory_list",
        "as" => "inventory_list.",
    ], function () {
        Route::get("/", [App\Http\Controllers\InventoryListController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\InventoryListController::class, "datatables"])->name("datatables");
        Route::get("/datatablesLocation", [App\Http\Controllers\InventoryListController::class, "datatablesLocation"])->name("datatablesLocation");
        Route::get("/datatablesPallet", [App\Http\Controllers\InventoryListController::class, "datatablesPallet"])->name("datatablesPallet");
        Route::get("/datatablesSerialNo", [App\Http\Controllers\InventoryListController::class, "datatablesSerialNo"])->name("datatablesSerialNo");
        Route::get("/datatablesPartNo", [App\Http\Controllers\InventoryListController::class, "datatablesPartNo"])->name("datatablesPartNo");
        Route::get("/datatablesColor", [App\Http\Controllers\InventoryListController::class, "datatablesColor"])->name("datatablesColor");
        Route::get("/datatablesSize", [App\Http\Controllers\InventoryListController::class, "datatablesSize"])->name("datatablesSize");
        Route::get("/viewExcel", [App\Http\Controllers\InventoryListController::class, "viewExcel"])->name("viewExcel");
    });

    Route::group([
        "prefix" => "/outbound_planning",
        "as" => "outbound_planning.",
    ], function () {
        Route::get("/", [App\Http\Controllers\OutboundPlanningController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\OutboundPlanningController::class, "datatables"])->name("datatables");
        Route::get("/datatablesOrderType", [App\Http\Controllers\OutboundPlanningController::class, "datatablesOrderType"])->name("datatablesOrderType");
        Route::get("/datatablesOutboundStatus", [App\Http\Controllers\OutboundPlanningController::class, "datatablesOutboundStatus"])->name("datatablesOutboundStatus");
        Route::get("/datatablesClassification", [App\Http\Controllers\OutboundPlanningController::class, "datatablesClassification"])->name("datatablesClassification");
        Route::get("/datatablesUOM", [App\Http\Controllers\OutboundPlanningController::class, "datatablesUOM"])->name("datatablesUOM");
        Route::get("/datatablesSKU", [App\Http\Controllers\OutboundPlanningController::class, "datatablesSKU"])->name("datatablesSKU");
        Route::get("/datatablesSupervisor", [App\Http\Controllers\OutboundPlanningController::class, "datatablesSupervisor"])->name("datatablesSupervisor");
        Route::get("/datatablesVehicleType", [App\Http\Controllers\OutboundPlanningController::class, "datatablesVehicleType"])->name("datatablesVehicleType");
        Route::get("/datatablesTransporter", [App\Http\Controllers\OutboundPlanningController::class, "datatablesTransporter"])->name("datatablesTransporter");
        Route::get("/datatablesServiceType", [App\Http\Controllers\OutboundPlanningController::class, "datatablesServiceType"])->name("datatablesServiceType");
        Route::post("/tablesSKUDetails", [App\Http\Controllers\OutboundPlanningController::class, "tablesSKUDetails"])->name("tablesSKUDetails");
        Route::get("/datatablesSupplier", [App\Http\Controllers\OutboundPlanningController::class, "datatablesSupplier"])->name("datatablesSupplier");
        Route::get("/create", [App\Http\Controllers\OutboundPlanningController::class, "create"])->name("create");
        Route::post("/storeOutboundPlanning", [App\Http\Controllers\OutboundPlanningController::class, "storeOutboundPlanning"])->name("storeOutboundPlanning");
        Route::get("/{id}/show", [App\Http\Controllers\OutboundPlanningController::class, "show"])->name("show");
        Route::post("/{id}/confirmPlanning", [App\Http\Controllers\OutboundPlanningController::class, "confirmPlanning"])->name("confirmPlanning");
        Route::get("/{id}/edit", [App\Http\Controllers\OutboundPlanningController::class, "edit"])->name("edit");
        Route::post("/{id}/update", [App\Http\Controllers\OutboundPlanningController::class, "update"])->name("update");
        Route::post("/{id}/cancelOutboundPlanning", [App\Http\Controllers\OutboundPlanningController::class, "cancelOutboundPlanning"])->name("cancelOutboundPlanning");
    });

    Route::group([
        "prefix" => "/picking",
        "as" => "picking.",
    ], function () {
        Route::get("/", [App\Http\Controllers\PickingController::class, "index"])->name("index");
        Route::get("/datatablesOrderType", [App\Http\Controllers\PickingController::class, "datatablesOrderType"])->name("datatablesOrderType");
        Route::get("/datatablesPickingStatus", [App\Http\Controllers\PickingController::class, "datatablesPickingStatus"])->name("datatablesPickingStatus");
        Route::get("/datatables", [App\Http\Controllers\PickingController::class, "datatables"])->name("datatables");
        Route::get("/{id}/show", [App\Http\Controllers\PickingController::class, "show"])->name("show");
        Route::post("/{id}/cancelPicking", [App\Http\Controllers\PickingController::class, "cancelPicking"])->name("cancelPicking");
        Route::get("/datatablesChecker", [App\Http\Controllers\PickingController::class, "datatablesChecker"])->name("datatablesChecker");
        Route::post("/{id}/updatePicking", [App\Http\Controllers\PickingController::class, "updatePicking"])->name("updatePicking");
        Route::get("/{id}/viewPDF", [App\Http\Controllers\PickingController::class, "viewPDF"])->name("viewPDF");
        Route::post("/tablesLocationDetails", [App\Http\Controllers\PickingController::class, "tablesLocationDetails"])->name("tablesLocationDetails");
        Route::get("/{id}/viewScanPicking", [App\Http\Controllers\PickingController::class, "viewScanPicking"])->name("viewScanPicking");
        Route::post("/{id}/saveScanQty", [App\Http\Controllers\PickingController::class, "saveScanQty"])->name("saveScanQty");
        Route::get("/{id}/getLastScan", [App\Http\Controllers\PickingController::class, "getLastScan"])->name("getLastScan");
        Route::get("/{id}/datatablesPickedItems", [App\Http\Controllers\PickingController::class, "datatablesPickedItems"])->name("datatablesPickedItems");
        Route::get("/{id}/datatablesOutstandingItems", [App\Http\Controllers\PickingController::class, "datatablesOutstandingItems"])->name("datatablesOutstandingItems");
        Route::post("/{id}/confirmPicking", [App\Http\Controllers\PickingController::class, "confirmPicking"])->name("confirmPicking");
        Route::post("/{id}/getSKUAndLocation", [App\Http\Controllers\PickingController::class, "getSKUAndLocation"])->name("getSKUAndLocation");
        Route::post("/{id}/deletePickedItems", [App\Http\Controllers\PickingController::class, "deletePickedItems"])->name("deletePickedItems");
    });

    Route::group([
        "prefix" => "/stock_transfer",
        "as" => "stock_transfer.",
    ], function () {
        Route::get("/", [App\Http\Controllers\StockTransferController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\StockTransferController::class, "datatables"])->name("datatables");
        Route::get("/datatablesTransactionType", [App\Http\Controllers\StockTransferController::class, "datatablesTransactionType"])->name("datatablesTransactionType");
        Route::get("/{id}/show", [App\Http\Controllers\StockTransferController::class, "show"])->name("show");
        Route::get("/create", [App\Http\Controllers\StockTransferController::class, "create"])->name("create");
        Route::get("/datatablesSKUAndItemName", [App\Http\Controllers\StockTransferController::class, "datatablesSKUAndItemName"])->name("datatablesSKUAndItemName");
        Route::get("/datatablesSourceBatchNoandSKUDetail", [App\Http\Controllers\StockTransferController::class, "datatablesSourceBatchNoandSKUDetail"])->name("datatablesSourceBatchNoandSKUDetail");
        Route::get("/datatablesUOM", [App\Http\Controllers\StockTransferController::class, "datatablesUOM"])->name("datatablesUOM");
        Route::get("/datatablesStockType", [App\Http\Controllers\StockTransferController::class, "datatablesStockType"])->name("datatablesStockType");
        Route::get("/datatablesLocationIDSource", [App\Http\Controllers\StockTransferController::class, "datatablesLocationIDSource"])->name("datatablesLocationIDSource");
        Route::get("/datatablesLocationIDDestination", [App\Http\Controllers\StockTransferController::class, "datatablesLocationIDDestination"])->name("datatablesLocationIDDestination");
        Route::post("/store", [App\Http\Controllers\StockTransferController::class, "store"])->name("store");
        Route::post("/{id}/confirmStockTransfer", [App\Http\Controllers\StockTransferController::class, "confirmStockTransfer"])->name("confirmStockTransfer");
        Route::get("/viewExcel", [App\Http\Controllers\StockTransferController::class, "viewExcel"])->name("viewExcel");
    });

    Route::group([
        "prefix" => "/checking",
        "as" => "checking.",
    ], function () {
        Route::get("/", [App\Http\Controllers\CheckingController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\CheckingController::class, "datatables"])->name("datatables");
        Route::get("/datatablesChecker", [App\Http\Controllers\CheckingController::class, "datatablesChecker"])->name("datatablesChecker");
        Route::get("{id}/show", [App\Http\Controllers\CheckingController::class, "show"])->name("show");
        Route::post("{id}/updateChecking", [App\Http\Controllers\CheckingController::class, "updateChecking"])->name("updateChecking");
        Route::get("{id}/viewScanForm", [App\Http\Controllers\CheckingController::class, "viewScanForm"])->name("viewScanForm");
        Route::get("{id}/datatablesCheckedItems", [App\Http\Controllers\CheckingController::class, "datatablesCheckedItems"])->name("datatablesCheckedItems");
        Route::get("{id}/datatablesOutstandingItems", [App\Http\Controllers\CheckingController::class, "datatablesOutstandingItems"])->name("datatablesOutstandingItems");
        Route::get("{id}/getLastScan", [App\Http\Controllers\CheckingController::class, "getLastScan"])->name("getLastScan");
        Route::post("{id}/getSKUAndLocation", [App\Http\Controllers\CheckingController::class, "getSKUAndLocation"])->name("getSKUAndLocation");
        Route::post("{id}/saveScanQty", [App\Http\Controllers\CheckingController::class, "saveScanQty"])->name("saveScanQty");
        Route::post("{id}/confirmChecking", [App\Http\Controllers\CheckingController::class, "confirmChecking"])->name("confirmChecking");
        Route::get("{id}/printShippingLabel", [App\Http\Controllers\CheckingController::class, "printShippingLabel"])->name("printShippingLabel");
    });

    Route::group([
        "prefix" => "/inventory_adjustment",
        "as" => "inventory_adjustment.",
    ], function () {
        Route::get("/", [App\Http\Controllers\InventoryAdjustmentController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\InventoryAdjustmentController::class, "datatables"])->name("datatables");
        Route::get("/datatablesAdjusmentTypeAndAdjustmentStatus", [App\Http\Controllers\InventoryAdjustmentController::class, "datatablesAdjusmentTypeAndAdjustmentStatus"])->name("datatablesAdjusmentTypeAndAdjustmentStatus");
        Route::get("/viewExcel", [App\Http\Controllers\InventoryAdjustmentController::class, "viewExcel"])->name("viewExcel");
        Route::get("/create", [App\Http\Controllers\InventoryAdjustmentController::class, "create"])->name("create");
        Route::get("/datatables_m_wh_adjustment_type", [App\Http\Controllers\InventoryAdjustmentController::class, "datatables_m_wh_adjustment_type"])->name("datatables_m_wh_adjustment_type");
        Route::post("/getSKUItemDetails", [App\Http\Controllers\InventoryAdjustmentController::class, "getSKUItemDetails"])->name("getSKUItemDetails");
        Route::post("/store", [App\Http\Controllers\InventoryAdjustmentController::class, "store"])->name("store");
        Route::get("/{id}/show", [App\Http\Controllers\InventoryAdjustmentController::class, "show"])->name("show");
        Route::post("/{id}/confirmInventoryAdjustment", [App\Http\Controllers\InventoryAdjustmentController::class, "confirmInventoryAdjustment"])->name("confirmInventoryAdjustment");
    });

    Route::group([
        "prefix" => "/packing",
        "as" => "packing.",
    ], function () {
        Route::get("/", [App\Http\Controllers\PackingController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\PackingController::class, "datatables"])->name("datatables");
        Route::get("{id}/show", [App\Http\Controllers\PackingController::class, "show"])->name("show");
        Route::post("{id}/cancelPacking", [App\Http\Controllers\PackingController::class, "cancelPacking"])->name("cancelPacking");
        Route::post("{id}/confirmPacking", [App\Http\Controllers\PackingController::class, "confirmPacking"])->name("confirmPacking");
        Route::get("{id}/viewPrintDO", [App\Http\Controllers\PackingController::class, "viewPrintDO"])->name("viewPrintDO");
    });

    Route::group([
        "prefix" => "/movement_location",
        "as" => "movement_location.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MovementLocationController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MovementLocationController::class, "datatables"])->name("datatables");
        Route::get("/datatablesMovementLocationID", [App\Http\Controllers\MovementLocationController::class, "datatablesMovementLocationID"])->name("datatablesMovementLocationID");
        Route::get("/datatablesMovementStatus", [App\Http\Controllers\MovementLocationController::class, "datatablesMovementStatus"])->name("datatablesMovementStatus");
        Route::get("/datatablesClientID", [App\Http\Controllers\MovementLocationController::class, "datatablesClientID"])->name("datatablesClientID");
        Route::get("/datatablesWarehouseID", [App\Http\Controllers\MovementLocationController::class, "datatablesWarehouseID"])->name("datatablesWarehouseID");
        Route::get("/datatablesModalItemDetailLocation", [App\Http\Controllers\MovementLocationController::class, "datatablesModalItemDetailLocation"])->name("datatablesModalItemDetailLocation");
        Route::get("/datatablesTargetUserAssign", [App\Http\Controllers\MovementLocationController::class, "datatablesTargetUserAssign"])->name("datatablesTargetUserAssign");
        Route::post("/getModalItemDetailSKU", [App\Http\Controllers\MovementLocationController::class, "getModalItemDetailSKU"])->name("getModalItemDetailSKU");
        Route::get("/viewExcel", [App\Http\Controllers\MovementLocationController::class, "viewExcel"])->name("viewExcel");
        Route::get("/create", [App\Http\Controllers\MovementLocationController::class, "create"])->name("create");
        Route::get("{id}/show", [App\Http\Controllers\MovementLocationController::class, "show"])->name("show");
        Route::get("{id}/printPDF", [App\Http\Controllers\MovementLocationController::class, "printPDF"])->name("printPDF");
        Route::post("/storeItemDetail", [App\Http\Controllers\MovementLocationController::class, "storeItemDetail"])->name("storeItemDetail");
        Route::post("{id}/processAssignWarehouseman", [App\Http\Controllers\MovementLocationController::class, "processAssignWarehouseman"])->name("processAssignWarehouseman");
        Route::post("{id}/confirmMovement", [App\Http\Controllers\MovementLocationController::class, "confirmMovement"])->name("confirmMovement");
        Route::post("{id}/cancelMovement", [App\Http\Controllers\MovementLocationController::class, "cancelMovement"])->name("cancelMovement");
        Route::get("{id}/viewMovementActivity", [App\Http\Controllers\MovementLocationController::class, "viewMovementActivity"])->name("viewMovementActivity");
        Route::post("{id}/saveMovementActivity", [App\Http\Controllers\MovementLocationController::class, "saveMovementActivity"])->name("saveMovementActivity");
    });
    Route::group([
        "prefix" => "/stock_count",
        "as" => "stock_count.",
    ], function () {
        Route::get("/", [App\Http\Controllers\StockCountController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\StockCountController::class, "datatables"])->name("datatables");
        Route::get("/datatablesStockCountID", [App\Http\Controllers\StockCountController::class, "datatablesStockCountID"])->name("datatablesStockCountID");
        Route::get("/datatablesCountStatus", [App\Http\Controllers\StockCountController::class, "datatablesCountStatus"])->name("datatablesCountStatus");
        Route::get("/datatablesRemark", [App\Http\Controllers\StockCountController::class, "datatablesRemark"])->name("datatablesRemark");
        Route::get("/datatablesCriteriaSKU", [App\Http\Controllers\StockCountController::class, "datatablesCriteriaSKU"])->name("datatablesCriteriaSKU");
        Route::get("/datatablesCriteriaBatchNo", [App\Http\Controllers\StockCountController::class, "datatablesCriteriaBatchNo"])->name("datatablesCriteriaBatchNo");
        Route::get("/datatablesCriteriaLocation", [App\Http\Controllers\StockCountController::class, "datatablesCriteriaLocation"])->name("datatablesCriteriaLocation");
        Route::get("/viewExcel", [App\Http\Controllers\StockCountController::class, "viewExcel"])->name("viewExcel");
        Route::get("{id}/show", [App\Http\Controllers\StockCountController::class, "show"])->name("show");
        Route::post("{id}/getDataItemDetail", [App\Http\Controllers\StockCountController::class, "getDataItemDetail"])->name("getDataItemDetail");
        Route::post("{id}/checkCountNo", [App\Http\Controllers\StockCountController::class, "checkCountNo"])->name("checkCountNo");
        Route::post("{id}/checkConfirm", [App\Http\Controllers\StockCountController::class, "checkConfirm"])->name("checkConfirm");
        Route::get("/create", [App\Http\Controllers\StockCountController::class, "create"])->name("create");
        Route::post("/getCriteriaApply", [App\Http\Controllers\StockCountController::class, "getCriteriaApply"])->name("getCriteriaApply");
        Route::post("/store", [App\Http\Controllers\StockCountController::class, "store"])->name("store");
        Route::get("/datatablesTargetUserAssign", [App\Http\Controllers\StockCountController::class, "datatablesTargetUserAssign"])->name("datatablesTargetUserAssign");
        Route::get("/{id}/getTargetLocation/", [App\Http\Controllers\StockCountController::class, "getTargetLocation"])->name("getTargetLocation");
        Route::post("{id}/processSuggestLocation", [App\Http\Controllers\StockCountController::class, "processSuggestLocation"])->name("processSuggestLocation");
        Route::post("{id}/processAssignCounter", [App\Http\Controllers\StockCountController::class, "processAssignCounter"])->name("processAssignCounter");
        Route::get("{id}/viewManualCount/{count_no}", [App\Http\Controllers\StockCountController::class, "viewManualCount"])->name("viewManualCount");
        Route::post("{id}/processManualCount/{count_no}", [App\Http\Controllers\StockCountController::class, "processManualCount"])->name("processManualCount");
        Route::post("{id}/processConfirmCount/{count_no}", [App\Http\Controllers\StockCountController::class, "processConfirmCount"])->name("processConfirmCount");

        Route::get("{id}/viewPDF/{count_no}", [App\Http\Controllers\StockCountController::class, "viewPDF"])->name("viewPDF");
    });

    Route::group([
        "prefix" => "/master_project",
        "as" => "master_project.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterProjectController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterProjectController::class, "datatables"])->name("datatables");
        Route::get("/datatablesClientName", [App\Http\Controllers\MasterProjectController::class, "datatablesClientName"])->name("datatablesClientName");
        Route::get("{id}/show", [App\Http\Controllers\MasterProjectController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterProjectController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterProjectController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterProjectController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterProjectController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/master_warehouse",
        "as" => "master_warehouse.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterWarehouseController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterWarehouseController::class, "datatables"])->name("datatables");
        Route::get("/datatablesClientName", [App\Http\Controllers\MasterWarehouseController::class, "datatablesClientName"])->name("datatablesClientName");
        Route::get("{id}/show", [App\Http\Controllers\MasterWarehouseController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterWarehouseController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterWarehouseController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterWarehouseController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterWarehouseController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/master_location",
        "as" => "master_location.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterLocationController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterLocationController::class, "datatables"])->name("datatables");
        Route::get("/datatablesLocationIndex", [App\Http\Controllers\MasterLocationController::class, "datatablesLocationIndex"])->name("datatablesLocationIndex");
        Route::get("/datatablesCommodity", [App\Http\Controllers\MasterLocationController::class, "datatablesCommodity"])->name("datatablesCommodity");
        Route::get("{id}/show", [App\Http\Controllers\MasterLocationController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterLocationController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterLocationController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterLocationController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterLocationController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/master_location_index",
        "as" => "master_location_index.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterLocationIndexController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterLocationIndexController::class, "datatables"])->name("datatables");
        Route::get("{id}/show", [App\Http\Controllers\MasterLocationIndexController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterLocationIndexController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterLocationIndexController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterLocationIndexController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterLocationIndexController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/master_commodity",
        "as" => "master_commodity.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterCommodityController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterCommodityController::class, "datatables"])->name("datatables");
        Route::get("{id}/show", [App\Http\Controllers\MasterCommodityController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterCommodityController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterCommodityController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterCommodityController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterCommodityController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/master_transporter",
        "as" => "master_transporter.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterTransporterController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterTransporterController::class, "datatables"])->name("datatables");
        Route::get("{id}/show", [App\Http\Controllers\MasterTransporterController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterTransporterController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterTransporterController::class, "store"])->name("store");
    });

    Route::group([
        "prefix" => "/master_unit",
        "as" => "master_unit.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterUnitController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterUnitController::class, "datatables"])->name("datatables");
        Route::get("{id}/show", [App\Http\Controllers\MasterUnitController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterUnitController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterUnitController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterUnitController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterUnitController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/master_supplier",
        "as" => "master_supplier.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterSupplierController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterSupplierController::class, "datatables"])->name("datatables");
        Route::get("{id}/show", [App\Http\Controllers\MasterSupplierController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterSupplierController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterSupplierController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterSupplierController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterSupplierController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/user_management",
        "as" => "user_management.",
    ], function () {
        Route::get("/", [App\Http\Controllers\UserManagementController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\UserManagementController::class, "datatables"])->name("datatables");
        Route::get("{id}/show", [App\Http\Controllers\UserManagementController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\UserManagementController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\UserManagementController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\UserManagementController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\UserManagementController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/user_group_management",
        "as" => "user_group_management.",
    ], function () {
        Route::get("/", [App\Http\Controllers\UserGroupManagementController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\UserGroupManagementController::class, "datatables"])->name("datatables");
        Route::get("{id}/show", [App\Http\Controllers\UserGroupManagementController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\UserGroupManagementController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\UserGroupManagementController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\UserGroupManagementController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\UserGroupManagementController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/master_item",
        "as" => "master_item.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterItemController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterItemController::class, "datatables"])->name("datatables");
        Route::get("/datatablesUOM", [App\Http\Controllers\MasterItemController::class, "datatablesUOM"])->name("datatablesUOM");
        Route::get("{id}/show", [App\Http\Controllers\MasterItemController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterItemController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterItemController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterItemController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterItemController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/report_summary_inbound",
        "as" => "report_summary_inbound.",
    ], function () {
        Route::get("/", [App\Http\Controllers\ReportSummaryInboundController::class, "index"])->name("index");
        Route::post("/getReport", [App\Http\Controllers\ReportSummaryInboundController::class, "getReport"])->name("getReport");
        Route::get("/viewExcel", [App\Http\Controllers\ReportSummaryInboundController::class, "viewExcel"])->name("viewExcel");
        Route::get("/printPDF", [App\Http\Controllers\ReportSummaryInboundController::class, "printPDF"])->name("printPDF");
    });

    Route::group([
        "prefix" => "/cogs_computation",
        "as" => "cogs_computation.",
    ], function () {
        Route::get("/", [App\Http\Controllers\COGSComputationController::class, "index"])->name("index");
        Route::post("/getReport", [App\Http\Controllers\COGSComputationController::class, "getReport"])->name("getReport");
        Route::get("/viewExcel", [App\Http\Controllers\COGSComputationController::class, "viewExcel"])->name("viewExcel");
        Route::get("/printPDF", [App\Http\Controllers\COGSComputationController::class, "printPDF"])->name("printPDF");
    });

    Route::group([
        "prefix" => "/report_summary_outbound",
        "as" => "report_summary_outbound.",
    ], function () {
        Route::get("/", [App\Http\Controllers\ReportSummaryOutboundController::class, "index"])->name("index");
        Route::post("/getReport", [App\Http\Controllers\ReportSummaryOutboundController::class, "getReport"])->name("getReport");
        Route::get("/viewExcel", [App\Http\Controllers\ReportSummaryOutboundController::class, "viewExcel"])->name("viewExcel");
        Route::get("/printPDF", [App\Http\Controllers\ReportSummaryOutboundController::class, "printPDF"])->name("printPDF");
    });

    Route::group([
        "prefix" => "/movement_report",
        "as" => "movement_report.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MovementReportController::class, "index"])->name("index");
        Route::post("/getProcessCode", [App\Http\Controllers\MovementReportController::class, "getProcessCode"])->name("getProcessCode");
        Route::post("/getReport", [App\Http\Controllers\MovementReportController::class, "getReport"])->name("getReport");
        Route::get("/viewExcel", [App\Http\Controllers\MovementReportController::class, "viewExcel"])->name("viewExcel");
        Route::get("/printPDF", [App\Http\Controllers\MovementReportController::class, "printPDF"])->name("printPDF");
    });

    Route::group([
        "prefix" => "/master_client",
        "as" => "master_client.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterClientController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterClientController::class, "datatables"])->name("datatables");
        Route::get("{id}/show", [App\Http\Controllers\MasterClientController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterClientController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterClientController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterClientController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterClientController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/master_contact",
        "as" => "master_contact.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterContactController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterContactController::class, "datatables"])->name("datatables");
        Route::get("/datatablesSupplier", [App\Http\Controllers\MasterContactController::class, "datatablesSupplier"])->name("datatablesSupplier");
        Route::get("{id}/show", [App\Http\Controllers\MasterContactController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterContactController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterContactController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterContactController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterContactController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "/master_buffer",
        "as" => "master_buffer.",
    ], function () {
        Route::get("/", [App\Http\Controllers\MasterBufferController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\MasterBufferController::class, "datatables"])->name("datatables");
        Route::get("/datatablesContact", [App\Http\Controllers\MasterBufferController::class, "datatablesContact"])->name("datatablesContact");
        Route::get("/datatablesSKU", [App\Http\Controllers\MasterBufferController::class, "datatablesSKU"])->name("datatablesSKU");
        Route::get("{id}/show", [App\Http\Controllers\MasterBufferController::class, "show"])->name("show");
        Route::get("create", [App\Http\Controllers\MasterBufferController::class, "create"])->name("create");
        Route::post("store", [App\Http\Controllers\MasterBufferController::class, "store"])->name("store");
        Route::get("{id}/edit", [App\Http\Controllers\MasterBufferController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\MasterBufferController::class, "update"])->name("update");
    });


    Route::group([
        "prefix" => "/return",
        "as" => "return.",
    ], function () {
        Route::get("/", [App\Http\Controllers\ReturnController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\ReturnController::class, "datatables"])->name("datatables");
        Route::get("/datatablesStatus", [App\Http\Controllers\ReturnController::class, "datatablesStatus"])->name("datatablesStatus");
        Route::post("/getDataByOutboundReferenceNo", [App\Http\Controllers\ReturnController::class, "getDataByOutboundReferenceNo"])->name("getDataByOutboundReferenceNo");
        Route::get("/create", [App\Http\Controllers\ReturnController::class, "create"])->name("create");
        Route::get("/datatablesSKU", [App\Http\Controllers\ReturnController::class, "datatablesSKU"])->name("datatablesSKU");
        Route::get("/datatablesUOM", [App\Http\Controllers\ReturnController::class, "datatablesUOM"])->name("datatablesUOM");
        Route::get("/datatablesClassification", [App\Http\Controllers\ReturnController::class, "datatablesClassification"])->name("datatablesClassification");
        Route::get("/datatablesStockType", [App\Http\Controllers\ReturnController::class, "datatablesStockType"])->name("datatablesStockType");
        Route::post("/store", [App\Http\Controllers\ReturnController::class, "store"])->name("store");
        Route::get("{id}/show", [App\Http\Controllers\ReturnController::class, "show"])->name("show");
        Route::get("{id}/edit", [App\Http\Controllers\ReturnController::class, "edit"])->name("edit");
        Route::post("{id}/update", [App\Http\Controllers\ReturnController::class, "update"])->name("update");
        Route::post("{id}/confirm", [App\Http\Controllers\ReturnController::class, "confirm"])->name("confirm");
    });

    Route::group([
        "prefix" => "/gr_return",
        "as" => "gr_return.",
    ], function () {
        Route::get("/", [App\Http\Controllers\GRReturnController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\GRReturnController::class, "datatables"])->name("datatables");
        Route::get("/viewExcel", [App\Http\Controllers\GRReturnController::class, "viewExcel"])->name("viewExcel");
        Route::get("{id}/show", [App\Http\Controllers\GRReturnController::class, "show"])->name("show");
        Route::post("{id}/confirm", [App\Http\Controllers\GRReturnController::class, "confirm"])->name("confirm");
        Route::get("/{id}/printGRN", [App\Http\Controllers\GRReturnController::class, "printGRN"])->name("printGRN");
        Route::post("/{id}/confirmPutaway", [App\Http\Controllers\GRReturnController::class, "confirmPutaway"])->name("confirmPutaway");
        Route::get("/{id}/movement_location", [App\Http\Controllers\GRReturnController::class, "movement_location"])->name("movement_location");
        Route::get("/{id}/movement_location/printPutaway", [App\Http\Controllers\GRReturnController::class, "printPutaway"])->name("printPutaway");
        Route::get("/movement_location/datatablesDestLocation", [App\Http\Controllers\GRReturnController::class, "datatablesDestLocation"])->name("datatablesDestLocation");
        Route::get("{id}/movement_location/datatablesTargetWarehousemanAssign", [App\Http\Controllers\GRReturnController::class, "datatablesTargetWarehousemanAssign"])->name("datatablesTargetWarehousemanAssign");
        Route::post("/{id}/movement_location/processAssignWarehouseman", [App\Http\Controllers\GRReturnController::class, "processAssignWarehouseman"])->name("processAssignWarehouseman");
        Route::get("/movement_location/datatablesTargetUserAssign", [App\Http\Controllers\GRReturnController::class, "datatablesTargetUserAssign"])->name("datatablesTargetUserAssign");
        Route::post("/{id}/movement_location/processReceiveDetail", [App\Http\Controllers\GRReturnController::class, "processReceiveDetail"])->name("processReceiveDetail");
        Route::get("/{id}/movement_location/datatablesListSKUByGR", [App\Http\Controllers\GRReturnController::class, "datatablesListSKUByGR"])->name("datatablesListSKUByGR");
    });
    Route::group([
        "prefix" => "/shipping_load",
        "as" => "shipping_load.",
    ], function () {
        Route::get("/", [App\Http\Controllers\ShippingLoadController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\ShippingLoadController::class, "datatables"])->name("datatables");
        Route::get("/datatablesShippingLoadStatus", [App\Http\Controllers\ShippingLoadController::class, "datatablesShippingLoadStatus"])->name("datatablesShippingLoadStatus");
        Route::get("{id}/show", [App\Http\Controllers\ShippingLoadController::class, "show"])->name("show");
        Route::get("{id}/viewPDF", [App\Http\Controllers\ShippingLoadController::class, "viewPDF"])->name("viewPDF");

        Route::get("/create", [App\Http\Controllers\ShippingLoadController::class, "create"])->name("create");
        Route::post("/searchOutbound", [App\Http\Controllers\ShippingLoadController::class, "searchOutbound"])->name("searchOutbound");
        Route::post("/store", [App\Http\Controllers\ShippingLoadController::class, "store"])->name("store");
        Route::post("{id}/updateShippingLoad", [App\Http\Controllers\ShippingLoadController::class, "updateShippingLoad"])->name("updateShippingLoad");
    });

    Route::group([
        "prefix" => "/transport",
        "as" => "transport.",
    ], function () {
        Route::get("/", [App\Http\Controllers\TransportController::class, "index"])->name("index");
        Route::get("/datatables", [App\Http\Controllers\TransportController::class, "datatables"])->name("datatables");
        Route::get("/datatablesTransporter", [App\Http\Controllers\TransportController::class, "datatablesTransporter"])->name("datatablesTransporter");
        Route::get("/datatablesServiceType", [App\Http\Controllers\TransportController::class, "datatablesServiceType"])->name("datatablesServiceType");
    });

    Route::group([
        "prefix" => "/user_change_password",
        "as" => "user_change_password.",
    ], function () {
        Route::get("/", [App\Http\Controllers\UserChangePasswordController::class, "index"])->name("index");
        Route::post("{id}/update", [App\Http\Controllers\UserChangePasswordController::class, "update"])->name("update");
    });
});


// API FOR MOBILE APP - TRANSPORTATION
Route::get('order-list/{checker}', [App\Http\Controllers\InboundPlanningController::class, 'getOrderListForMobileApp'])->name("getOrderListForMobileApp");
Route::get('finish-inbound/{checker}', [App\Http\Controllers\InboundPlanningController::class, 'getFinishInboundDataForMobileApp'])->name("getFinishInboundDataForMobileApp");

Route::post('save-partial-vehicle/{inboundPlanningNo}/{checker}', [App\Http\Controllers\InboundPlanningController::class, "processSavePartialVehicleMobileApp"])->name("processSavePartialVehicleMobileApp");
Route::get('get-vehicle', [App\Http\Controllers\InboundPlanningController::class, 'getVehicleForMobileApp'])->name("getVehicleForMobileApp");
Route::get('get-vehicle-no/{inboundPlanningNo}/{userCreated}', [App\Http\Controllers\InboundPlanningController::class, 'getVehicleNO'])->name("getVehicleNO");
Route::get('get-wh-trans/{inboundPlanningNo}/{userCreated}/{vehicleNo}', [App\Http\Controllers\InboundPlanningController::class, 'getWHTransportation'])->name("getWHTransportation");
Route::post('save-finish-vehicle/{activityId}/{vehicleNo}', [App\Http\Controllers\InboundPlanningController::class, "processSaveFinishVehicleMobileApp"])->name("processSaveFinishVehicleMobileApp");

// API FOR MOBILE APP - SCAN
Route::get('/get-sku/{inbound_planning_no}', [App\Http\Controllers\InboundPlanningController::class, 'getSKUforMobileApp']);
Route::get('/stock-type-scan/{stock_id?}', [App\Http\Controllers\InboundPlanningController::class, 'getStockTypeScanMobileApp']);
Route::get('/check-qty-plan/{inboundPlanningNo}', [App\Http\Controllers\InboundPlanningController::class, 'checkQtyPlan']);
Route::get('/check-outstanding/{inboundPlanningNo}/{sku}', [App\Http\Controllers\InboundPlanningController::class, 'checkOutstanding']);
Route::post('/process-scan/{inboundPlanningNo}/{activtyId}/{cheker}', [App\Http\Controllers\InboundPlanningController::class, 'processScanMobileApp']);

// API FOR MOBILE APP - PUT AWAY
Route::get('order-putaway/{warehouseman}', [App\Http\Controllers\GoodsReceivingController::class, 'getOrderPutAway']);
Route::post('update-putaway', [App\Http\Controllers\GoodsReceivingController::class, 'updateScanStatus']);

Route::get('putaway-data/{warehouseman}', [App\Http\Controllers\GoodsReceivingController::class, 'getPutawayData']);
