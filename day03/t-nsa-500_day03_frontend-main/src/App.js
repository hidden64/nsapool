import "./App.css";
import axios from "axios";
import { useEffect, useState } from "react";

function App() {
  const backURI = "http://localhost:8080/api/user";

  const [isBackUp, setIsBackUp] = useState(false);
  const [error, setError] = useState(null);
  const [res, setRes] = useState(null);

  useEffect(() => {
    const controller = new AbortController();

    const checkBackend = async () => {
      try {
        const response = await axios.get(backURI, {
          signal: controller.signal,
        });

        if (response.status >= 200 && response.status < 300 && response.data) {
          setRes(response.data);
          setIsBackUp(true);
        } else {
          throw new Error(response.statusText || "Unexpected response");
        }
      } catch (err) {
        if (axios.isCancel(err)) return;
        setError(err);
        setIsBackUp(false);
      }
    };

    checkBackend();

    return () => {
      controller.abort();
    };
  }, [backURI]);

  if (isBackUp) {
    return (
      <div className="alert alert-success" role="alert">
        <h4 className="alert-heading">Task successful! Well done!</h4>
        <hr />
        <p className="mb-0">
          Aww yeah, you successfully synced your backend and your frontend and
          thus finished your day of pool, congrats!
        </p>
      </div>
    );
  }

  return (
    <div className="alert alert-warning" role="alert">
      <h4 className="alert-heading">Task failed. Try again.</h4>
      <hr />
      <p className="mb-0">
        Almost there, you still have to some verifications to do as your backend
        is not up or not on the right port perhaps...
      </p>
      {error && (
        <p className="mt-2">
          <strong>Error:</strong> {error.message}
        </p>
      )}
    </div>
  );
}

export default App;
