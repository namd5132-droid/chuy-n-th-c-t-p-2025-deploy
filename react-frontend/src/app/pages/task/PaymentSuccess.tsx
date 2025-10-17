import { useEffect, useState } from "react";
import { Link, useLocation } from "react-router-dom";

export default function PaymentSuccess({ clearCart }: { clearCart: () => void }) {
  const [status, setStatus] = useState<"success" | "fail" | null>(null);
  const location = useLocation();

  useEffect(() => {
    const params = new URLSearchParams(location.search);
    const resultCode = params.get("resultCode");
    const message = params.get("message");

    if (resultCode === "0") {
      setStatus("success");
      clearCart(); // reset cart
    } else {
      setStatus("fail");
      console.log("Message từ MoMo:", message);
    }
  }, [location, clearCart]);

  return (
    <div className="min-h-screen flex flex-col justify-center items-center bg-gray-900 text-white">
      {status === "success" ? (
        <>
          <h1 className="text-4xl font-bold text-green-400 mb-4">✅ Thanh toán thành công!</h1>
          <p className="text-gray-300 mb-6">Cảm ơn bạn đã sử dụng MoMo 🎬</p>
        </>
      ) : status === "fail" ? (
        <>
          <h1 className="text-4xl font-bold text-red-400 mb-4">❌ Thanh toán thất bại!</h1>
          <p className="text-gray-300 mb-6">Vui lòng thử lại hoặc chọn phương thức khác.</p>
        </>
      ) : (
        <p className="text-gray-300">Đang xử lý kết quả thanh toán...</p>
      )}

      <Link to="/tasks" className="mt-4 bg-yellow-500 text-black font-bold px-6 py-2 rounded-lg hover:bg-yellow-400 transition">
        🔙 Quay về trang chính
      </Link>
    </div>
  );
}
