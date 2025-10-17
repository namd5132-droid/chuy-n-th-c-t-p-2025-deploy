import LoginUser from "../../react-frontend/src/app/pages/auth/login";
import RegisterUser from "../../react-frontend/src/app/pages/auth/register";
import TaskIndex from "../../react-frontend/src/app/pages/task/tasks";
import Contact from "../../react-frontend/src/app/pages/task/contact";
import Booking from "../../react-frontend/src/app/pages/task/booking";
import Detail from "../../react-frontend/src/app/pages/task/detail";
import Admin from "../../react-frontend/src/app/pages/admin/admin";
import Search from "../../react-frontend/src/app/pages/task/search";
import FillNew from "../../react-frontend/src/app/pages/fill/new";
import Cart from "../../react-frontend/src/app/pages/task/cart";
import FillNow from "../../react-frontend/src/app/pages/fill/now";
import FillImax from "../../react-frontend/src/app/pages/fill/imax";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        {/* Redirect root "/" sang "/users/login" */}
        <Route path="/" element={<Navigate to="/users/login" replace />} />

        {/* Auth */}
        <Route path="/users/login" element={<LoginUser />} />
        <Route path="/users/register" element={<RegisterUser />} />

        {/* Task */}
        <Route path="/tasks" element={<TaskIndex />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/booking" element={<Booking />} />
        <Route path="/cart" element={<Cart />} />
        <Route path="/search" element={<Search />} />
        <Route path="/detail/:id" element={<Detail />} />

        {/* Movies / Fill */}
        <Route path="/movies/fill/new" element={<FillNew />} />
        <Route path="/movies/fill/now" element={<FillNow />} />
        <Route path="/movies/fill/imax" element={<FillImax />} />

        {/* Admin */}
        <Route path="/admin" element={<Admin />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
