import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import Login from "../../react-frontend/src/app/pages/auth/login";
function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Navigate to="/users/login" replace />} />
        <Route path="/users/login" element={<Login />} />
        {/* các route khác */}
      </Routes>
    </BrowserRouter>
  );
}
