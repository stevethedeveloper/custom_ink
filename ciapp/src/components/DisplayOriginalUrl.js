import { useState, useEffect } from 'react'
import urlService from '../services/urls'

const DisplayOriginalUrl = ({ shortCode, show, displayError }) => {
  const [originalUrl, setOriginalUrl] = useState("");

  // Clear any error messages on load
  useEffect(() => {
    displayError('')
  }, []);

  if (show) {
    urlService
        .get(shortCode)
        .then((response) => {
          // setCode(returnedCode.short_code);
          setOriginalUrl(response.original_url);
        })
        .catch(function (response) {
          displayError(response.response.data)
        });
  }

  return <div>{originalUrl}</div>
}



export default DisplayOriginalUrl;