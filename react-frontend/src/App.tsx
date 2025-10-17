import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import Tasks from "../../react-frontend/src/app/pages/task/tasks";
function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Navigate to="/users/login" replace />} />
        <Route path="/tasks" element={<Tasks />} />
        {/* các route khác */}
      </Routes>
    </BrowserRouter>
  );
}
export default App
