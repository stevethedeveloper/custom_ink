const DisplayShortenedUrl = ({ shortCode, baseUrl, onClick }) => {
  // Check if short code exists
  if (shortCode) {
    return (
      <div className="borderDiv">
        <h3>Your shortened URL (click it):</h3>
        <div className="url" onClick={onClick}>
          {baseUrl + shortCode}
        </div>
      </div>
    );
  }
};

export default DisplayShortenedUrl;
