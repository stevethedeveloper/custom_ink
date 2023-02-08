const DisplayShortenedUrl = ({ shortCode, baseUrl, onClick }) => {  
  // Check if short code exists
  if (shortCode) {
    return <div onClick={onClick}>{baseUrl + shortCode}</div>;
  }
};

export default DisplayShortenedUrl;
