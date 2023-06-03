import OwlCarousel from "react-owl-carousel";
import "owl.carousel/dist/assets/owl.carousel.css";
import "owl.carousel/dist/assets/owl.theme.default.css";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";

export default function Detail() {
  let params = useParams();

  const [popupOpen, setPopupOpen] = useState(true);
  const [campaign, setCampaign] = useState({});
  const [images, setImages] = useState([]);

  const [firstname, setFirstName] = useState("");
  const [email, setEmail] = useState("");
  const [phone, setPhone] = useState("");
  const [amount, setAmount] = useState("");

  useEffect(() => {
    axios
      .get(`campaigns/${params.slug}`)
      .then((response) => {
        setCampaign(response.data.data);
        setImages(response.data.data.images);
      })
      .catch((error) => {
        console.log(error);
      });
  }, []);

  function clearForm() {
    setFirstName("");
    setEmail("");
    setPhone("");
    setAmount("");
  }

  function handleSubmit(event) {
    event.preventDefault();

    axios
      .post(`payment/${params.slug}`, {
        firstname,
        email,
        phone,
        amount,
      })
      .then((response) => {
        console.log("success", response.data.data);
        makePayment(response.data.data);
        clearForm();
      })
      .catch((error) => {
        console.log("error", error);
        clearForm();
      });
  }

  function makePayment(data) {
    let form = document.createElement("form");
    document.getElementsByTagName("body")[0].appendChild(form);
    form.setAttribute("method", "post");
    form.setAttribute("action", "https://test.payu.in/_payment");
    Object.entries(data).forEach(([key, value]) => {
      let input = document.createElement("input");
      input.setAttribute("type", "hidden");
      input.setAttribute("name", key);
      input.setAttribute("value", value);
      form.appendChild(input);
    });
    form.submit();
  }

  return (
    <>
      <section className="mx-auto max-w-7xl mb-16 px-6 md:px-20 grid grid-cols-1 md:grid-cols-2 gap-4 place-items-center">
        <div className="flex flex-col justify-between gap-6">
          <h1 className="text-4xl font-bold text-red-500">{campaign.name}</h1>
          <p className="text-gray-400">{campaign.description}</p>
          <div className="text-center">
            <button
              type="button"
              onClick={() => setPopupOpen((prev) => !prev)}
              className="bg-violet-500 px-4 rounded py-2 text-white font-medium"
            >
              Donate Now
            </button>
          </div>
        </div>
        <div className="w-full">
          <OwlCarousel
            items={1}
            className="owl-theme"
            loop
            autoplay
            dots={false}
            margin={8}
          >
            {images.length > 0}
            {images.map((image, index) => (
              <img key={index} src={image} alt="" />
            ))}
          </OwlCarousel>
        </div>
      </section>

      <div
        className={popupOpen ? "relative z-10 hidden" : "relative z-10"}
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
      >
        <div className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div className="fixed inset-0 z-10 overflow-y-auto">
          <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div className="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 w-full md:max-w-lg">
              <div className="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <div className="w-full max-w-md space-y-8">
                  <div>
                    <img
                      className="mx-auto h-12 w-auto"
                      src="/logo.png"
                      alt="Your Company"
                    />
                    <h2 className="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                      Donate Now
                    </h2>
                    <p className="mt-2 text-center text-sm text-gray-600">
                      {campaign.name}
                    </p>
                  </div>
                  <form className="mt-8 space-y-6" onSubmit={handleSubmit}>
                    <div className="-space-y-px rounded-md shadow-sm">
                      <div>
                        <label htmlFor="full-name" className="sr-only">
                          Name
                        </label>
                        <input
                          id="full-name"
                          type="text"
                          autoComplete="off"
                          value={firstname}
                          onChange={(event) => setFirstName(event.target.value)}
                          required
                          className="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                          placeholder="Name"
                        />
                      </div>
                      <div>
                        <label htmlFor="email-address" className="sr-only">
                          Email Address
                        </label>
                        <input
                          id="email-address"
                          type="email"
                          value={email}
                          onChange={(event) => setEmail(event.target.value)}
                          autoComplete="off"
                          required
                          className="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                          placeholder="Email Address"
                        />
                      </div>
                      <div>
                        <label htmlFor="phone-number" className="sr-only">
                          Phone Number
                        </label>
                        <input
                          id="phone-number"
                          maxLength="10"
                          value={phone}
                          onChange={(event) => setPhone(event.target.value)}
                          type="tel"
                          autoComplete="off"
                          required
                          className="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                          placeholder="Phone Number"
                        />
                      </div>
                      <div>
                        <label htmlFor="amount" className="sr-only">
                          Amount
                        </label>
                        <input
                          id="amount"
                          type="number"
                          value={amount}
                          onChange={(event) => setAmount(event.target.value)}
                          autoComplete="off"
                          step="0.01"
                          required
                          className="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                          placeholder="Donation Amount"
                        />
                      </div>
                    </div>

                    <div>
                      <button
                        type="submit"
                        className="group relative flex w-full justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                      >
                        <span className="absolute inset-y-0 left-0 flex items-center pl-3">
                          <svg
                            fill="none"
                            viewBox="0 0 24 24"
                            strokeWidth={1.5}
                            stroke="currentColor"
                            className="h-5 w-5 text-green-500 group-hover:text-green-400"
                          >
                            <path
                              strokeLinecap="round"
                              strokeLinejoin="round"
                              d="M15 8.25H9m6 3H9m3 6l-3-3h1.5a3 3 0 100-6M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                          </svg>
                        </span>
                        Pay Now
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
