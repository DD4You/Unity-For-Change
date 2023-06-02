import OwlCarousel from "react-owl-carousel";
import "owl.carousel/dist/assets/owl.carousel.css";
import "owl.carousel/dist/assets/owl.theme.default.css";
import axios from "axios";
import Campaign from "../components/Campaign";
import { useState, useEffect } from "react";

export default function Home() {
  const [campaigns, setCampaigns] = useState({});

  useEffect(() => {
    axios
      .get("campaigns")
      .then((response) => {
        setCampaigns(response.data.data);
      })
      .catch(() => {});
  }, []);

  return (
    <>
      <section className="mx-auto max-w-7xl mb-16 px-6 md:px-20 grid grid-cols-1 md:grid-cols-2 gap-4 place-items-center">
        <div className="flex flex-col justify-between gap-6">
          <p className="font-medium text-gray-900">
            Join us in making a difference and creating a better world.
          </p>
          <h1 className="text-4xl font-bold text-violet-600">
            Empowering Change, Together.
          </h1>
          <p className="text-gray-400">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi,
            debitis voluptatibus. Alias eaque cupiditate mollitia atque adipisci
            corrupti quibusdam aut modi ipsa, ducimus quod, accusamus corporis,
            dolore maiores impedit. Dignissimos.
          </p>
        </div>
        <div>
          <img src="/hero.png" alt="" />
        </div>
      </section>

      <section className="mx-auto max-w-7xl px-6 md:px-20 mb-16">
        <h2 className="text-3xl text-center font-medium capitalize mb-3">
          Our Commitment <span className="text-red-500">to Change</span>
        </h2>
        <p className="text-gray-400 text-center mb-3">
          Overall, the website should create a compelling narrative around
          UnityForChange's mission, showcasing the impact they have in various
          areas and encouraging visitors to donate and join their cause for
          creating positive change in the world
        </p>

        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <span className="bg-violet-500 flex justify-center text-2xl shadow-md mb-2 items-center w-9 h-9 rounded p-1 text-white">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="1.5"
                stroke="currentColor"
                className="w-6 h-6"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                />
              </svg>
            </span>
            <p className="text-gray-900 font-medium">Environment</p>
            <small className="text-gray-400">
              In publishing and graphic design, Lorem ipsum is a placeholder
              text commonly used to demonstrate the
            </small>
          </div>
          <div>
            <span className="bg-red-500 flex justify-center text-2xl shadow-md mb-2 items-center w-9 h-9 rounded p-1 text-white">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="1.5"
                stroke="currentColor"
                className="w-6 h-6"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                />
              </svg>
            </span>
            <p className="text-gray-900 font-medium">Education</p>
            <small className="text-gray-400">
              In publishing and graphic design, Lorem ipsum is a placeholder
              text commonly used to demonstrate the
            </small>
          </div>
          <div>
            <span className="bg-green-500 flex justify-center text-2xl shadow-md mb-2 items-center w-9 h-9 rounded p-1 text-white">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="1.5"
                stroke="currentColor"
                className="w-6 h-6"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                />
              </svg>
            </span>
            <p className="text-gray-900 font-medium">Health and Wellness</p>
            <small className="text-gray-400">
              In publishing and graphic design, Lorem ipsum is a placeholder
              text commonly used to demonstrate the
            </small>
          </div>
          <div>
            <span className="bg-sky-500 flex justify-center text-2xl shadow-md mb-2 items-center w-9 h-9 rounded p-1 text-white">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="1.5"
                stroke="currentColor"
                className="w-6 h-6"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                />
              </svg>
            </span>
            <p className="text-gray-900 font-medium">Disaster Relief</p>
            <small className="text-gray-400">
              In publishing and graphic design, Lorem ipsum is a placeholder
              text commonly used to demonstrate the
            </small>
          </div>
        </div>
      </section>

      <section className="mx-auto max-w-7xl px-5 md:px-20">
        <h2 className="text-2xl text-center font-medium capitalize mb-6">
          Some of our recent campaign
          <br />
          <span className="text-red-500 font-bold">
            to help helpless people
          </span>
        </h2>

        <div className="w-full">
          {campaigns.length > 0}
          {
            <OwlCarousel
              items={3}
              className="owl-theme"
              loop
              autoplay
              responsive={{ 0: { items: 1 }, 600: { items: 3 } }}
              dots={false}
              margin={8}
            >
              {campaigns.length > 0 &&
                campaigns.map((campaign) => {
                  return <Campaign key={campaign.id} campaign={campaign} />;
                })}
            </OwlCarousel>
          }
        </div>
      </section>
    </>
  );
}
