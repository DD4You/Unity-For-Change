import { useState } from "react";
import { Link, NavLink, Outlet, useSearchParams } from "react-router-dom";
import Modal from "./components/Modal";

function App() {
  const [navbarOpen, setNavbarOpen] = useState(true);

  const [searchParams, setSerachPearms] = useSearchParams()

  return (
    <div>
      {searchParams.get('msg') && searchParams.get('type') ?
        <Modal msg={searchParams.get('msg')} type={searchParams.get('type')} /> :
        ''}

      <header className="bg-white">
        <nav className="mx-auto flex max-w-7xl items-center justify-between p-6 md:px-20">
          <div className="flex lg:flex-1">
            <Link to={"/"} className="-m-1.5 p-1.5">
              <span className="sr-only">Your Company</span>
              <img className="h-8 w-auto" src="/logo.png" alt="" />
            </Link>
          </div>

          <div className="flex lg:hidden">
            <button
              type="button"
              onClick={() => setNavbarOpen((prev) => !prev)}
              className="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
            >
              <span className="sr-only">Open main menu</span>
              <svg
                className="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="1.5"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                />
              </svg>
            </button>
          </div>

          <div className="hidden lg:flex lg:gap-x-12">
            <NavLink
              end
              to={"/"}
              className="text-sm font-semibold leading-6 text-gray-900"
            >
              About Us
            </NavLink>
            <NavLink
              end
              to={"/"}
              className="text-sm font-semibold leading-6 text-gray-900"
            >
              Campaigns
            </NavLink>
            <NavLink
              end
              to={"/"}
              className="text-sm font-semibold leading-6 text-gray-900"
            >
              Contact
            </NavLink>
          </div>
        </nav>

        <div
          className={navbarOpen ? "hidden" : ""}
          role="dialog"
          aria-modal="true"
        >
          <div className="fixed inset-0 z-10"></div>
          <div className="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div className="flex items-center justify-between">
              <Link to={"/"} className="-m-1.5 p-1.5">
                <span className="sr-only">Your Company</span>
                <img className="h-8 w-auto" src="/logo.png" alt="" />
              </Link>
              <button
                type="button"
                className="-m-2.5 rounded-md p-2.5 text-gray-700"
              >
                <span className="sr-only">Close menu</span>
                <svg
                  className="h-6 w-6"
                  fill="none"
                  viewBox="0 0 24 24"
                  strokeWidth="1.5"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
            <div className="mt-6 flow-root">
              <div className="-my-6 divide-y divide-gray-500/10">
                <div className="space-y-2 py-6">
                  <NavLink
                    end
                    to="/"
                    className="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-500"
                  >
                    About Us
                  </NavLink>
                  <NavLink
                    end
                    to="/"
                    className="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-500"
                  >
                    Campaigns
                  </NavLink>
                  <NavLink
                    end
                    to="/"
                    className="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-500"
                  >
                    Contact
                  </NavLink>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <hr className="mb-4" />

      <div>
        <Outlet />
      </div>

      <footer>
        <div className="mx-auto max-w-7xl mb-16 px-6 md:px-20 grid grid-cols-1 md:grid-cols-4 gap-3">
          <div>
            <Link to={"/"} className="mb-2">
              <span className="sr-only">Your Company</span>
              <img className="h-8 w-auto" src="/logo.png" alt="" />
            </Link>
            <p className="text-gray-400 md:text-sm">
              About In publishing and graphic design, Lorem ipsum is a
              placeholder text commonly used to demonstrate the visual form of a
              document or a typeface
            </p>
          </div>
          <div></div>
          <div></div>
          <div>
            <p className="mb-3 text-black font-medium">Legal Stuff</p>
            <ul className="text-gray-400">
              <li>
                <Link end to="/">
                  Disclaimer
                </Link>
              </li>
              <li>
                <Link end to="/">
                  Privacy Policy
                </Link>
              </li>
              <li>
                <Link end to="/">
                  Terms & Conditions
                </Link>
              </li>
            </ul>
          </div>
        </div>
        <p className="text-center py-1 bg-gray-200 text-gray-500 text-sm">
          Copyright © 2023 NGO. | All Rights Reserved
        </p>
      </footer>
    </div>
  );
}
export default App;
