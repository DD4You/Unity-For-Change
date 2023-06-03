import IconSuccess from "./IconSuccess";
import IconFail from "./IconFail";
import { useState } from "react";

export default function Modal({ msg, type }) {
  const [showModal, setShowModal] = useState(false);

  return (
    <div
      className={`fixed inset-0 h-full w-full ${
        showModal ? "hidden" : ""
      } overflow-y-auto bg-gray-600 bg-opacity-50`}
      id="my-modal"
    >
      <div className="relative top-20 mx-auto w-96 rounded-md border bg-white p-5 shadow-lg">
        <div className="mt-3 text-center">

          {type == "success" ? <IconSuccess /> : <IconFail />}

          <h3 className="text-lg font-medium leading-6 text-gray-900">
            {type == "success" ? "Successful!" : "Fail!"}
          </h3>
          
          <div className="mt-2 px-7 py-3">
            <p className="text-sm text-gray-500">{msg}</p>
          </div>
          <div className="items-center px-4 py-3">
            {type == "success" ? (
              <button
                onClick={() => setShowModal(true)}
                className="w-full rounded-md bg-green-500 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300"
              >
                OK
              </button>
            ) : (
              <button
                onClick={() => setShowModal(true)}
                className="w-full rounded-md bg-red-500 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300"
              >
                OK
              </button>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}
