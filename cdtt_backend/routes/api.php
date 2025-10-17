<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\MomoController;
use Illuminate\Http\Request;



{
    Route::post('/momo/payment', function (Request $request) {
    $endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';

    $partnerCode = 'MOMOXXXX2025'; // test partner code
    $accessKey = 'ABCD1234KEY';
    $secretKey = 'SECRET1234ABCD';
    $orderInfo = 'Thanh toán vé xem phim CGV';
    $amount = (int)$request->total;
    $orderId = time() . '';
    $redirectUrl = 'http://localhost:5173/tasks'; // React quay lại
    $ipnUrl = 'http://your-backend.com/api/momo/ipn'; // Callback của MoMo
    $extraData = '';

    // Raw signature string
    $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$orderId&requestType=captureWallet";

    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    $data = [
        'partnerCode' => $partnerCode,
        'partnerName' => "CGV Việt Nam",
        'storeId' => "CGVStore01",
        'requestId' => $orderId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => 'captureWallet',
        'signature' => $signature,
    ];

    $response = Http::post($endpoint, $data);

    if ($response->failed()) {
        return response()->json(['error' => 'Lỗi gọi API MoMo'], 500);
    }

    $res = $response->json();
    return response()->json($res);
});


Route::post('/momo/ipn', function (Request $request) {
    $data = $request->all();
    // TODO: cập nhật trạng thái đơn hàng trong DB
    return response()->json(['message' => 'success']);
});


Route::post('/momo/payment', [MomoController::class, 'payment']);
Route::post('/momo/callback', [MomoController::class, 'callback']);

}

Route::post('/contact', [ContactController::class, 'store']);


Route::get('/showtimes', [ShowtimeController::class, 'index']);
Route::post('/showtimes', [ShowtimeController::class, 'store']);
Route::put('/showtimes/{id}', [ShowtimeController::class, 'update']);
Route::delete('/showtimes/{id}', [ShowtimeController::class, 'destroy']);


Route::get('/orders', [OrderController::class, 'index']);

Route::post('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/bookings', [BookingController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);



Route::get('/movies', [MovieController::class, 'index']);
Route::post('/movies', [MovieController::class, 'store']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);

Route::post('users/register', [AuthController::class, 'register']);
Route::post('users/login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);

Route::apiResource('users', UsersController::class);
Route::delete('/bookings/clear/{order_id}', [BookingController::class, 'clear']);
//admin
Route::get('/movies', [MovieController::class, 'index']);   // danh sách
Route::post('/movies', [MovieController::class, 'store']); // thêm
Route::get('/movies/{id}', [MovieController::class, 'show']); // chi tiết
Route::put('/movies/{id}', [MovieController::class, 'update']); // sửa
Route::delete('/movies/{id}', [MovieController::class, 'destroy']); // xóa



