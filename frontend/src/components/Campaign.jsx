import { Link } from "react-router-dom";

export default function Campaign({ campaign }) {
  let discount = (
    (campaign.raise_funds_sum_amount / campaign.goal) *
    100
  ).toFixed(0);

  return (
    <div className="bg-white p-2 rounded shadow-lg mb-6 mx-1">
      <div className="relative mb-5">
        <img className="img" src={campaign.images} alt="" />
        <small className="absolute left-1/2 -translate-x-1/2 -bottom-2.5 text-white uppercase bg-violet-600 rounded-sm px-2 py-0.5">
          {campaign.category_name}
        </small>
      </div>

      <p className="text-gray-900 font-medium">{campaign.name}</p>
      <small className="text-gray-400 line-clamp-4">
        {campaign.description}
      </small>

      <div className="flex justify-between items-center mt-3 gap-3 text-gray-400">
        <small>
          Goals:{" "}
          <span className="text-black font-medium">₹{campaign.goal}</span>
        </small>
        <small>
          Raised:{" "}
          <span className="text-black font-medium">
            ₹{campaign.raise_funds_sum_amount}
          </span>
        </small>
      </div>

      <div className="flex items-center justify-center gap-2">
        <div className="w-full rounded bg-gray-300 mt-2">
          <div
            className="rounded bg-gray-400 py-0.5"
            style={{ width: discount + "%" }}
          ></div>
        </div>
        <small className="shrink-0">{discount}%</small>
      </div>

      <div className="text-center my-3">
        <Link
          to={`/${campaign.slug}`}
          className="bg-red-500 hover:bg-red-600 duration-150 font-medium shadow rounded-full px-4 py-1 text-white"
        >
          Donate Now
        </Link>
      </div>
    </div>
  );
}
