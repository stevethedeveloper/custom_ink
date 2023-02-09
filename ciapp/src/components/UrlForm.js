const UrlForm = ({ onSubmit, onReset, onChange, value }) => {
  return (
    <div className="borderDiv">
      <h3>URL Shortener</h3>
      <form onSubmit={onSubmit}>
        <input
          value={value}
          onChange={onChange}
          placeholder="Enter a URL to shorten"
          className="form-control"
        />
        <button type="submit" className="submitButton btn btn-primary">
          Submit URL
        </button>
        <button
          type="button"
          onClick={onReset}
          className="resetButton btn btn-secondary"
        >
          Start Over
        </button>
      </form>
    </div>
  );
};

export default UrlForm;
