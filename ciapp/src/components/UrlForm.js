const UrlForm = ({ onSubmit, onChange, value }) => {
  return (
    <form onSubmit={onSubmit}>
      <input
        value={value}
        onChange={onChange}
        placeholder="Enter a URL to shorten"
      />
      <button type="submit">save</button>
    </form>
  );
};

export default UrlForm;
