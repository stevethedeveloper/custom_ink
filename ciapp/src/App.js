import { useState } from "react";
import urlService from "./services/urls";
import UrlForm from "./components/UrlForm";
import DisplayOriginalUrl from "./components/DisplayOriginalUrl";
import DisplayShortenedUrl from "./components/DisplayShortenedUrl";
import DisplayHeader from "./components/DisplayHeader";

const App = () => {
  const baseUrl = "https://ci.com/";
  const [code, setCode] = useState("");
  const [newUrl, setNewUrl] = useState("");
  const [showOriginalUrl, setShowOriginalUrl] = useState(false);
  const [errorMessage, setErrorMessage] = useState("");

  // Insert a URL and return the short code
  const addUrl = (event) => {
    event.preventDefault();

    // Clear any error messages, codes, and hide original URL to start over
    setErrorMessage("");
    setCode("");
    setShowOriginalUrl(false);

    const urlObject = { original_url: newUrl };

    urlService
      .add(urlObject)
      .then((returnedCode) => {
        setCode(returnedCode.short_code);
        setNewUrl("");
      })
      .catch(function (response) {
        handleError(response.response.data);
      });
  };

  const handleUrlChange = (event) => {
    setNewUrl(event.target.value);
    // When a user starts typing, clear errors, shortened URLs, and original URL
    setErrorMessage("");
    setCode("");
    setShowOriginalUrl(false);
  };

  const handleResetClick = (event) => {
    setNewUrl(event.target.value);
    setCode("");
    setNewUrl("");
    setShowOriginalUrl(false);
    setErrorMessage("");
  };

  const handleError = (errorText) => setErrorMessage(errorText);

  const handleShortUrlClick = () => setShowOriginalUrl(true);

  return (
    <div>
      <DisplayHeader handleResetClick={handleResetClick} />
      {errorMessage && <div className="alert alert-danger"> {errorMessage} </div>}
      <UrlForm onChange={handleUrlChange} onSubmit={addUrl} onReset={handleResetClick} value={newUrl} />
      <DisplayShortenedUrl shortCode={code} baseUrl={baseUrl} onClick={handleShortUrlClick}/>
      <DisplayOriginalUrl shortCode={code} show={showOriginalUrl} displayError={handleError} />
    </div>
  );
};

export default App;
