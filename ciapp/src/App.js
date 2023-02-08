import './App.css';
import { useState, useEffect } from 'react'
import urlService from './services/urls'
import UrlForm from './components/UrlForm'
import DisplayOriginalUrl from './components/DisplayOriginalUrl'
import DisplayShortenedUrl from './components/DisplayShortenedUrl'

const App = () => {
  const baseUrl = 'https://ci.com/';
  const [code, setCode] = useState("");
  const [newUrl, setNewUrl] = useState("");
  const [showOriginalUrl, setShowOriginalUrl] = useState(false);
  const [errorMessage, setErrorMessage] = useState('')

  const addUrl = (event) => {
    event.preventDefault();

    // Clear any error messages
    setErrorMessage('')

    const urlObject = { original_url: newUrl };

    urlService
      .add(urlObject)
      .then((returnedCode) => {
        setCode(returnedCode.short_code);
      })
      .catch(function (response) {
        // TODO handle error
        handleError(response.response.data)
      });

    setNewUrl("");
  };
  
  const handleUrlChange = (event) => {
    setNewUrl(event.target.value);
  };

  // To pass to children
  const handleError = (errorText) => setErrorMessage(errorText);

  const handleShortUrlClick = () => setShowOriginalUrl(true)

  return (
    <div>
      <h1>URL Shortener</h1>
      { errorMessage && <div className="error"> { errorMessage } </div> }
      <UrlForm onChange={handleUrlChange} onSubmit={addUrl} value={newUrl} />
      <DisplayShortenedUrl shortCode={code} baseUrl={baseUrl} onClick={handleShortUrlClick} />
      <DisplayOriginalUrl shortCode={code} show={showOriginalUrl} displayError={handleError} />
    </div>
  );
}


export default App;





// const Url = ({ url }) => {
//   return (
//     <li>{url.short_code} - {url.original_url}</li>
//   )
// }
