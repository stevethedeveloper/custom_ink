import { useState } from "react";
import urlService from "../services/urls";

const DisplayOriginalUrl = ({ shortCode, show, displayError }) => {
  const [originalUrl, setOriginalUrl] = useState("");

  if (show) {
    urlService
      .get(shortCode)
      .then((response) => {
        setOriginalUrl(response.original_url);
      })
      .catch(function (response) {
        displayError(response.response.data);
      });

    return (
      <div className="borderDiv">
        <h3>Your original URL (click it too):</h3>
        <div className="url">
          <a href={originalUrl} target="_blank" rel="noreferrer">
            {originalUrl}
          </a>
        </div>
      </div>
    );
  }
};

export default DisplayOriginalUrl;
